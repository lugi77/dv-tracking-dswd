<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Budget extends Model
{
    use HasFactory;

    protected $primaryKey = 'transaction_no';
    public $incrementing = false; // Because transaction_no is not auto-incrementing
    protected $keyType = 'string';
    protected $table = 'budget';
    protected $fillable = [
        'transaction_no',
        'dv_no',
        'drn_no',
        'incomingDate',
        'payee',
        'particulars',
        'etal',
        'program',
        'budget_controller',
        'gross_amount',
        'final_amount_norsa',
        'fund_cluster',
        'appropriation',
        'remarks',
        'orsNum',
        'outgoingDate',
        'status'
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            self::logActivity($model, 'created');
        });

        static::updated(function ($model) {
            self::logActivity($model, 'updated');
        });

        static::deleted(function ($model) {
            self::logActivity($model, 'deleted');
        });
    }

    protected static function logActivity($model, $action)
    {
        if ($action === 'updated' && $model->status === 'Sent to Accounting') {
            return; // Skip logging this specific update
        }
        ActivityLog::create([
            'user_id' => auth()->id(), // Assuming you have user authentication
            'model_type' => get_class($model),
            'model_id' => $model->transaction_no,
            'user_name' => auth()->user()->name,
            'dswd_id' => auth()->user()->dswd_id,
            'action' => $action,
            'details' => "Budget entry with transaction no {$model->transaction_no} has been {$action}.",
        ]);
    }

    public function accounting()
    {
        return $this->hasOne(Accounting::class, 'transaction_no', 'transaction_no');
    }

    public function cash()
    {
        return $this->hasOne(Cash::class, 'transaction_no', 'transaction_no');
    }
}
