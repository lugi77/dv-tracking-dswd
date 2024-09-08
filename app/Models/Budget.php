<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $table = 'budget';
    protected $fillable = [
       'dv_no', 'drn_no', 'incomingDate', 'payee', 'particulars', 'etal',
        'program', 'budget_controller', 'gross_amount', 'final_amount_norsa',
        'fund_cluster', 'appropriation', 'remarks', 'orsNum', 'outgoingDate',
        'status'
    ];

    public function accounting()
    {
        return $this->hasOne(Accounting::class, 'dv_no', 'dv_no');
    }
}
