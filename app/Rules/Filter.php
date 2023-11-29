<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Filter implements ValidationRule
{
    protected $filters = [];

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(in_array(strtolower($value),$this->filters)) {
        {
            $fail('this value cant be add.');
        }
    }
}
}
