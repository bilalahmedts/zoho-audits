<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Audit;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\AuditRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AuditReportExport;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AuditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $audits = Audit::when($request, function ($query, $request) {
            $query->search($request);
        })->with('user','campaign','evaluator')->sortable()->orderBy('id', 'asc')->paginate(10);
        $users = User::all();
        return view('audits.index')->with(compact('audits','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('id', '!=', 1)->get();
        return view('audits.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuditRequest $request)
    {
        Audit::create($request->all());
        Session::flash('success', 'Audit Added successfully!');
        return redirect()->route('audits.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Audit $audit)
    {
        $users = User::where('id', '!=', 1)->get();
        return view('audits.edit', compact('audit','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AuditRequest $request, Audit $audit)
    {
        $audit->update($request->all());
        Session::flash('success', 'Audit updated successfully!');
        return redirect()->route('audits.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Audit $audit)
    {
        $audit->delete();
        return redirect()->back()->with('success', 'Audit deleted successfully!');
    }
    public function report(Request $request)
    {
        $query = new Audit;
        if ($request->has('start_date')) {
            if (!empty($request->start_date) && !empty($request->end_date)) {
                $start_date = Carbon::createFromFormat('d/m/Y', $request->start_date);
                $end_date = Carbon::createFromFormat('d/m/Y', $request->end_date);
                $query = $query->whereDate('created_at', '>=', $start_date->toDateString());
                $query = $query->whereDate('created_at', '<=', $end_date->toDateString());
            } elseif (!empty($request->start_date)) {
                $start_date = Carbon::createFromFormat('d/m/Y', $request->start_date);
                $query = $query->whereDate('created_at', $start_date->toDateString());
            }
            $audits = $query->paginate(10);
        }
         else {
            $audits = array();
        }
        return view('audits.audit-report', compact('audits'));
    }

    public function export(Request $request)
    {
        return Excel::download(new AuditReportExport($request), 'audit-report.xlsx');
    }

}
