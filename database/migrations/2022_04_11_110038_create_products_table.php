<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->decimal('length');
            $table->decimal('height');
            $table->decimal('width');
            $table->text('pallets');
            $table->text('max_weight');
            $table->decimal('min_charge');
            $table->decimal('per_mile');
            $table->decimal('collection_5');
            $table->decimal('collection_weekend');
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
        Schema::dropIfExists('products');
    }
}
