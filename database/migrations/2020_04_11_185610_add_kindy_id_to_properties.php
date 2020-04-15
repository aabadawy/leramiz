<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKindyIdToProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->unsignedBigInteger('kind_id');

            
            $table->foreign('kind_id')->references('id')->on('kinds')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->unsignedBigInteger('kind_id');

            
            $table->foreign('kind_id')->references('id')->on('kinds')->onUpdate('cascade')->onDelete('cascade');
            
        });
    }
}
