<?php

use App\Enums\Order\OrderStatusEnum;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('sender_name');
            $table->string('sender_mobile', 11);
            $table->string('sender_address');
            $table->string('sender_postal_code')->nullable();
            $table->string('receiver_name');
            $table->string('receiver_mobile', 11);
            $table->string('receiver_address');
            $table->string('receiver_postal_code')->nullable();
            $table->decimal('parcel_weight',8,3)->default(0); // max:99,999.999 kg
            $table->string('barcode',10)->unique();
            $table->enum('status', array_column(OrderStatusEnum::cases(), 'value'))
            ->default(OrderStatusEnum::REGISTERED->value);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
