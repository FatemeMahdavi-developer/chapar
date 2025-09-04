<?php

namespace App\Interface;

use App\Models\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface OrderInterface
{
    public function getAllOrders() :mixed;

    public function createOrder(array $data): Order;

    public function getWhereFirstOrder(array $where) :?Order;

    public function getOrderById(int $id);

    public function updateOrder(Order $order,array $data) :Order;

    public function deleteOrder(Order $id);
}
