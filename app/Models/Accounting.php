<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounting extends Model
{
    use HasFactory;

    protected $table = 'accounting';
    protected $fillable = [
        'date_received',
        'dv_no',
        'dv_no2',
        'ap_no',
        'gross_amount',
        'tax',
        'other_deduction',
        'net_amount',
        'final_gross_amount',
        'final_net_amount',
        'program_unit',
        'date_returned_to_end_user',
        'date_complied_to_end_user',
        'no_of_days',
        'outgoing_processor',
        'outgoing_certifier',
        'remarks',
        'outgoing_date',
        'status',
    ];

    public function budget()
    {
        return $this->belongsTo(Budget::class, 'dv_no', 'dv_no');
    }

    public function cash()
    {
        return $this->hasOne(Cash::class, 'dv_no', 'dv_no');
    }

}
