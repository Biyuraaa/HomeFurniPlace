<div class="header-container">
    <div class="logo">
        <a href="{{ route('welcome') }}">HomeFurniPlace</a>
    </div>
    <div class="input-field">
        <input type="text" placeholder="Search in HomeFurniPlace">
        <i class="fa-solid fa-magnifying-glass"></i>
    </div>
    <div class="user-data">

        @if (Auth::check())
            <div class="user-details">
                <a href="{{ route('profile-user.index') }}" style="text-decoration: none;">
                    <i class="fa-solid fa-user" id="user-button" style="color: gray"></i>
                    <span class="text-black">Profile</span>
                </a>
            </div>
            <div class="cart-details">
                <a href="{{ route('carts.index') }}" style="text-decoration: none;">
                    <i class="fa-solid fa-cart-shopping" id="cart-button" style="color: gray"></i>
                    <span class="text-black">Cart</span>
                </a>
            </div>
            <div class="logout-details">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" style="background-color: transparent; border: none;">
                        <i class="fa-solid fa-sign-out" id="logout-button" style="color: gray"></i>
                        <span class="text-black">Logout</span>
                    </button>
                </form>
            </div>
        @else
            <div class="auth-buttons">
                <a href="{{ route('login') }}" class="login-button">
                    Login
                </a>
                <a href="{{ route('register') }}" class="register-button">
                    Register
                </a>
            </div>
        @endif
    </div>
</div>
