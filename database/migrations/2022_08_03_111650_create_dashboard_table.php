<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dashboard', function (Blueprint $table) {
            $table->integer('user_id')->primary();
            $table->string('weather_city')->nullable();
            $table->tinyInteger('time_format')->default(0)->comment("0 = 12h, 1 = 24h");
            $table->tinyInteger('time_include_seconds')->default(1)->comment("0 = no, 1 = yes");
            $table->integer("update_period")->default(2);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dashboard');
    }
};
