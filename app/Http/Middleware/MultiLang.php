<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Illuminate\Support\Facades\Cookie;
use phpDocumentor\Reflection\Location;

class MultiLang
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


//        dd(geoip()->getLocation(\Request::ip()));

        $cookie = Cookie::get('lang');
        if(!$cookie){
            $country = geoip()->getLocation('2.255.249.17');
            if($country['country'] == 'Denmark'){
                App::setLocale('danish');
                setcookie("lang", "danish", time()+180*24*60*60);
            }else{
                App::setLocale('en');
                setcookie("lang", "en", time()+180*24*60*60);
            }
        }else{
            App::setLocale($cookie);
        }
        return $next($request);
    }
}
