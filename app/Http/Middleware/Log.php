<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class Log
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $date = Carbon::now();
        $ip = $request->getClientIp();
        DB::table('logs')->insert([
            'date' => $date,
            'ip' => $ip,
            /* 'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s') */
        ]);
        return $next($request);
    }
}
