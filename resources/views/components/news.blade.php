@props(['notifications'])
@auth
    
<div id="notifications-container" style="position: relative;">
    <div
    id="notifications"
    class="bg-gray-50 border-2 rounded"
    style="
            position: absolute;
            left: 0;
            transform: translateY(-50%);
            border-color: black;
            height: 75vh;
            padding: 4px;
            width: 300px;
            margin-left: 45px;
            z-index: 999;
            top: 272px;
            overflow-y: auto;
        "
    >
        <h3 class="text-xl font-bold m-2 text-center">Novosti</h3>
        <div class="border border-gray-200 w-full mb-6 mt-6"></div>
        <ul>
            @foreach ($notifications as $notification)
            <li class="ml-3"><i class="fa-solid fa-minus mb-4"></i> {{ $notification->title }}</li>
            @endforeach
        </ul>
    </div>
</div>

@endauth
<script>
    const notificationsContainer = document.getElementById("notifications-container");
    const notificationsDiv = document.getElementById("notifications");

    window.addEventListener("scroll", function () {
        const scrollY = window.scrollY || window.pageYOffset;

        if (scrollY >= 500) {
            notificationsDiv.style.position = "fixed";
            const n = 272 + 90;
            console.log(n)
            notificationsDiv.style.top = n + 'px';
        } else {
            notificationsDiv.style.position = "absolute";
            notificationsDiv.style.top = 272+'px'; // Reset the top property
        }
    });
</script>
