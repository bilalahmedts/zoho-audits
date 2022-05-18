<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Kyslik\ColumnSortable\Sortable;

class Audit extends Model
{
    use HasFactory, Sortable;
    protected $table = 'evaluations';
    protected $fillable = [
        'user_id',
        'evaluationStatus',
        'comments',
        'zoho_id',
    ];
    protected static function boot()
    {
        parent::boot();

        Audit::creating(function ($model) {
            $model->evaluated_by = Auth::user()->id ?? '1';
        });
        Audit::updating(function ($model) {
            $model->evaluated_by = Auth::user()->id ?? '1';
        });
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function campaign()
    {
        return $this->hasOne(Campaign::class, 'id', 'campaign_id');
    }
    public function evaluator()
    {
        return $this->hasOne(User::class, 'id', 'evaluated_by');
    }
    public function getCreatedAtAttribute($date)
    {
        $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
        return $formatedDate;
    }
    public function scopeSearch($query, $request)
    {

        if ($request->has('zoho_id')) {
            if (!empty($request->zoho_id)) {
                $query = $query->where('zoho_id', 'LIKE', "%{$request->zoho_id}%");
            }
        }

        if ($request->has('user_id')) {
            if (!empty($request->user_id)) {
                $query = $query->where('user_id', $request->user_id);
            }
        }
        if ($request->has('evaluationStatus')) {
            if (!empty($request->evaluationStatus)) {
                $query = $query->where('evaluationStatus', $request->evaluationStatus);
            }
        }
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
        return $query;
    }
}
