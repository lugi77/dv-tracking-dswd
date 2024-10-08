<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DvInventoryAccountUnprocessed extends Model
{
    use HasFactory;

    protected $table = 'account_dv_inventory_unprocessed';

    // Define which fields are mass assignable
    protected $fillable = [
        'transaction_no', 
        'payee',
        'no_unprocessed_account_dv',
        'total_unprocessed_account_dv',
    ];

    // Define any relationships if necessary
    public function budget()
    {
        return $this->belongsTo(Budget::class, 'transaction_no', 'transaction_no');
    }

    public function accounting()
    {
        return $this->hasMany(Accounting::class);
    }
}
