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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
                $table->foreignId('client_id')->constrained('clients')->onUpdate('cascade')
                ->onDelete('cascade');      
                $table->string('order_number')->unique();
                $table->string('academic_level');
                $table->float('coupon')->nullable();
                $table->float('total_amount');
                $table->integer('pages');
                $table->enum('payment_method',['cod','none','dpo','paypal'])->default('none');
                $table->enum('payment_status',['paid','unpaid'])->default('unpaid');
                $table->enum('status',['new','process','complete','cancelled'])->default('new');
                $table->string('deadline');
                $table->string('description')->nullable();
                $table->string('plan')->nullable();
                $table->string('spacing')->nullable();
                $table->string('type_of_work');
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
        Schema::dropIfExists('orders');
    }
};
