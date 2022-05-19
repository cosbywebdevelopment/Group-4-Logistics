<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order', function (Blueprint $table) {
            Schema::table('orders', function (Blueprint $table) {
                $table->string('ref')->nullable();
                $table->string('pickup_contact')->nullable();
                $table->string('delivery_contact')->nullable();
                $table->text('delivery_info')->nullable();
                $table->string('size')->nullable();
                $table->string('weight')->nullable();
                $table->text('notes')->nullable();
                $table->tinyInteger('confirm')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->dropColumn('ref');
            $table->dropColumn('pickup_contact');
            $table->dropColumn('delivery_contact');
            $table->dropColumn('delivery_info');
            $table->dropColumn('size');
            $table->dropColumn('weight');
            $table->dropColumn('notes');
            $table->dropColumn('confirm');
        });
    }
}
