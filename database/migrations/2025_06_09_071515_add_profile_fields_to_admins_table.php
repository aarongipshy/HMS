<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->string('full_name')->nullable()->after('password');
            $table->string('email')->nullable()->after('full_name');
            $table->string('mobile')->nullable()->after('email');
            $table->string('photo')->nullable()->after('mobile');
            $table->text('address')->nullable()->after('photo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn(['full_name', 'email', 'mobile', 'photo', 'address']);
            $table->dropTimestamps();
        });
    }
};