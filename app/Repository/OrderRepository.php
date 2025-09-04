<?php

namespace App\Repository;

use App\Interface\OrderInterface;
use App\Models\Order;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class OrderRepository implements OrderInterface
{
    protected Order $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function getAllOrders() :mixed
    {
        return QueryBuilder::for($this->model)
            ->allowedSorts('created_at')
            ->allowedFilters([
                AllowedFilter::scope('status'),
                AllowedFilter::scope('barcode'),
            ])->when(!request()->has('perPage'), function ($q) {
                return $q->get();
            })
            ->when(request()->has('perPage'), function ($q) {
                return $q->paginate(request()->get('perPage'))->appends(request()->query());
            });
    }

    public function createOrder(array $data): Order
    {
        return $this->model->create($data);
    }


    public function getWhereFirstOrder(array $where) : ?Order
    {
        return QueryBuilder::for($this->model)
            ->where($where)
            ->first();
    }

    public function updateOrder(Order $order,array $data) :Order
    {
        $order->update($data);
        return $order;
    }


    public function getOrderById(int $id)
    {
        return Order::query()->find($id)->first();
    }

    public function deleteOrder(Order $order) :bool
    {
        return $order->delete();
    }

}
