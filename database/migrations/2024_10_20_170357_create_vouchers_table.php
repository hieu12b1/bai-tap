<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\SanPham;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->decimal('discount_amount', 10, 2); // Số tiền giảm giá
            $table->string('discount_type'); // Loại giảm giá (percentage hoặc fixed)
            $table->date('start_date'); // Ngày bắt đầu
            $table->date('end_date'); // Ngày kết thúc
            $table->integer('usage_limit')->nullable(); // Giới hạn số lần sử dụng
            $table->integer('minimum_order_amount')->nullable(); // Số tiền tối thiểu để sử dụng voucher
            $table->foreignIdFor(SanPham::class)->constrained(); // Khóa ngoại tới bảng sản phẩm
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
