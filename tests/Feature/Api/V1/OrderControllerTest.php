<?php

namespace Tests\Feature\Api\V1;

use App\Enums\Order\OrderStatusEnum;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_order()
    {
        $data = [
            'sender_name' => 'Ali',
            'sender_mobile' => '09123456789',
            'sender_address' => 'Tehran, Some Street 12',
            'sender_postal_code' => '1234567890',
            'receiver_name' => 'Sara',
            'receiver_mobile' => '09121234567',
            'receiver_address' => 'Tehran, Another Street 34',
            'receiver_postal_code' => '0987654321',
            'parcel_weight' => 1.250,
        ];

        $response = $this->postJson('/api/v1/order', $data);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'data' => [
                'id', 'barcode', 'status', 'sender_name', 'receiver_name'
            ]
        ]);

        $this->assertDatabaseHas('orders', [
            'sender_name' => 'Ali',
            'receiver_name' => 'Sara',
        ]);
    }

    /** @test */
    public function it_can_update_order_status()
    {
        $order = Order::factory()->create([
            'status' => OrderStatusEnum::REGISTERED
        ]);

        $response = $this->patchJson("/api/v1/order/{$order->barcode}/status", [
            'status' => OrderStatusEnum::PICKED_UP->value
        ]);

        $response->assertStatus(200);
        $this->assertEquals(OrderStatusEnum::PICKED_UP->value, $order->fresh()->status->value);
    }

    // /** @test */
    public function it_can_delete_an_order()
    {
        $order = Order::factory()->create([
            'status' => OrderStatusEnum::REGISTERED
        ]);

        $response = $this->deleteJson("/api/v1/order/{$order->id}");

        $response->assertStatus(200);
        $this->assertSoftDeleted('orders', ['id' => $order->id]);
    }

    // /** @test */
    public function it_can_list_orders()
    {
        $orders = Order::factory()->count(3)->create();

        $response = $this->getJson('/api/v1/order');

        $response->assertStatus(200);
        $response->assertJsonCount(3, 'data');

        $responseIds = collect($response->json('data'))->pluck('id');
        $this->assertEqualsCanonicalizing($orders->pluck('id')->toArray(), $responseIds->toArray());
    }
}
