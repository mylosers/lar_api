<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Redis;

class TextTime
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
        $key="time";
        $num=Redis::get($key);
        if($num>=10){
            die("超过次数限制");
        }
        echo 'num:'.$num;echo '<br>';
        Redis::incr($key);
        Redis::expire($key,10);
        echo date('Y-m-d H:i:s');echo "<hr>";
        return $next($request);
    }
}
