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
            $table->id();
            $table->string('name');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id', 'user_fk_1453554')->references('id')->on('users');
            $table->decimal('purchase_price', 9, 3);
            $table->decimal('price', 9, 3);
            $table->unsignedInteger('customer_id');
            $table->foreign('customer_id', 'customer_fk_1453554')->references('id')->on('users');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->text('note')->nullable();
            $table->timestamp('created_by')->nullable();
            $table->timestamp('deleted_by')->nullable();
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
        Schema::dropIfExists('sales');
    }
}
