<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DvInventory extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = 'dv_inventory';

    // Define which fields are mass assignable
    protected $fillable = [
        'transaction_no', 
        'program',
        'no_of_dv',
        'total_amount_program',
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
