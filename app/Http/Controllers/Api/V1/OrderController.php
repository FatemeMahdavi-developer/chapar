<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Order\StoreOrderRequest;
use App\Http\Requests\Api\V1\Order\UpdateStatusOrderRequest;
use App\Http\Resources\Api\V1\Order\ListOrderResource;
use App\Http\Resources\Api\V1\Order\StoreOrderResource;
use App\Models\Order;
use App\RestFullApi\Facade\ApiResponse;
use App\Service\OrderService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return ListOrderResource::collection($this->orderService->getAllOrders($request));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
       return StoreOrderResource::make($this->orderService->createOrder($request->validated()));
    }

    /**
     * Update status order By barcode
     */
    public function updateStatus(UpdateStatusOrderRequest $request, $barcode)
    {
        $order= $this->orderService->getWhereFirstOrder(['barcode'=>$barcode]);

        if(is_null($order)){
            return ApiResponse::withMessage('No order found with this barcode')->withStatus(Response::HTTP_NOT_FOUND)->Builder();
        }

        $this->orderService->updateOrder($order,$request->validated());

        return ListOrderResource::make($order);
    }

    public function destroy(Order $order)
    {
        return $this->orderService->deleteOrder($order);
    }
}
