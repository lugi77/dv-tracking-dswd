<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DvInventoryUnprocessed extends Model
{
    use HasFactory;

    protected $table = 'dv_inventory_unprocessed';

    // Define which fields are mass assignable
    protected $fillable = [
        'transaction_no', 
        'program',
        'no_of_unprocessed_dv',
        'total_amount_unprocessed',
    ];

    // Define any relationships if necessary
    public function budget()
    {
        return $this->belongsTo(Budget::class, 'transaction_no', 'transaction_no');
    }

    public function cash()
    {
        return $this->hasMany(Cash::class);
    }
}
