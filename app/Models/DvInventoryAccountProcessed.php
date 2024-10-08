<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DvInventoryAccountProcessed extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'account_dv_inventory_processed';

    // Define which fields are mass assignable
    protected $fillable = [
        'transaction_no', 
        'payee',
        'no_processed_account_dv',
        'total_processed_account_dv',
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
