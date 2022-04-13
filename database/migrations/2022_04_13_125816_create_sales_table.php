<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            /**
             * code_transaksi
             * tanggal_transaksi
             * customer
             * item 
             * qty
             * total_diskon
             * total_harga
             * total_bayar
             */
            $table->id();
            $table->string('transaction_code');
            $table->date('transaction_date');
            $table->integer('quantity');
            $table->integer('total_discount');
            $table->integer('total_price');
            $table->integer('total_checkout');
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
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
        Schema::dropIfExists('sales');
    }
}
