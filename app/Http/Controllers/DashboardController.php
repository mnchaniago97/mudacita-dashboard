<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Volunteer;
use App\Models\Program;
use App\Models\Activity;
use App\Models\Impact;
use App\Models\Management;
use App\Models\Collaboration;

class DashboardController extends Controller
{
    public function index()
{
    $totalVolunteer = Volunteer::count();
    $totalManagement = Management::count();
    $totalProgram = Program::count();
    $totalActivity = Activity::count();
    $totalImpact = Impact::sum('beneficiaries');
    $collaborationTotal = Collaboration::count();

    $managementByDivisi = [
        'program' => Management::where('divisi', 'program')->count(),
        'riset' => Management::where('divisi', 'riset')->count(),
        'media' => Management::where('divisi', 'media')->count(),
    ];
    $managementTotalForPercent = max(1, $totalManagement);
    $managementDivisiPercent = [
        'program' => round(($managementByDivisi['program'] / $managementTotalForPercent) * 100),
        'riset' => round(($managementByDivisi['riset'] / $managementTotalForPercent) * 100),
        'media' => round(($managementByDivisi['media'] / $managementTotalForPercent) * 100),
    ];

    $programByPilar = [
        'pendidikan' => Program::where('pilar', 'pendidikan')->count(),
        'sosial' => Program::where('pilar', 'sosial')->count(),
        'lingkungan' => Program::where('pilar', 'lingkungan')->count(),
    ];

    $activitiesByStatus = [
        'planned' => Activity::where('status', 'planned')->count(),
        'ongoing' => Activity::where('status', 'ongoing')->count(),
        'completed' => Activity::where('status', 'completed')->count(),
    ];

    return view('dashboard.index', [
        'totalVolunteer' => $totalVolunteer,
        'totalManagement' => $totalManagement,
        'totalProgram' => $totalProgram,
        'totalActivity' => $totalActivity,
        'totalImpact' => $totalImpact,
        'managementByDivisi' => $managementByDivisi,
        'managementDivisiPercent' => $managementDivisiPercent,
        'programByPilar' => $programByPilar,
        'activitiesByStatus' => $activitiesByStatus,
        'collaborationTotal' => $collaborationTotal,
    ]);
}
}

