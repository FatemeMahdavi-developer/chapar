<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Lang;

class CheckParcelWeightValidatorRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^\d{1,5}(\.\d{1,3})?$/', (string) $value)) {
            $fail('The ' . __($attribute) . ' must be a valid weight with up to 3 decimal : Maximum 5 digits before the decimal point and maximum 3 digits before the decimal point');
        }
    }
}
