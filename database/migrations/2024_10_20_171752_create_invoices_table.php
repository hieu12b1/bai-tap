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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique(); // Mã hóa đơn
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Khóa ngoại tới bảng người dùng
            $table->foreignId('voucher_id')->nullable()->constrained()->onDelete('set null'); // Khóa ngoại tới bảng voucher
            $table->decimal('total_amount', 10, 2); // Tổng số tiền
            $table->decimal('discount_amount', 10, 2)->default(0); // Số tiền giảm giá
            $table->string('status')->default('chua_thanh_toan'); // Trạng thái hóa đơn [Cancelled,Completed,Paid,Pending]
            $table->date('invoice_date')->nullable(); // Ngày hóa đơn
            $table->string('payment_method')->nullable(); // Phương thức thanh toán
            $table->string('payment_status')->default('chua_thanh_toan'); // Trạng thái thanh toán [Paid,Pending,Failed,Refunded]
            $table->text('notes')->nullable(); // Ghi chú
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
