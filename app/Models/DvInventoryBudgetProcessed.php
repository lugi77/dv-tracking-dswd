<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DvInventoryBudgetProcessed extends Model
{
    use HasFactory;
    protected $table = 'budget_dv_inventory_processed';

    // Define which fields are mass assignable
    protected $fillable = [
        'transaction_no', 
        'program',
        'no_of_processed_dv',
        'total_amount_processed',
    ];

    // Define any relationships if necessary
    public function budget()
    {
        return $this->belongsTo(Budget::class, 'transaction_no', 'transaction_no');
    }

}
