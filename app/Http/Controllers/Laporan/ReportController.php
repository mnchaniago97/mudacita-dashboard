<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Program;
use App\Models\Activity;
use App\Models\Volunteer;
use App\Models\Management;
use App\Models\Impact;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $programStats = Program::withCount([
            'activities',
            'activities as completed_activities_count' => function ($query) {
                $query->where('status', 'completed');
            },
        ])->orderBy('name')->get();

        $teamProgress = $programStats->map(function ($program) {
            $total = (int) $program->activities_count;
            $completed = (int) $program->completed_activities_count;
            $percent = $total > 0 ? (int) round(($completed / $total) * 100) : 0;

            return [
                'name' => $program->name,
                'total' => $total,
                'completed' => $completed,
                'percent' => $percent,
            ];
        });

        return view('pages.report.index', [
            'reports' => Report::with('author')->get(),
            'totalProgram' => Program::count(),
            'programByPilar' => [
                'pendidikan' => Program::where('pilar', 'pendidikan')->count(),
                'sosial' => Program::where('pilar', 'sosial')->count(),
                'lingkungan' => Program::where('pilar', 'lingkungan')->count(),
            ],
            'totalActivity' => Activity::count(),
            'activitiesByStatus' => [
                'planned' => Activity::where('status', 'planned')->count(),
                'ongoing' => Activity::where('status', 'ongoing')->count(),
                'completed' => Activity::where('status', 'completed')->count(),
            ],
            'totalVolunteer' => Volunteer::count(),
            'totalManagement' => Management::count(),
            'totalImpact' => Impact::sum('beneficiaries'),
            'upcomingAgendas' => Agenda::orderBy('event_date')->limit(4)->get(),
            'projectReportChart' => [
                'categories' => $programStats->pluck('name'),
                'series' => $programStats->pluck('activities_count'),
            ],
            'teamProgress' => $teamProgress,
            'programStats' => $programStats,
        ]);
    }

    public function store(Request $request)
    {
        Report::create([
            'title' => $request->title,
            'content' => $request->content,
            'created_by' => Auth::id(),
        ]);

        return back()->with('success', 'Laporan dibuat');
    }
}
