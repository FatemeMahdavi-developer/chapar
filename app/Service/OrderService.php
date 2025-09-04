<?php

namespace App\Service;

use App\Enums\Order\OrderStatusEnum;
use App\Models\Order;
use App\Repository\OrderRepository;
use App\RestFullApi\Facade\ApiResponse;
use Symfony\Component\HttpFoundation\Response;

class OrderService
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getAllOrders(): mixed
    {
        return $this->orderRepository->getAllOrders();
    }

    public function createOrder(array $data): Order
    {
        return $this->orderRepository->createOrder($data);
    }

    public function getWhereFirstOrder(array $where): ?Order
    {
        return $this->orderRepository->getWhereFirstOrder($where);
    }

    public function updateOrder(Order $order,array $data): ?Order
    {
        return $this->orderRepository->updateOrder($order,$data);
    }

    public function deleteOrder(Order $order)
    {
        if ($order->status->name==OrderStatusEnum::REGISTERED->name) {
            return $this->orderRepository->deleteOrder($order);
        }

        return ApiResponse::withMessage('It is not possible to delete this order')
        ->withStatus(Response::HTTP_FORBIDDEN)
        ->Builder();
    }
}
