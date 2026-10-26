<div class="site-actions">
    @auth
        <details class="site-account">
            <summary>Account</summary>
            <div class="bx">
                <strong>{{ auth()->user()->name }}</strong>
                @if (Route::has('dashboard'))
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                @endif
                @if (Route::has('logout'))
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-gt-button type="submit">Log out</x-gt-button>
                    </form>
                @endif
            </div>
        </details>
    @else
        @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
        @else
            <x-gt-button disabled title="Registration is not configured yet">Register</x-gt-button>
        @endif
        @if (Route::has('login'))
            <a class="btn primary" href="{{ route('login') }}">Log in</a>
        @else
            <x-gt-button class="primary" disabled title="Login is not configured yet">Log in</x-gt-button>
        @endif
    @endauth
</div>
