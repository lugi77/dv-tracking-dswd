<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounting extends Model
{
    use HasFactory;

    protected $table = 'accounting';
    protected $fillable = [
        'transaction_no',
        'date_received',
        'dv_no',
        'ap_no',
        'gross_amount',
        'tax',
        'other_deduction',
        'net_amount',
        'program',
        'date_returned_to_end_user',
        'date_complied_to_end_user',
        'no_of_days',
        'outgoing_processor',
        'outgoing_certifier',
        'remarks',
        'orsNum',
        'particulars',
        'outgoing_date',
        'status',
        'payee',
        'appropriation'
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
        if ($action === 'updated' && $model->status === 'Sent to Cash') {
            return; // Skip logging this specific update
        }
        ActivityLog::create([
            'user_id' => auth()->id(), // Assuming you have user authentication
            'model_type' => class_basename($model),
            'model_id' => $model->transaction_no,
            'dv_no' => $model->dv_no,
            'user_name' => auth()->user()->name,
            'dswd_id' => auth()->user()->dswd_id,
            'action' => $action,
            'details' => "Budget entry with transaction no {$model->dv_no} has been {$action}.",
        ]);
    }

    public function accounting()
    {
        return $this->hasOne(Accounting::class, 'transaction_no', 'transaction_no');
    }

}
