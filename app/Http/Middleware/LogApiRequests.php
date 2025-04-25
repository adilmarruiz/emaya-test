<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\AuditLog;

class LogApiRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Opcional: ignora rutas como login/logout
        if (!str_starts_with($request->path(), 'api')) {
            return $response;
        }

        AuditLog::create([
            'user_id' => auth('sanctum')->id(),
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'payload' => json_encode($request->except(['password', 'token'])), // sanitiza sensible
        ]);

        return $response;
    }
}
