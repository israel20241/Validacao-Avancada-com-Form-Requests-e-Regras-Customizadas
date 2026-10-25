<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NomeCompostoRule implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $partes = explode(' ', trim($value));
        if (count($partes) < 2) {
            $fail('O campo :attribute deve conter nome e sobrenome (pelo menos duas palavras).');
        }
    }
}