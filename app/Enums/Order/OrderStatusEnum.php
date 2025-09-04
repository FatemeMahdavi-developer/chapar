<?php

namespace App\Enums\Order;

enum OrderStatusEnum : string
{
    case REGISTERED   = 'Registered';
    case PICKED_UP    = 'PickedUp';
    case SORTED       = 'Sorted';
    case DISPATCHED   = 'Dispatched';
    case DELIVERED    = 'Delivered';
}
