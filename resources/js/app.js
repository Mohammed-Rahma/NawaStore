import Echo from 'laravel-echo';
import './bootstrap';

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();
Echo.private('App.Models.User.' + userId)
    .notification(function(event){
        alert(event.body);
        var elms = document.querySelectorAll('.unread-count') //ترجع كل العناصر على شكل آرييي 
        for (let i = 0; i < elms.length; i++) {
            const element = array[i];
            elms[i].innerText = Number(elms[i].innerText) + 1; 
        }
        var list = document.querySelector('#notifications-list');
        list.innerHTML = `
        <a href="${event.link}?nid=${event.id}" class="dropdown-item">
            <i class="${event.icon} mr-2"></i>
            ${event.body}
            <span class="float-right text-muted text-sm">${event.time}</span>
        </a>
        <div class="dropdown-divider"></div>` + list.innerHTML;
        
    })