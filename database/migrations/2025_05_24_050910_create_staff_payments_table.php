<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('staff_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('staff_id');
            $table->integer('amount');
            $table->string('payment_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('staff_payments');
    }
};
