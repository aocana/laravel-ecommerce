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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->string('stripe_id')->unique();
            $table->float('price');
            $table->string('file_path');
            $table->integer('stock');
            $table->integer('sku');
            $table->boolean('is_visible');

            $table->foreignId('category_id')
                ->constrained('categories')
                ->nullOnDelete()
                ->nullable();

            $table->foreignId('brand_id')
                ->constrained('brands')
                ->nullOnDelete()
                ->nullable();

            $table->timestamps();
            $table->softDeletes();
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
};
