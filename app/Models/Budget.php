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

    public function accounting()
    {
        return $this->hasOne(Accounting::class, 'transaction_no', 'transaction_no');
    }

    public function cash()
    {
        return $this->hasOne(Cash::class, 'transaction_no', 'transaction_no');
    }

    public function dvInventory()
    {
        return $this->belongsTo(DvInventory::class);
    }
}
