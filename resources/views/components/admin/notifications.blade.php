<a class="nav-link" data-toggle="dropdown" href="#">
    <i class="far fa-bell"></i>
    <span class=" unread-count badge badge-warning navbar-badge">{{$unread}}</span>
</a>
<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
    <span class="dropdown-header"><span class="unread-count">{{$unread}}</span> Notifications<span class="unread-count"></span></span>

    <div class="dropdown-divider"></div>
    <div id="notifications-list">
        @foreach($notifications as $notification)
        <a href="{{$notification->data['link']}}?nid={{$notification->id}}" class="dropdown-item">
            <i class="{{ $notification->data['icon']}}  mr-2"></i>
            {{ $notification->data['body'] }}
            <span class="float-right text-muted text-sm">{{$notification->created_at->diffForHumans(null , true ,true)}}</span>
            <!--
             created_at->diffForHumans(null , true ,true) null عشان تاخد الوقت الحالي  
                                              true  عشان تختصر في الاحرف 
                                       created_at بتم مقارنة الوقت الحالي مع وقت 
            -->
        </a>
        <div class="dropdown-divider"></div>
        @endforeach
    </div>
    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
</div>