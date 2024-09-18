<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cash extends Model
{
    use HasFactory;
    protected $table = 'cash';
    protected $fillable = [
        'transaction_no',
        'date_received',
        'dv_no',
        'payment_type',
        'check_ada_no',
        'gross_amount',
        'net_amount',
        'program',
        'date_issued',
        'receipt_no',
        'remarks',
        'payee',
        'particulars',
        'outgoing_date',
        'status',
    ];

    public function budget()
    {
        return $this->belongsTo(Budget::class, 'transaction_no', 'transaction_no');
    }
}
