@if (session()->has('message'))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 1500)" 
        x-show="show"
        class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-laravel text-white px-48 py-3"
        style="position: fixed;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        background-color: #ef3b2d;
        color: #fff;
        padding-left: 48px;
        padding-right: 48px;
        padding-top: 3px;
        padding-bottom: 3px;">
        <p>
            {{ session('message') }}
        </p>
    </div>
@endif