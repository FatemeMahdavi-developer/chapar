<?php

namespace App\Http\Requests\Api\V1\Order;

use App\Http\Requests\Api\BaseRequest;
use App\Rules\CheckMobileValidatorRule;
use App\Rules\CheckParcelWeightValidatorRule;

class StoreOrderRequest extends BaseRequest
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
            'sender_name'        => ['required', 'string', 'min:3','max:255'],
            'sender_mobile'      => ['required', 'digits:11', new CheckMobileValidatorRule],
            'sender_address'     => ['required', 'string', 'min:10','max:255'],
            'sender_postal_code' => ['nullable', 'string','digits:10'],
            'receiver_name'        => ['required', 'string', 'min:3','max:255'],
            'receiver_mobile'      => ['required', 'digits:11', new CheckMobileValidatorRule],
            'receiver_address'     => ['required', 'string', 'min:10','max:255'],
            'receiver_postal_code' => ['nullable', 'string','digits:10'],
            'parcel_weight'      => ['required','numeric','min:0',new CheckParcelWeightValidatorRule]
        ];
    }
}
