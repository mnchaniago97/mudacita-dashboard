<?php

namespace App\Http\Controllers\SDM;

use App\Http\Controllers\Controller;
use App\Models\Volunteer;
use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VolunteerController extends Controller
{
    public function index()
    {
        $volunteers = Volunteer::latest()->paginate(10);

    $totalVolunteer = Volunteer::count();
    $activeVolunteer = Volunteer::where('status', 'active')->count();
    $inactiveVolunteer = Volunteer::where('status', 'inactive')->count();
    $newVolunteer = Volunteer::whereDate('created_at', '>=', now()->subDays(30))->count();

    return view('sdm.volunteer.index', compact(
        'volunteers',
        'totalVolunteer',
        'activeVolunteer',
        'inactiveVolunteer',
        'newVolunteer'
    ));
    }

    public function create()
{
    $users = User::orderBy('name')->get();
    $locations = Location::orderBy('name')->get();

    return view('sdm.volunteer.create', compact('users', 'locations'));
}

public function store(Request $request)
{
    $request->validate([
        'name'   => 'required|string|max:255',
        'email'  => 'required|email|unique:volunteers,email',
        'phone'  => 'required',
        'status' => 'required|in:active,inactive',
    ]);

    Volunteer::create([
        'name'      => $request->name,
        'email'     => $request->email,
        'phone'     => $request->phone,
        'status'    => $request->status,
        'joined_at' => now(),
    ]);

    return redirect()
        ->route('sdm.volunteers.index')
        ->with('success', 'Volunteer berhasil ditambahkan');
}



    public function edit(Volunteer $volunteer)
    {
        return view('sdm.volunteer.edit', compact('volunteer'));
    }

    public function update(Request $request, Volunteer $volunteer)
{
    $request->validate([
        'name'   => 'required|string|max:255',
        'email'  => 'required|email|unique:volunteers,email,' . $volunteer->id,
        'phone'  => 'required|string|max:20',
        'status' => 'required|in:active,inactive',
    ]);

    $volunteer->update([
        'name'   => $request->name,
        'email'  => $request->email,
        'phone'  => $request->phone,
        'status' => $request->status,
    ]);

    return redirect()
        ->route('sdm.volunteers.index')
        ->with('success', 'Volunteer berhasil diperbarui');
}

    public function destroy(Volunteer $volunteer)
    {
        $volunteer->delete();
        return back()->with('success','Deleted');
    }
}



