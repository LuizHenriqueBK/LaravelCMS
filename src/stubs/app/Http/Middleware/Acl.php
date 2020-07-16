<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;

class Acl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();

        $search     = ['/admin\./', '/(index|show)/', '/(create|store)/', '/(edit|update)/', '/destroy/'];
        $replace    = ['', 'read','create', 'update', 'delete'];

        $permission = preg_replace($search, $replace, $request->route()->getName());

        if ($user->isAdmin() || $user->hasPermission($permission)) {
            return $next($request);
        }

        if ($request->expectsJson()) {
            return response()->json(['error' => __('this action is unauthorized!')], 401);
        }

        return redirect()
            ->back()
            ->withError(Str::ucfirst(__('this action is unauthorized!')))
            ->withToastError(Str::ucfirst(__('this action is unauthorized!')))
            ->withInput();
    }
}
