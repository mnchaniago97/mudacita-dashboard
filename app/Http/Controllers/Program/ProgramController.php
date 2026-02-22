<?php

namespace App\Http\Controllers\Program;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Activity;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Menampilkan daftar program berdasarkan pilar.
     */
    public function index($pilar)
    {
        // Validasi pilar agar tidak sembarang input di URL
        $validPilar = ['pendidikan', 'sosial', 'lingkungan'];
        
        if (!in_array($pilar, $validPilar)) {
            abort(404);
        }

        // Ambil data hanya yang sesuai pilarnya
        $programs = Program::where('pilar', $pilar)->latest()->paginate(10);
        $tabData = $this->dummyTabData($pilar);
        $activities = Activity::with(['program', 'location'])
            ->whereHas('program', function ($query) use ($pilar) {
                $query->where('pilar', $pilar);
            })
            ->latest()
            ->get();

        return view('admin.pages.program.index', [
            'programs' => $programs,
            'currentPilar' => $pilar,
            'tabData' => $tabData,
            'activities' => $activities,
        ]);
    }

    public function show(Program $program)
    {
        // Mengambil program beserta aktivitas dan lokasinya
        // Ini mendukung keinginan Anda untuk melihat banyak item event di satu halaman
        $program->load(['activities.location']);

        return view('admin.pilar.program.show', [
            'program' => $program,
            'activities' => $program->activities
        ]);
    }

public function create()
{
    // Titik (.) digunakan sebagai pengganti slash (/) untuk folder
    return view('admin.pages.program.create'); 
}
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'pilar' => 'required|in:pendidikan,sosial,lingkungan',
            'description' => 'nullable',
        ]);

        Program::create($request->all());

        return redirect()
            ->route('pilar.index', $request->pilar)
            ->with('success', 'Program berhasil dibuat');
    }

    public function edit(Program $program)
    {
        return view('admin.pages.program.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $request->validate([
            'name' => 'required',
            'pilar' => 'required|in:pendidikan,sosial,lingkungan',
            'description' => 'nullable',
        ]);

        $program->update($request->all());

        return redirect()
            ->route('pilar.index', $program->pilar)
            ->with('success', 'Program berhasil diupdate');
    }

    public function destroy(Program $program)
    {
        $pilar = $program->pilar;
        $program->delete();
        return redirect()
            ->route('pilar.index', $pilar)
            ->with('success', 'Program dihapus');
    }

    private function dummyTabData(string $pilar): array
    {
        $titleMap = [
            'pendidikan' => 'Pendidikan',
            'sosial' => 'Sosial',
            'lingkungan' => 'Lingkungan',
        ];

        $base = $titleMap[$pilar] ?? ucfirst($pilar);

        return [
            'activities' => [
                [
                    'name' => "Kickoff $base",
                    'program' => "Program $base 01",
                    'datetime' => '2026-02-01 09:00',
                    'location' => 'Aula Utama',
                    'person_in_charge' => 'Koordinator 1',
                    'short_description' => "Pembukaan kegiatan pilar $base.",
                    'status' => 'Berjalan',
                    'documentation' => 'https://contoh.link/dokumentasi',
                ],
                [
                    'name' => "Koordinasi Relawan $base",
                    'program' => "Program $base 02",
                    'datetime' => '2026-02-03 14:00',
                    'location' => 'Ruang Rapat',
                    'person_in_charge' => 'Koordinator 2',
                    'short_description' => "Koordinasi teknis dan pembagian tugas.",
                    'status' => 'Direncanakan',
                    'documentation' => 'Foto/Link',
                ],
            ],
            'timesheets' => [
                ['name' => 'Koordinasi', 'hours' => '03:00', 'date' => '2026-02-02'],
                ['name' => 'Pelaksanaan', 'hours' => '05:30', 'date' => '2026-02-04'],
            ],
            'milestones' => [
                ['title' => "Rencana $base selesai", 'target' => '2026-02-10'],
                ['title' => "Evaluasi $base", 'target' => '2026-02-20'],
            ],
            'discussions' => [
                ['topic' => "Ide program $base", 'by' => 'Admin', 'date' => '2026-02-01'],
                ['topic' => "Kebutuhan relawan $base", 'by' => 'Koordinator', 'date' => '2026-02-03'],
            ],
        ];
    }
}
