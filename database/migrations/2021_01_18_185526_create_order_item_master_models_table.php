<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemMasterModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_item_master_model', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->string('customer_name');
            $table->string('phone');
            $table->string('address');
            $table->string('item_name');
            $table->integer('qty');
            $table->string('uom');
            $table->integer('item_price');
            $table->integer('total_price');
            $table->string('status');
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
        Schema::dropIfExists('order_item_master_model');
    }
}
