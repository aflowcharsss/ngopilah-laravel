<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            /**
             * nama
             * contact
             * email
             * alamat
             * diskon
             * tipe_diskon
             * ktp
             */
            $table->id();
            $table->string('name');
            $table->string('contact');
            $table->string('email');
            $table->string('address');
            $table->integer('discount');
            $table->enum('discount_type', ['percentage', 'fixed']);
            $table->string('identity');
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
        Schema::dropIfExists('customers');
    }
}
