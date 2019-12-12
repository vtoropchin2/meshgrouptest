<?php declare(strict_types=1);

namespace App\Http\Middleware;


use Closure;

/**
 * Class TransformsRequest
 * @package App\Http\Middleware
 */
class MergeParameters
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $routeParameters = [];
        foreach ($request->route()->parameters() as $k => $value) {
            $value = (string)(int)$value === $value ? (int)$value : $value;
            $value = (string)(double)$value === $value ? (double)$value : $value;
            $value = is_string($value) && $value === '' ? null : $value;

            $routeParameters[$k] = $value;
        }

        $request->request->add($routeParameters);

        return $next($request);
    }
}
