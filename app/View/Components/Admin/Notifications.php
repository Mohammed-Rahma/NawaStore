<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Notifications extends Component
{
    /**
     * Notification Collection عبارة عن الوبجكت الي بحتوي على الاشعار تاع اليوزر 
     */
    public $notifications;
    public $unread;


    public function __construct()
    {
        $user = Auth::user(); // بحدد اليوزر الي عامل تسجيل دخول عشان اجيب الاشعار تاعه فقط 
        
        $this->notifications = $user->notifications()->limit(5)->get(); //1-10000000 لارفيل معرفة العلاقة جاهزة بين الاشعارات والمستخدم 

        //unreadNotifications , readNotifications ,notifications
        $this->unread = $user->unreadNotifications()->count(); //هيك بتجيب العدد من الكويري 
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.notifications');
    }
}
