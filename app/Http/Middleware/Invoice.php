<?php

namespace App\Http\Middleware;

use App\Plan;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Invoice extends Middleware
{
    public function handle($request, Closure $next, $guard = null)
    {

        if (Auth::guard($guard)->check()) {
            $plan = Plan::find(auth()->user()->plan_id);
            if($plan){
                $last_plan = \App\Payment::where('user_id',auth()->id())->orderBy('id','desc')->first();
                if($plan->invoices  && \App\Task::where('user_id',auth()->id())->when($last_plan,function ($q) use ($last_plan) {
                                return $q->where('created_at',">=",$last_plan->created_at);
                            })->count() >= $plan->invoices){
                    return redirect('/')->withErrors(__('strings.invoice_limit'));
                }
            }
        }

        return $next($request);
    }
}
