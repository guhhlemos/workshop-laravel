<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTrafficTicketToOwnershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ownerships', function (Blueprint $table) {
            $table->boolean('traffic_ticket')->after('lastname')->default(false);
        });

        /**
         * Atualizar atributos usando o método table
         *      $table->string('name', 50)->nullable()->change();
         * 
         * Renomear coluna
         *      $table->renameColumn('from', 'to');
         * 
         * Remover coluna
         *      $table->dropColumn('votes');
         *      $table->dropColumn(['votes', 'avatar', 'location']);
         *             
         */

        /**
         * atualizar tabela
         *      Schema::rename($from, $to);
         * 
         *      Schema::drop('users');
         *
         *      Schema::dropIfExists('users');
         */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ownerships', function (Blueprint $table) {
            $table->dropColumn('traffic_ticket');
        });
    }
}
