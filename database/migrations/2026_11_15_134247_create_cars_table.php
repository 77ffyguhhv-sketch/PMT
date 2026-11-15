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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('brand');                        // الشركة المصنعة (مثل: Toyota)
            $table->string('model');                        // موديل السيارة (مثل: Camry 2024)
            $table->string('plate_number')->unique();       // رقم اللوحة (لا يتكرر)
            $table->decimal('daily_rate', 8, 2);            // سعر الإيجار اليومي
            $table->string('status')->default('available'); // الحالة: available (متاحة) أو rented (مؤجرة)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};