import Echo from "laravel-echo";

import Pusher from "pusher-js";
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: pusherKey,
    cluster: pusherCluster,
    forceTLS: true
});

window.Echo.channel("chat").listen("RTOrderPlaceNotificationEvent", (e) => {
    console.log(e.message);
    // let html = `<a href="" class="dropdown-item">
    //                     <div class="dropdown-item-icon bg-info text-white">
    //                         <i class="fas fa-bell"></i>
    //                     </div>
    //                     <div class="dropdown-item-desc">
    //                         ${e.message}
    //                         <div class="time">Yesterday</div>
    //                     </div>
    //             </a>`;
    // $(".rt_notification").append(html);
});


