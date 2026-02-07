<?php

namespace App\Http\Controllers\Collaboration;

use App\Http\Controllers\Controller;
use App\Models\Collaboration;
use App\Models\Program;
use Illuminate\Http\Request;

class CollaborationController extends Controller
{
    public function index()
    {
        $collaborations = Collaboration::with('program')->orderByDesc('id')->paginate(10);

        return view('pages.collaboration.index', compact('collaborations'));
    }

    public function create()
    {
        $programs = Program::orderBy('name')->get();

        return view('pages.collaboration.create', compact('programs'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        Collaboration::create($data);

        return redirect()->route('collaborations.index')->with('success', 'Kolaborasi berhasil ditambahkan.');
    }

    public function show(Collaboration $collaboration)
    {
        $collaboration->load('program');

        return view('pages.collaboration.show', compact('collaboration'));
    }

    public function edit(Collaboration $collaboration)
    {
        $programs = Program::orderBy('name')->get();

        return view('pages.collaboration.edit', compact('collaboration', 'programs'));
    }

    public function update(Request $request, Collaboration $collaboration)
    {
        $data = $this->validateData($request);

        $collaboration->update($data);

        return redirect()->route('collaborations.index')->with('success', 'Kolaborasi berhasil diperbarui.');
    }

    public function destroy(Collaboration $collaboration)
    {
        $collaboration->delete();

        return redirect()->route('collaborations.index')->with('success', 'Kolaborasi berhasil dihapus.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'partner_name' => 'required|string|max:255',
            'partner_type' => 'required|string|max:255',
            'program_id' => 'nullable|exists:programs,id',
            'pilar' => 'nullable|in:pendidikan,sosial,lingkungan',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:planned,ongoing,completed,cancelled',
            'pic_name' => 'nullable|string|max:255',
            'pic_phone' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'documentation_url' => 'nullable|string|max:255',
        ]);
    }
}
