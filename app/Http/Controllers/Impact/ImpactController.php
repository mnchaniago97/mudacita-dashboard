<?php

namespace App\Http\Controllers\Impact;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Impact;
use App\Models\Program;
use App\Models\Report;
use App\Models\Volunteer;


class ImpactController extends Controller
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

        return view('admin.pages.impact.index', [
            'reports' => Report::with('author')->latest()->get(),
            'totalProgram' => Program::count(),
            'totalActivity' => Activity::count(),
            'totalVolunteer' => Volunteer::count(),
            'totalImpact' => Impact::sum('beneficiaries'),
            'projectReportChart' => [
                'categories' => $programStats->pluck('name'),
                'series' => $programStats->pluck('activities_count'),
            ],
            'teamProgress' => $teamProgress,
        ]);
    }
}
