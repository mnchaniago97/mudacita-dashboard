<?php

namespace App\Http\Controllers\SDM;

use App\Http\Controllers\Controller;
use App\Models\Management;
use App\Models\StaffPerformance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class StaffPerformanceController extends Controller
{
    public function index()
    {
        $managementList = Management::orderBy('name')->get(['id', 'name', 'jabatan']);

        if (!Schema::hasTable('staff_performances')) {
            $staffPerformanceSummary = $managementList->map(function ($row) {
                return [
                    'name' => $row->name,
                    'position' => $row->jabatan,
                    'perencanaan' => 0,
                    'pelaksanaan' => 0,
                    'kualitas' => 0,
                    'inovasi' => 0,
                    'evaluasi' => 0,
                    'analisis' => 0,
                    'kolaborasi' => 0,
                    'kepemimpinan' => 0,
                    'etika' => 0,
                    'dampak' => 0,
                    'total_score' => 0,
                    'notes' => null,
                    'programs_success' => 0,
                ];
            });
            $staffPerformanceRows = collect();

            return view('admin.sdm.management.performance', [
                'staffPerformance' => $staffPerformanceSummary,
                'staffPerformanceRows' => $staffPerformanceRows,
                'managementList' => $managementList,
            ]);
        }

        $latestPerformance = DB::table('staff_performances')
            ->select('management_id', DB::raw('MAX(id) as latest_id'))
            ->groupBy('management_id');

        $staffPerformanceSummary = DB::table('management as m')
            ->leftJoinSub($latestPerformance, 'latest', function ($join) {
                $join->on('m.id', '=', 'latest.management_id');
            })
            ->leftJoin('staff_performances as sp', function ($join) {
                $join->on('sp.id', '=', 'latest.latest_id');
            })
            ->select(
                'sp.id as performance_id',
                'm.name',
                'm.jabatan as position',
                'sp.perencanaan',
                'sp.pelaksanaan',
                'sp.kualitas',
                'sp.inovasi',
                'sp.evaluasi',
                'sp.analisis',
                'sp.kolaborasi',
                'sp.kepemimpinan',
                'sp.etika',
                'sp.dampak',
                'sp.notes',
                'sp.programs_success'
            )
            ->orderBy('m.name')
            ->get()
            ->map(function ($row) {
                $perencanaan = (int) ($row->perencanaan ?? 0);
                $pelaksanaan = (int) ($row->pelaksanaan ?? 0);
                $kualitas = (int) ($row->kualitas ?? 0);
                $inovasi = (int) ($row->inovasi ?? 0);
                $evaluasi = (int) ($row->evaluasi ?? 0);
                $analisis = (int) ($row->analisis ?? 0);
                $kolaborasi = (int) ($row->kolaborasi ?? 0);
                $kepemimpinan = (int) ($row->kepemimpinan ?? 0);
                $etika = (int) ($row->etika ?? 0);
                $dampak = (int) ($row->dampak ?? 0);
                $totalScore = $perencanaan + $pelaksanaan + $kualitas + $inovasi + $evaluasi + $analisis +
                    $kolaborasi + $kepemimpinan + $etika + $dampak;

                return [
                    'id' => $row->performance_id,
                    'name' => $row->name,
                    'position' => $row->position,
                    'perencanaan' => $perencanaan,
                    'pelaksanaan' => $pelaksanaan,
                    'kualitas' => $kualitas,
                    'inovasi' => $inovasi,
                    'evaluasi' => $evaluasi,
                    'analisis' => $analisis,
                    'kolaborasi' => $kolaborasi,
                    'kepemimpinan' => $kepemimpinan,
                    'etika' => $etika,
                    'dampak' => $dampak,
                    'total_score' => $totalScore,
                    'notes' => $row->notes,
                    'programs_success' => (int) ($row->programs_success ?? 0),
                ];
            });

        $staffPerformanceRows = DB::table('staff_performances as sp')
            ->join('management as m', 'm.id', '=', 'sp.management_id')
            ->select(
                'sp.id',
                'sp.created_at',
                'm.name',
                'm.jabatan as position',
                'sp.perencanaan',
                'sp.pelaksanaan',
                'sp.kualitas',
                'sp.inovasi',
                'sp.evaluasi',
                'sp.analisis',
                'sp.kolaborasi',
                'sp.kepemimpinan',
                'sp.etika',
                'sp.dampak'
            )
            ->orderByDesc('sp.created_at')
            ->get()
            ->map(function ($row) {
                $totalScore = (int) $row->perencanaan + (int) $row->pelaksanaan + (int) $row->kualitas +
                    (int) $row->inovasi + (int) $row->evaluasi + (int) $row->analisis + (int) $row->kolaborasi +
                    (int) $row->kepemimpinan + (int) $row->etika + (int) $row->dampak;

                return [
                    'id' => $row->id,
                    'created_at' => $row->created_at,
                    'name' => $row->name,
                    'position' => $row->position,
                    'perencanaan' => (int) $row->perencanaan,
                    'pelaksanaan' => (int) $row->pelaksanaan,
                    'kualitas' => (int) $row->kualitas,
                    'inovasi' => (int) $row->inovasi,
                    'evaluasi' => (int) $row->evaluasi,
                    'analisis' => (int) $row->analisis,
                    'kolaborasi' => (int) $row->kolaborasi,
                    'kepemimpinan' => (int) $row->kepemimpinan,
                    'etika' => (int) $row->etika,
                    'dampak' => (int) $row->dampak,
                    'total_score' => $totalScore,
                ];
            });

        return view('admin.sdm.management.performance', [
            'staffPerformance' => $staffPerformanceSummary,
            'staffPerformanceRows' => $staffPerformanceRows,
            'managementList' => $managementList,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'staff_id' => 'required|exists:management,id',
            'perencanaan' => 'required|integer|min:1|max:4',
            'pelaksanaan' => 'required|integer|min:1|max:4',
            'kualitas' => 'required|integer|min:1|max:4',
            'inovasi' => 'required|integer|min:1|max:4',
            'evaluasi' => 'required|integer|min:1|max:4',
            'analisis' => 'required|integer|min:1|max:4',
            'kolaborasi' => 'required|integer|min:1|max:4',
            'kepemimpinan' => 'required|integer|min:1|max:4',
            'etika' => 'required|integer|min:1|max:4',
            'dampak' => 'required|integer|min:1|max:4',
            'notes' => 'nullable|string',
        ]);

        if (!Schema::hasTable('staff_performances')) {
            return redirect()
                ->back()
                ->with('warning', 'Tabel staff_performances belum tersedia. Jalankan migration terlebih dahulu.');
        }

        $existingCount = StaffPerformance::where('management_id', $request->staff_id)->count();
        if ($existingCount >= 5) {
            return redirect()
                ->back()
                ->withErrors(['staff_id' => 'Penilaian untuk pengurus ini sudah mencapai batas 5 kali.'])
                ->withInput();
        }

        DB::table('staff_performances')->insert([
            'management_id' => $request->staff_id,
            'perencanaan' => $request->perencanaan,
            'pelaksanaan' => $request->pelaksanaan,
            'kualitas' => $request->kualitas,
            'inovasi' => $request->inovasi,
            'evaluasi' => $request->evaluasi,
            'analisis' => $request->analisis,
            'kolaborasi' => $request->kolaborasi,
            'kepemimpinan' => $request->kepemimpinan,
            'etika' => $request->etika,
            'dampak' => $request->dampak,
            'notes' => $request->notes,
            'programs_success' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Skor kinerja berhasil disimpan.');
    }

    public function edit(StaffPerformance $staffPerformance)
    {
        $managementList = Management::orderBy('name')->get(['id', 'name', 'jabatan']);

        return view('admin.sdm.management.performance-edit', [
            'staffPerformance' => $staffPerformance,
            'managementList' => $managementList,
        ]);
    }

    public function update(Request $request, StaffPerformance $staffPerformance)
    {
        $request->validate([
            'staff_id' => 'required|exists:management,id',
            'perencanaan' => 'required|integer|min:1|max:4',
            'pelaksanaan' => 'required|integer|min:1|max:4',
            'kualitas' => 'required|integer|min:1|max:4',
            'inovasi' => 'required|integer|min:1|max:4',
            'evaluasi' => 'required|integer|min:1|max:4',
            'analisis' => 'required|integer|min:1|max:4',
            'kolaborasi' => 'required|integer|min:1|max:4',
            'kepemimpinan' => 'required|integer|min:1|max:4',
            'etika' => 'required|integer|min:1|max:4',
            'dampak' => 'required|integer|min:1|max:4',
            'notes' => 'nullable|string',
        ]);

        $staffPerformance->update([
            'management_id' => $request->staff_id,
            'perencanaan' => $request->perencanaan,
            'pelaksanaan' => $request->pelaksanaan,
            'kualitas' => $request->kualitas,
            'inovasi' => $request->inovasi,
            'evaluasi' => $request->evaluasi,
            'analisis' => $request->analisis,
            'kolaborasi' => $request->kolaborasi,
            'kepemimpinan' => $request->kepemimpinan,
            'etika' => $request->etika,
            'dampak' => $request->dampak,
            'notes' => $request->notes,
        ]);

        return redirect()
            ->route('sdm.management-performance.index')
            ->with('success', 'Skor kinerja berhasil diperbarui.');
    }

    public function destroy(StaffPerformance $staffPerformance)
    {
        $staffPerformance->delete();

        return redirect()
            ->route('sdm.management-performance.index')
            ->with('success', 'Skor kinerja berhasil dihapus.');
    }
}
