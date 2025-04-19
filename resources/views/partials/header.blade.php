<header class="site-header">
    <div class="header-container">
        <div class="header-wrapper">
            <a href="{{ route('welcome') }}" class="header-brand">
                <img loading="lazy" src="{{ asset('images/logo.png') }}" alt="Boasfar Convert Logo" class="header-logo">
            </a>

            @guest
                <!-- Menu for Guest Users -->
                <div class="header-nav">
                    <a href="#features" class="header-nav-link">Fitur</a>
                    <a href="#how-it-works" class="header-nav-link">Cara Kerja</a>
                    <a href="#pricing" class="header-nav-link">Harga</a>
                </div>

                <div class="header-actions">
                    <a href="{{ route('login') }}" class="header-btn header-btn-login">Masuk</a>
                    <a href="{{ route('register') }}" class="header-btn header-btn-register">Daftar</a>
                </div>
            @else
                <!-- Menu for Authenticated Users -->
                {{-- <div class="header-nav">
                    <a href="{{ route('home') }}"
                        class="header-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Dashboard</a>
                    <a href="{{ route('convert.index') }}"
                        class="header-nav-link {{ request()->routeIs('convert.*') ? 'active' : '' }}">Konversi</a>
                    @if (Auth::user()->isPremium() || Auth::user()->isAdmin())
                        <a href="{{ route('premium.index') }}"
                            class="header-nav-link premium {{ request()->routeIs('premium.*') ? 'active' : '' }}">Premium</a>
                    @endif
                    @if (Auth::user()->isAdmin())
                        <a href="{{ route('admin.index') }}"
                            class="header-nav-link admin {{ request()->routeIs('admin.*') ? 'active' : '' }}">Admin</a>
                    @endif
                </div> --}}

                <div class="header-user">
                    <div class="header-dropdown" x-data="{ open: false }">
                        <button @click="open = !open" class="header-user-btn">
                            <img loading="lazy"
                                src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=8B5CF6&color=fff"
                                alt="{{ Auth::user()->name }}" class="header-user-avatar">
                            <span>{{ Auth::user()->name }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="header-dropdown-arrow" viewBox="0 0 20 20"
                                fill="currentColor" :class="{ 'transform rotate-180': open }">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="header-dropdown-menu"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            style="display: none;">
                            <div class="header-dropdown-header">
                                <img loading="lazy"
                                    src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=8B5CF6&color=fff&size=100"
                                    alt="{{ Auth::user()->name }}" class="header-dropdown-profile">
                                <div class="header-dropdown-info">
                                    <span class="header-dropdown-name">{{ Auth::user()->name }}</span>
                                    <span class="header-dropdown-email">{{ Auth::user()->email }}</span>
                                </div>
                            </div>

                            <div class="header-dropdown-divider"></div>

                            <a href="{{ route('profile.edit') }}" class="header-dropdown-item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="header-dropdown-icon" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Profil Saya</span>
                            </a>

                            <a href="{{ route('home') }}" class="header-dropdown-item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="header-dropdown-icon" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                </svg>
                                <span>Dashboard</span>
                            </a>

                            <a href="{{ route('convert.index') }}" class="header-dropdown-item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="header-dropdown-icon" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Konversi</span>
                            </a>

                            @if (Auth::user()->isPremium() || Auth::user()->isAdmin())
                                <a href="{{ route('premium.index') }}" class="header-dropdown-item premium-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="header-dropdown-icon" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <span>Premium</span>
                                </a>
                            @endif

                            @if (Auth::user()->isAdmin())
                                <a href="/admin" class="header-dropdown-item admin-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="header-dropdown-icon" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>Admin</span>
                                </a>
                            @endif

                            <div class="header-dropdown-divider"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="header-dropdown-item logout-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="header-dropdown-icon" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M3 3a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V7.414l-5-5H3zm6.293 11.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 1.414L7.414 10l1.879 1.879z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>Keluar</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endguest

            <!-- Mobile Menu Button -->
            <button class="header-mobile-toggle" id="mobile-menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div class="header-mobile-menu" id="mobile-menu">
            <div class="header-mobile-links">
                @guest
                    <a href="#features" class="header-mobile-item">Fitur</a>
                    <a href="#how-it-works" class="header-mobile-item">Cara Kerja</a>
                    <a href="#pricing" class="header-mobile-item">Harga</a>

                    <div class="header-mobile-actions">
                        <a href="{{ route('login') }}" class="header-btn header-btn-login header-btn-block">Masuk</a>
                        <a href="{{ route('register') }}"
                            class="header-btn header-btn-register header-btn-block">Daftar</a>
                    </div>
                @else
                    <div class="header-mobile-user">
                        <img loading="lazy"
                            src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=8B5CF6&color=fff"
                            alt="{{ Auth::user()->name }}" class="header-avatar">
                        <div class="header-user-info">
                            <span class="header-user-name">{{ Auth::user()->name }}</span>
                            <span class="header-user-email">{{ Auth::user()->email }}</span>
                        </div>
                    </div>

                    <div class="header-mobile-divider"></div>

                    <a href="{{ route('profile.edit') }}" class="header-mobile-item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="header-mobile-icon" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Profil Saya</span>
                    </a>

                    <a href="{{ route('home') }}" class="header-mobile-item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="header-mobile-icon" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('convert.index') }}" class="header-mobile-item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="header-mobile-icon" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Konversi</span>
                    </a>

                    @if (Auth::user()->isPremium() || Auth::user()->isAdmin())
                        <a href="{{ route('premium.index') }}" class="header-mobile-item premium-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="header-mobile-icon" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span>Premium</span>
                        </a>
                    @endif

                    @if (Auth::user()->isAdmin())
                        <a href="/admin" class="header-mobile-item admin-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="header-mobile-icon" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Admin</span>
                        </a>
                    @endif

                    <div class="header-mobile-divider"></div>

                    <form method="POST" action="{{ route('logout') }}" class="header-mobile-logout">
                        @csrf
                        <button type="submit" class="header-btn header-btn-logout header-btn-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="header-mobile-icon" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3 3a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V7.414l-5-5H3zm6.293 11.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 1.414L7.414 10l1.879 1.879z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Keluar</span>
                        </button>
                    </form>
                @endguest
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuToggle && mobileMenu) {
            mobileMenuToggle.addEventListener('click', function() {
                mobileMenuToggle.classList.toggle('is-active');
                mobileMenu.classList.toggle('is-active');
            });
        }
    });
</script>
