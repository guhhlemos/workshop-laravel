<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers_licenses', function (Blueprint $table) {
            $table->id();
            $table->string('cnh');
            $table->timestamp('issue_date');
            $table->timestamp('expiration_date')->nullable();

            $table->unsignedBigInteger('ownership_id')->nullable();
            $table->foreign('ownership_id')
                ->references('id')
                ->on('ownerships')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            // $table->foreignId('ownership_id')->constrained();

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
        Schema::dropIfExists('drivers_licenses');
    }
}
