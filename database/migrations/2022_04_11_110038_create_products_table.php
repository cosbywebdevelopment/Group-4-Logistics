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
            $table->decimal('length')->nullable();
            $table->decimal('height')->nullable();
            $table->decimal('width')->nullable();
            $table->text('pallets')->nullable();
            $table->text('max_weight')->nullable();
            $table->decimal('min_charge')->nullable();
            $table->decimal('per_mile')->nullable();
            $table->decimal('collection_5')->nullable();
            $table->decimal('collection_weekend')->nullable();
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
