<?php

namespace App\Exports;

use App\Models\Audit;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class AuditReportExport implements FromView, ShouldAutoSize, WithHeadings
{

    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'ZOHO ID',
            'Agent Name',
            'Campaign',
            'Evaluation Status',
            'Comments',
            'Evaluated By',
            'Evaluation Date'
        ];
    }
    public function view(): View
    {
        $request = $this->request;
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
        }
        $audits = $query->get();

        return view('audits.audit-report-table',[
            'audits' => $audits
        ]);
    }
}
