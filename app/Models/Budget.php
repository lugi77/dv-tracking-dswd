<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $table = 'budget';
    protected $fillable = [
        'dvNum',
        'accountID',
        'programID',
        'controllerID',
        'drnNum',
        'incomingDate',
        'payee',
        'particulars',
        'etal',
        'program',
        'controller',
        'gross_amount',
        'final_amount_norsa',
        'fund_cluster',
        'appropriation',
        'remarks',
        'orsNum',
        'outgoingDate',
        'status',
    ];
}
