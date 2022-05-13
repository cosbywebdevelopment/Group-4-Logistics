<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStripIdUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('sripe_id')->nullable();
            $table->string('position')->nullable();
            $table->string('mobile')->nullable();
            $table->string('company')->nullable();
            $table->string('address')->nullable();
            $table->string('vat')->nullable();
            $table->tinyInteger('credit')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('sripe_id');
            $table->dropColumn('position');
            $table->dropColumn('mobile');
            $table->dropColumn('company');
            $table->dropColumn('address');
            $table->dropColumn('vat');
            $table->dropColumn('credit');
        });
    }
}
