<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Audit;

class DashboardController extends Controller
{
    public function index()
    {
        $passedEvaluations = Audit::where('evaluationStatus', 'Passed')->count('evaluationStatus');
        $failedEvaluations = Audit::where('evaluationStatus', 'Failed')->count('evaluationStatus');
        $totalEvaluations = Audit::count('evaluationStatus');
        return view('dashboard')->with(compact('passedEvaluations','failedEvaluations','totalEvaluations'));
    }

}
