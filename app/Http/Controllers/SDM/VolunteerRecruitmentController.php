<?php

namespace App\Http\Controllers\SDM;

use App\Http\Controllers\Controller;
use App\Models\Volunteer;
use App\Models\VolunteerRecruitment;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VolunteerRecruitmentController extends Controller
{
    public function index()
    {
        $volunteerRecruitments = VolunteerRecruitment::latest()->paginate(10);

        return view('sdm.volunteer-recruitment.index', compact('volunteerRecruitments'));
    }

    public function create()
    {
        return view('sdm.volunteer-recruitment.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:volunteer_recruitments,email'],
            'phone' => ['nullable', 'string'],
            'alamat_lengkap' => ['nullable', 'string'],
            'tanggal_lahir' => ['nullable', 'date'],
            'jenis_kelamin' => ['nullable', Rule::in(['laki-laki', 'perempuan'])],
            'pendidikan_terakhir' => ['nullable', 'string'],
            'motivasi' => ['nullable', 'string'],
            'minat' => ['nullable', 'string'],
            'skill' => ['nullable', 'string'],
            'komitmen' => ['nullable', 'string'],
            'harapan' => ['nullable', 'string'],
        ]);
        $photoPath = null;

        $volunteerRecruitment = VolunteerRecruitment::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'alamat_lengkap' => $validated['alamat_lengkap'] ?? null,
            'photo_path' => $photoPath,
            'tanggal_lahir' => $validated['tanggal_lahir'] ?? null,
            'jenis_kelamin' => $validated['jenis_kelamin'] ?? null,
            'pendidikan_terakhir' => $validated['pendidikan_terakhir'] ?? null,
            'motivasi' => $validated['motivasi'] ?? null,
            'minat' => $validated['minat'] ?? null,
            'skill' => $validated['skill'] ?? null,
            'komitmen' => $validated['komitmen'] ?? null,
            'harapan' => $validated['harapan'] ?? null,
            'status_recruitment' => 'pending',
            'applied_at' => now(),
        ]);

        $message = implode("\n", array_filter([
            'Pendaftaran Volunteer Baru',
            'Nama: ' . $volunteerRecruitment->name,
            $volunteerRecruitment->phone ? ('No. HP: ' . $volunteerRecruitment->phone) : '',
        ]));
        app(WhatsAppService::class)->sendToManagement($message);

        if (!auth()->check()) {
            return redirect()
                ->route('public.recruitment.success', ['type' => 'volunteer'])
                ->with('success', 'Pendaftaran berhasil. Tim kami akan menghubungi Anda.');
        }

        return redirect()
            ->route('sdm.volunteer-recruitment.index')
            ->with('success', 'Volunteer recruitment berhasil ditambahkan');
    }

    public function show(VolunteerRecruitment $volunteerRecruitment)
    {
        return view('sdm.volunteer-recruitment.show', compact('volunteerRecruitment'));
    }

    public function edit(VolunteerRecruitment $volunteerRecruitment)
    {
        return view('sdm.volunteer-recruitment.edit', compact('volunteerRecruitment'));
    }

    public function update(Request $request, VolunteerRecruitment $volunteerRecruitment)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('volunteer_recruitments', 'email')->ignore($volunteerRecruitment->id)],
            'phone' => ['nullable', 'string'],
            'alamat_lengkap' => ['nullable', 'string'],
            'tanggal_lahir' => ['nullable', 'date'],
            'jenis_kelamin' => ['nullable', Rule::in(['laki-laki', 'perempuan'])],
            'pendidikan_terakhir' => ['nullable', 'string'],
            'motivasi' => ['nullable', 'string'],
            'minat' => ['nullable', 'string'],
            'skill' => ['nullable', 'string'],
            'komitmen' => ['nullable', 'string'],
            'harapan' => ['nullable', 'string'],
        ]);


        $volunteerRecruitment->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'alamat_lengkap' => $validated['alamat_lengkap'] ?? null,
            'tanggal_lahir' => $validated['tanggal_lahir'] ?? null,
            'jenis_kelamin' => $validated['jenis_kelamin'] ?? null,
            'pendidikan_terakhir' => $validated['pendidikan_terakhir'] ?? null,
            'motivasi' => $validated['motivasi'] ?? null,
            'minat' => $validated['minat'] ?? null,
            'skill' => $validated['skill'] ?? null,
            'komitmen' => $validated['komitmen'] ?? null,
            'harapan' => $validated['harapan'] ?? null,
        ]);

        $volunteerRecruitment->save();

        return redirect()
            ->route('sdm.volunteer-recruitment.index')
            ->with('success', 'Volunteer recruitment berhasil diupdate');
    }

    public function destroy(VolunteerRecruitment $volunteerRecruitment)
    {
        $volunteerRecruitment->delete();

        return back()->with('success', 'Volunteer recruitment berhasil dihapus');
    }

    public function approve(VolunteerRecruitment $volunteerRecruitment)
    {
        if ($volunteerRecruitment->status_recruitment === 'accepted') {
            return back()->with('success', 'Volunteer recruitment sudah diterima');
        }

        if (Volunteer::where('email', $volunteerRecruitment->email)->exists()) {
            return back()->withErrors(['email' => 'Email sudah terdaftar sebagai volunteer']);
        }

        Volunteer::create([
            'name' => $volunteerRecruitment->name,
            'email' => $volunteerRecruitment->email,
            'phone' => $volunteerRecruitment->phone ?? '',
            'status' => 'active',
            'joined_at' => now(),
            'location_id' => null,
        ]);

        $volunteerRecruitment->status_recruitment = 'accepted';
        $volunteerRecruitment->accepted_at = now();
        $volunteerRecruitment->save();

        $applicantMessage = implode("\n", array_filter([
            'Selamat! Pendaftaran volunteer Anda diterima.',
            'Nama: ' . $volunteerRecruitment->name,
        ]));
        app(WhatsAppService::class)->sendToPhone($volunteerRecruitment->phone, $applicantMessage);

        return back()->with('success', 'Volunteer recruitment diterima dan masuk ke volunteers');
    }

    public function reject(Request $request, VolunteerRecruitment $volunteerRecruitment)
    {
        $request->validate([
            'rejection_reason' => ['nullable', 'string'],
        ]);

        $volunteerRecruitment->status_recruitment = 'rejected';
        $volunteerRecruitment->rejected_at = now();
        $volunteerRecruitment->rejection_reason = $request->rejection_reason;
        $volunteerRecruitment->save();

        $rejectMessage = implode("\n", array_filter([
            'Pendaftaran volunteer Anda belum dapat kami terima.',
            'Nama: ' . $volunteerRecruitment->name,
            $volunteerRecruitment->rejection_reason ? ('Alasan: ' . $volunteerRecruitment->rejection_reason) : '',
        ]));
        app(WhatsAppService::class)->sendToPhone($volunteerRecruitment->phone, $rejectMessage);

        return back()->with('success', 'Volunteer recruitment ditolak');
    }
}
