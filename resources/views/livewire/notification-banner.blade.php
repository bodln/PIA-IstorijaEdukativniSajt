<div>
    <marquee direction="left" behavior="scroll" scrollamount="4">
        @foreach ($notifications as $notification)
            {{ $notification->title }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        @endforeach
    </marquee>
</div>
