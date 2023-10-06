<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class filters implements ValidationRule
{

    protected $forbidden; 


    public function __construct($forbidden)
    {
        $this->forbidden = $forbidden;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if($value ==$this->forbidden)
        {
            $fail('this name not allowed');
        }
    }
}
