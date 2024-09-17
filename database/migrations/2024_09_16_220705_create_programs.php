<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('adoption')->nullable();
            $table->string('aics')->nullable();
            $table->string('angels_haven')->nullable();
            $table->string('bangun')->nullable();
            $table->string('bfirst')->nullable();
            $table->string('btms')->nullable();
            $table->string('cbb')->nullable();
            $table->string('ccam')->nullable();
            $table->string('ccsn')->nullable();
            $table->string('centenarian')->nullable();
            $table->string('center_fo_rentention')->nullable();
            $table->string('center_dr')->nullable();
            $table->string('climate_change')->nullable();
            $table->string('comm_based')->nullable();
            $table->string('comprehensive')->nullable();
            $table->string('crcf')->nullable();
            $table->string('drrp')->nullable();
            $table->string('epahp')->nullable();
            $table->string('fo_programs_centers')->nullable();
            $table->string('food_stamp')->nullable();
            $table->string('gass')->nullable();
            $table->string('ha')->nullable();
            $table->string('hgw')->nullable();
            $table->string('hrmdd')->nullable();
            $table->string('ictms')->nullable();
            $table->string('internal_audit')->nullable();
            $table->string('isso')->nullable();
            $table->string('kc_kkb')->nullable();
            $table->string('kc_ncddp')->nullable();
            $table->string('kc_pamana')->nullable();
            $table->string('kc_pmnp')->nullable();
            $table->string('led_sec')->nullable();
            $table->string('lingap_sa_masa')->nullable();
            $table->string('nhtspr')->nullable();
            $table->string('pamana_psb')->nullable();
            $table->string('pamana_slp')->nullable();
            $table->string('pamana_drmd')->nullable();
            $table->string('pantawid')->nullable();
            $table->string('pdpb')->nullable();
            $table->string('pdps')->nullable();
            $table->string('proper')->nullable();
            $table->string('pwd')->nullable();
            $table->string('qrf')->nullable();
            $table->string('rrcy')->nullable();
            $table->string('rrtp')->nullable();
            $table->string('rscc')->nullable();
            $table->string('sfp')->nullable();
            $table->string('slp')->nullable();
            $table->string('sms')->nullable();
            $table->string('socpen')->nullable();
            $table->string('soctech')->nullable();
            $table->string('standards')->nullable();
            $table->string('stb')->nullable();
            $table->string('swidb')->nullable();
            $table->string('tara')->nullable();
            $table->string('tct')->nullable();
            $table->string('trust_fund')->nullable();
            $table->string('total')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
