<?php

namespace App\Http\Requests\Api\V1\Order;

use App\Enums\Order\OrderStatusEnum;
use App\Http\Requests\Api\BaseRequest;
use Illuminate\Validation\Rule;

class UpdateStatusOrderRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status'=>['required',Rule::in(array_column(OrderStatusEnum::cases(), 'value'))]
        ];
    }
}
