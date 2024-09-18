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
        'program',
        'no_of_dv',
        'total_amount_program',
    ];

    // Define any relationships if necessary
    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }

    public function cash()
    {
        return $this->hasMany(Cash::class);
    }
}
