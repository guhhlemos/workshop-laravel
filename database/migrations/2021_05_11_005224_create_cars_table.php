<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('manufacturer');
            $table->string('model');
            $table->integer('model_year');

            $table->unsignedBigInteger('ownership_id')->nullable();
            $table->foreign('ownership_id')
                ->references('id')
                ->on('ownerships')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->timestamps();
            // $table->foreignId('ownership_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
