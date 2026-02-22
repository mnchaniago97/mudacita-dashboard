<?php

namespace App\Http\Controllers\Program;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Program;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ActivityController extends Controller
{
    // Tampilkan semua activity
    public function index(Request $request)
    {
        $pilar = $request->query('pilar');
        $validPilar = ['pendidikan', 'sosial', 'lingkungan'];

        $activitiesQuery = Activity::with(['program', 'location']);
        if ($pilar && in_array($pilar, $validPilar, true)) {
            $activitiesQuery->whereHas('program', function ($query) use ($pilar) {
                $query->where('pilar', $pilar);
            });
        }

        $activities = $activitiesQuery->latest()->get();

        return view('admin.activity.index', compact('activities', 'pilar'));
    }

    // Tampilkan form create
    public function create()
    {
        $pilar = request()->query('pilar');
        $validPilar = ['pendidikan', 'sosial', 'lingkungan', 'digital'];

        $programsQuery = Program::query();
        if ($pilar && in_array($pilar, $validPilar, true)) {
            $programsQuery->where('pilar', $pilar);
        }

        $programs = $programsQuery->get();
        $locations = Location::all();
        $selectedProgramId = request()->query('program_id');
        return view('admin.activity.create', compact('programs', 'locations', 'selectedProgramId', 'pilar'));
    }

    // Detail activity
    public function show(Activity $activity)
    {
        $activity->load(['program', 'location']);

        return view('admin.activity.detail', compact('activity'));
    }

    // Simpan activity baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'location_id' => 'required|exists:locations,id',
            'title' => 'required|string|max:255',
            'activity_datetime' => 'required|date',
            'person_in_charge' => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'status' => ['required', Rule::in(['planned', 'ongoing', 'completed'])],
            'documentation_url' => 'nullable|url',
            'documentation_photo' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
        ]);

        $data['activity_date'] = Carbon::parse($data['activity_datetime'])->toDateString();

        if ($request->hasFile('documentation_photo')) {
            $data['documentation_photo_path'] = $request->file('documentation_photo')
                ->store('activities', 'public');
        }

        Activity::create($data);

        return redirect()->route('activity.index')->with('success', 'Activity ditambahkan');
    }

    // Tampilkan form edit
    public function edit(Activity $activity)
    {
        $programs = Program::all();
        $locations = Location::all();
        return view('admin.activity.edit', compact('activity', 'programs', 'locations'));
    }

    // Update activity
    public function update(Request $request, Activity $activity)
    {
        $data = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'location_id' => 'required|exists:locations,id',
            'title' => 'required|string|max:255',
            'activity_datetime' => 'required|date',
            'person_in_charge' => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'status' => ['required', Rule::in(['planned', 'ongoing', 'completed'])],
            'documentation_url' => 'nullable|url',
            'documentation_photo' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
        ]);

        $data['activity_date'] = Carbon::parse($data['activity_datetime'])->toDateString();

        if ($request->hasFile('documentation_photo')) {
            if ($activity->documentation_photo_path) {
                Storage::disk('public')->delete($activity->documentation_photo_path);
            }
            $data['documentation_photo_path'] = $request->file('documentation_photo')
                ->store('activities', 'public');
        }

        $activity->update($data);

        return redirect()->route('activity.index')->with('success', 'Activity berhasil diperbarui');
    }

    // Hapus activity
    public function destroy(Activity $activity)
    {
        if ($activity->documentation_photo_path) {
            Storage::disk('public')->delete($activity->documentation_photo_path);
        }
        $activity->delete();
        return back()->with('success', 'Activity dihapus');
    }

    // Public list by pilar
    public function publicIndex($type)
    {
        $validPilar = ['pendidikan', 'sosial', 'lingkungan', 'digital'];
        if (!in_array($type, $validPilar, true)) {
            abort(404);
        }

        $appSettings = \App\Models\Setting::first();
        $activities = Activity::with(['program', 'location'])
            ->whereHas('program', fn($q) => $q->where('pilar', $type))
            ->latest()
            ->paginate(9);

        return view('public.activities.index', compact('appSettings', 'activities', 'type'));
    }

    // Public detail
    public function publicShow(Activity $activity)
    {
        $activity->load(['program', 'location']);
        $appSettings = \App\Models\Setting::first();

        return view('public.activities.detail', compact('appSettings', 'activity'));
    }
}
