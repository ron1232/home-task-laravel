<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WhiteListIpAddressessMiddleware
{
    public function getIpCountryCode(string $ip) {
        if(app()->isLocal()) return "IL";

        $response = Http::get("http://ip-api.com/json/" . $ip);

        if(isset($response->object()->countryCode)) return $response->object()->countryCode;

        return "";
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $countryCode = $this->getIpCountryCode($request->getClientIp());
        if($countryCode !== "IL") abort(403, "You are restricted to access the site.");
        return $next($request);
    }
}
