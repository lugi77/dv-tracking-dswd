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
        'outgoing_date',
        'status',
    ];

    public function accounting()
    {
        return $this->hasOne(Accounting::class, 'transaction_no', 'transaction_no');
    }

}
