<?php

namespace App\Models;

use App\Enums\Order\OrderStatusEnum;
use App\Trait\DateConvert;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use DateConvert,SoftDeletes,HasFactory;

    protected $fillable = [
        'sender_name',
        'sender_mobile',
        'sender_address',
        'sender_postal_code',
        'receiver_name',
        'receiver_mobile',
        'receiver_address',
        'receiver_postal_code',
        'parcel_weight',
        'barcode',
        'status',
        'deleted_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->barcode)) {
                $order->barcode = self::generateBarcode();
            }
        });
    }

    /**
     * Generate barcode with check digit.
    */
    protected static function generateBarcode(): string
    {
        $attempts = 0;
        do {
            $code = (string) random_int(100000000,999999999);

            $sum = array_sum(str_split($code));
            $checkDigit = $sum % 10;
            $barcode = $code . $checkDigit;

            $attempts++;
            if ($attempts > 10) {
                throw new \Exception('Cannot generate a unique Barcode after multiple attempts.');
            }

        } while (self::where('barcode', $barcode)->exists());

        return $barcode;
    }

    protected $casts = [
        'parcel_weight' => 'decimal:3',
        'status'=> OrderStatusEnum::class
    ];

    public function scopeBarcode(Builder $query, $barcode)
    {
        return $query->where('barcode', $barcode);
    }

    public function scopeStatus(Builder $query, $status)
    {
        return $query->where('status', $status);
    }

}
