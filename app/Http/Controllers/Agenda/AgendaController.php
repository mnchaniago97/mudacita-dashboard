<?php

namespace App\Http\Controllers\Agenda;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Setting;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        $events = Agenda::orderBy('event_date')->get();
        $calendarSchedules = $events->map(function ($event) {
            $start = $event->event_date;
            $end = $event->event_date;

            if (!empty($event->start_time)) {
                $start = $event->event_date . ' ' . $event->start_time;
            }

            if (!empty($event->end_time)) {
                $end = $event->event_date . ' ' . $event->end_time;
            }

            $bgColor = '#4c6fff';

            return [
                'id' => (string) $event->id,
                'calendarId' => '1',
                'title' => $event->title,
                'start' => $start,
                'end' => $end,
                'category' => 'time',
                'isAllDay' => false,
                'location' => $event->location,
                'state' => 'Busy',
                'color' => '#ffffff',
                'bgColor' => $bgColor,
                'dragBgColor' => $bgColor,
                'borderColor' => $bgColor,
            ];
        });

        return view('admin.agenda.index', compact('events', 'calendarSchedules'));
    }

    public function create()
    {
        return view('admin.agenda.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'category' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $data['notify_whatsapp'] = $request->boolean('notify_whatsapp');
        $agenda = Agenda::create($data);

        if ($agenda->notify_whatsapp) {
            $this->notifyManagement($agenda);
        }

        return redirect()->route('agenda.index')->with('success', 'Agenda Muda Cita berhasil ditambahkan!');
    }

    public function show(Agenda $agenda)
    {
        return view('admin.agenda.show', compact('agenda'));
    }

    public function edit(Agenda $agenda)
    {
        return view('admin.agenda.edit', compact('agenda'));
    }

    public function update(Request $request, Agenda $agenda)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'category' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);
        $data['notify_whatsapp'] = $request->boolean('notify_whatsapp');

        $agenda->update($data);

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil diperbarui.');
    }

    public function destroy(Agenda $agenda)
    {
        $agenda->delete();

        return back()->with('success', 'Agenda berhasil dihapus.');
    }

    private function notifyManagement(Agenda $agenda): void
    {
        $settings = Setting::first();
        $message = $this->buildAgendaMessage($agenda, $settings?->whatsapp_template);

        app(WhatsAppService::class)->sendToManagement($message);
    }

    private function buildAgendaMessage(Agenda $agenda, ?string $template = null): string
    {
        $date = $agenda->event_date;
        $time = trim(($agenda->start_time ?? '') . ' - ' . ($agenda->end_time ?? ''));
        $location = $agenda->location ? ('Lokasi: ' . $agenda->location) : '';
        $category = $agenda->category ? ('Kategori: ' . $agenda->category) : '';
        $description = $agenda->description ? ('Catatan: ' . $agenda->description) : '';

        if (!empty($template)) {
            return str_replace(
                ['{title}', '{date}', '{time}', '{location}', '{category}', '{description}'],
                [$agenda->title, $date, $time, $agenda->location ?? '-', $agenda->category ?? '-', $agenda->description ?? '-'],
                $template
            );
        }

        $parts = [
            'Agenda Baru Muda Cita',
            'Judul: ' . $agenda->title,
            'Tanggal: ' . $date,
            $time ? ('Waktu: ' . $time) : '',
            $location,
            $category,
            $description,
        ];

        return trim(implode("\n", array_filter($parts)));
    }

}
