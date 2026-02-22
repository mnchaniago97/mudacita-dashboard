<?php

namespace App\Http\Controllers\SDM;

use App\Http\Controllers\Controller;
use App\Models\Management;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function index()
    {
        $managements = Management::latest()->paginate(10);

        $totalManagement    = Management::count();
        $activeManagement   = Management::where('status', 'active')->count();
        $inactiveManagement = Management::where('status', 'inactive')->count();

        return view('admin.sdm.management.index', compact(
            'managements',
            'totalManagement',
            'activeManagement',
            'inactiveManagement'
        ));
    }


    public function create()
    {
        return view('admin.sdm.management.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string',
            'email'   => 'required|email|unique:management,email',
            'phone'   => 'nullable',
            'jabatan' => 'required',
            'divisi'  => 'required|in:program,riset,media',
            'status'  => 'required|in:active,inactive',
        ]);

        $management = Management::create(attributes: [
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'jabatan'   => $request->jabatan,
            'divisi'    => $request->divisi,
            'status'    => $request->status,
            'joined_at' => now(),
        ]);

        $message = implode("\n", array_filter([
            'Selamat bergabung sebagai Management Muda Cita.',
            'Nama: ' . $management->name,
            'Divisi: ' . $management->divisi,
            'Jabatan: ' . $management->jabatan,
        ]));
        app(WhatsAppService::class)->sendToPhone($management->phone, $message);

        return redirect()
            ->route('sdm.management.index')
            ->with('success', 'Management berhasil ditambahkan');
    }

    public function edit(Management $management)
    {
        return view('admin.sdm.management.edit', compact('management'));
    }

    public function update(Request $request, Management $management)
    {
        $request->validate([
            'name'    => 'required|string',
            'email'   => 'required|email|unique:management,email,' . $management->id,
            'phone'   => 'nullable',
            'jabatan' => 'required',
            'divisi'  => 'required|in:program,riset,media',
            'status'  => 'required|in:active,inactive',
        ]);

        $management->update($request->all());

        return redirect()
            ->route('sdm.management.index')
            ->with('success', 'Management berhasil diupdate');
    }

    public function destroy(Management $management)
    {
        $management->delete();

        return back()->with('success', 'Management berhasil dihapus');
    }
}
