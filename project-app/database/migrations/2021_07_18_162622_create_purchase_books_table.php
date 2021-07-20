<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_books', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_purchase');
            $table->foreign('id_purchase')->references('id')->on('purchases');
            $table->integer('id_book');
            $table->foreign('id_book')->references('id')->on('book');
            $table->enum('status', ['reserved', 'paid', 'canceled'])->default('reserved')->nullable(false);
            $table->double('price_book', 10, 2);
            $table->double('discount', 10, 2)->nullable(false);
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
        Schema::dropIfExists('purchase_books');
    }
}
