import Echo from 'laravel-echo';
import './bootstrap';

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();
Echo.private('App.Models.User.' + userId)
    .notification(function(event){
        alert(event.body);
        var elms = document.querySelectorAll('.under-count')
        for (let index = 0; index < elms.length; index++) {
            const element = array[index];
            elms[index] . innerHTML = Number()
        }
        
    })