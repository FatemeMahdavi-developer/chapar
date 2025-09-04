<?php

namespace Database\Factories;

use App\Enums\Order\OrderStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sender_name' => $this->faker->name,
            'sender_mobile' => '0913' . $this->faker->numerify('#######'),
            'sender_address' => $this->faker->address,
            'sender_postal_code' => $this->faker->phoneNumber,
            'receiver_name' => $this->faker->name,
            'receiver_mobile' => '09' . $this->faker->numerify('#########'),
            'receiver_address' => $this->faker->address,
            'receiver_postal_code' => $this->faker->numerify('##########'),
            'parcel_weight' => $this->faker->randomFloat(3,0.1,50),
            'status' => OrderStatusEnum::REGISTERED,
            'barcode' => $this->faker->numerify('#########').'0',
        ];
    }

}
