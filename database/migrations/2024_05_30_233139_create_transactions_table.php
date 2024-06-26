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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('supplier_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('type', ['entry', 'exit', 'adjustment']);
            $table->integer('quantity');
            $table->timestamp('transaction_date');
            $table->timestamps();
        });
    }
    
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
   
};
