<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MarkNotificationAsRead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->query('nid');
        if($id && $request->user()){ //فيه عندي يوزر لو رجعتلي اوبجكت بكون اليوزر عامل لوقن لو رجعتلي null بكون false
            $notification = $request->user()->unreadNotifications()->find($id);
            if ($notification) {
                $notification->markAsRead(); //ميثود جاهزة تحول الرسالة لرسالة مقروءة  
            }
        }
        return $next($request);
    }
}
