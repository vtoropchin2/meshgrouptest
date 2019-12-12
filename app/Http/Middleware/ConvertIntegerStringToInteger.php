<?php declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TransformsRequest;

/**
 * Class ConvertNumericStringToNumeric
 * @package App\Http\Middleware
 */
class ConvertIntegerStringToInteger extends TransformsRequest
{
    /** @inheritDoc */
    public function transform($key, $value)
    {
        return (string)(int)$value === $value ? (int)$value : $value;
    }
}
