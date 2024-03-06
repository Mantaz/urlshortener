<?php

namespace App\Rules;

use Ariaieboy\LaravelSafeBrowsing\Facades\LaravelSafeBrowsing;
use Illuminate\Contracts\Validation\Rule;

class UrlisSafe implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $urlIsSafe = LaravelSafeBrowsing::isSafeUrl($value, true);
        $threatTypes = config('laravel-safe-browsing.google.threatTypes');

        for ($i = 0; $i < count($threatTypes); $i++) {
            if ($threatTypes[$i] == $urlIsSafe) {
                return true;
            }
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The :attribute is not safe!';
    }
}
