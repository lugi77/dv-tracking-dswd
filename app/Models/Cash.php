<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cash extends Model
{
    use HasFactory;
    protected $table = 'cash';
    protected $fillable = [
        'date_received',
        'dv_no',
        'payment_type',
        'check_ada_no',
        'gross_amount',
        'net_amount',
        'final_net_amount',
        'date_issued',
        'receipt_no',
        'remarks',
        'payee',
        'particulars',
        'outgoing_date',
        'status',
    ];

    public function accounting()
    {
        return $this->belongsTo(Accounting::class, 'dv_no', 'dv_no');
    }
}
