<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ownerships', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('cpf');
            $table->timestamps();

            /********************************* 
             * Alguns tipos comuns são:
             * 
             * $table->string
             * $table->text
             * $table->boolean
             * $table->timestamp
             * $table->decimal
             * $table->integer
             * $table->increments - bigIncrements - smallIncrements
             * $table->unsignedInteger ...
             * $table->foreign
             * $table->binary -> BLOB
             */

            /********************************* 
             * Modificadores
             * 
             * ->after('column')
             * Ex.: $table->after('password', function ($table) {
             *       $table->string('address_line1');
             *       $table->string('address_line2');
             *       $table->string('city');
             *   });
             * 
             * ->autoIncrement()
             * ->comment('my comment')
             * ->nullable($value = true)
             * ->unsigned()
             * 
             */

            /**
             * Indices
             * 
             * $table->primary(['id', 'parent_id']);
             * $table->string('email')->unique();
             * $table->index('state');
             */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ownerships');
    }
}
