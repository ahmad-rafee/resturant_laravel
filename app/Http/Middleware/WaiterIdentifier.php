<?php

namespace App\Http\Middleware;

use App\Models\Waiter;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class WaiterIdentifier
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($token = $request->header('WAITER_TOKEN')) {
            $waiter_id = Crypt::decrypt($token);
            $waiter = Waiter::find($waiter_id);
            $request->request->add(['waiter_id' => $waiter_id]);
            $request->request->add(['waiter' => $waiter]);
            $request->request->add(['waiter_user' => $waiter->user]);
        }
        return $next($request);
    }
}
