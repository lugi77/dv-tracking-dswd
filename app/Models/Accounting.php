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
        'dvNum',
        'dvNum2',
        'ap_no',
        'gross_amount',
        'tax',
        'other_deduction',
        'net_amount',
        'final_gross_amount',
        'final_net_amount',
        'program_unit',
        'date_returned_to_end_user',
        'date_compiled_to_end_user',
        'no_of_days',
        'outgoing_processor',
        'outgoing_certifier',
        'remarks',
        'outgoing_date',
        'action',
    ];
}
