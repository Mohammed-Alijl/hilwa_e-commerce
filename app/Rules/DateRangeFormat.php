<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DateRangeFormat implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value !== null) {
            $dateRange = explode(' to ', $value);

            if (count($dateRange) !== 2) {
                $fail("The :attribute is not in the correct date range format.");
            } else {
                $startDate = strtotime(trim($dateRange[0]));
                $endDate = strtotime(trim($dateRange[1]));

                if (!$startDate || !$endDate || $endDate < $startDate)
                    $fail("The :attribute is not in the correct date range format.");
            }
        }


    }
}
