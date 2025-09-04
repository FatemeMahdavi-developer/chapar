<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckMobileValidatorRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // if (!preg_match('/((0?9)|(\+?989))\d{9}/', $value)) {
        if (!preg_match('/^09\d{9}$/', $value)) {
            $fail('The ' . $attribute . ' format is incorrect.');
        }
    }
}
