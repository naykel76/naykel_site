<nav class="navbar">
    <div class="flex-centered gap-05">
        <a href="{{ url('/') }}" class="flex">
            <x-logo class="to-md:hidden" />
            <x-favicon class="md:hidden" />
        </a>
        {{-- <div class="txt-2 font-bold">{{ Str::upper(config('app.name')) }}</div> --}}
    </div>

    <ul class="menu to-md:hidden">
        <li><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
    </ul>

    <button class="btn sm primary">Sign In</button>
</nav>
