<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programs extends Model
{
    use HasFactory;

    protected $table = 'programs';

    protected $fillable = [
        'adoption',
        'aics',
        'angels_haven',
        'bangun',
        'bfirst',
        'btms',
        'cbb',
        'ccam',
        'ccsn',
        'centenarian',
        'center_fo_rentention',
        'center_dr',
        'climate_change',
        'comm_based',
        'comprehensive',
        'crcf',
        'drrp',
        'epahp',
        'fo_programs_centers',
        'food_stamp',
        'gass',
        'ha',
        'hgw',
        'hrmdd',
        'ictms',
        'internal_audit',
        'isso',
        'kc_kkb',
        'kc_ncddp',
        'kc_pamana',
        'kc_pmnp',
        'led_sec',
        'lingap_sa_masa',
        'nhtspr',
        'pamana_psb',
        'pamana_slp',
        'pamana_drmd',
        'pantawid',
        'pdpb',
        'pdps',
        'proper',
        'pwd',
        'qrf',
        'rrcy',
        'rrtp',
        'rscc',
        'sfp',
        'slp',
        'sms',
        'socpen',
        'soctech',
        'standards',
        'stb',
        'swidb',
        'tara',
        'tct',
        'trust_fund',
        'total',
    ];

    public function accountingEntries()
    {
        return $this->hasMany(Accounting::class, 'program');
    }
}
