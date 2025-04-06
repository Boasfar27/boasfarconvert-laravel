@extends('layouts.master')

@section('content')
    <main class="profile-page">
        <div class="container">
            <div class="page-header">
                <h1 class="page-title">Profil Saya</h1>
                <p class="page-subtitle">Kelola informasi akun dan preferensi Anda</p>
            </div>

            <div class="profile-container">
                <div class="profile-sidebar">
                    <div class="profile-avatar-container">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=8B5CF6&color=fff&size=200"
                            alt="{{ Auth::user()->name }}" class="profile-avatar">
                        <h2 class="profile-name">{{ Auth::user()->name }}</h2>
                        <p class="profile-email">{{ Auth::user()->email }}</p>
                        <p class="profile-role">
                            @if (Auth::user()->isAdmin())
                                <span class="badge badge-admin">Admin</span>
                            @elseif(Auth::user()->isPremium())
                                <span class="badge badge-premium">Premium</span>
                            @else
                                <span class="badge badge-user">User</span>
                            @endif
                        </p>
                    </div>
                    <div class="profile-menu">
                        <a href="#profile-info" class="profile-menu-item active">Informasi Profil</a>
                        <a href="#security" class="profile-menu-item">Keamanan</a>
                        @if (!Auth::user()->isPremium() && !Auth::user()->isAdmin())
                            <a href="{{ route('premium.index') }}" class="profile-menu-item premium-link">
                                <svg xmlns="http://www.w3.org/2000/svg" class="profile-menu-icon" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                Upgrade ke Premium
                            </a>
                        @endif
                    </div>
                </div>

                <div class="profile-content">
                    <div id="profile-info" class="profile-section">
                        <h3 class="section-title">Informasi Profil</h3>
                        <p class="section-description">Update informasi profil Anda</p>

                        <form class="profile-form" method="POST" action="#">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input id="name" type="text" class="form-control" name="name"
                                    value="{{ Auth::user()->name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="email" class="form-control" name="email"
                                    value="{{ Auth::user()->email }}" required>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>

                    <div id="security" class="profile-section">
                        <h3 class="section-title">Keamanan</h3>
                        <p class="section-description">Update password akun Anda</p>

                        <form class="profile-form" method="POST" action="#">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="current_password" class="form-label">Password Saat Ini</label>
                                <div class="password-input-wrapper">
                                    <input id="current_password" type="password" class="form-control"
                                        name="current_password" required>
                                    <button type="button" class="password-toggle"
                                        onclick="togglePasswordVisibility('current_password')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="eye-icon eye-open"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd"
                                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="eye-icon eye-closed"
                                            viewBox="0 0 20 20" fill="currentColor" style="display: none;">
                                            <path fill-rule="evenodd"
                                                d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z"
                                                clip-rule="evenodd" />
                                            <path
                                                d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="form-label">Password Baru</label>
                                <div class="password-input-wrapper">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    <button type="button" class="password-toggle"
                                        onclick="togglePasswordVisibility('password')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="eye-icon eye-open"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd"
                                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="eye-icon eye-closed"
                                            viewBox="0 0 20 20" fill="currentColor" style="display: none;">
                                            <path fill-rule="evenodd"
                                                d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z"
                                                clip-rule="evenodd" />
                                            <path
                                                d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                                <div class="password-input-wrapper">
                                    <input id="password_confirmation" type="password" class="form-control"
                                        name="password_confirmation" required>
                                    <button type="button" class="password-toggle"
                                        onclick="togglePasswordVisibility('password_confirmation')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="eye-icon eye-open"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd"
                                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="eye-icon eye-closed"
                                            viewBox="0 0 20 20" fill="currentColor" style="display: none;">
                                            <path fill-rule="evenodd"
                                                d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z"
                                                clip-rule="evenodd" />
                                            <path
                                                d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        function togglePasswordVisibility(inputId) {
            const passwordInput = document.getElementById(inputId);
            const eyeOpen = passwordInput.parentElement.querySelector('.eye-open');
            const eyeClosed = passwordInput.parentElement.querySelector('.eye-closed');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeOpen.style.display = 'none';
                eyeClosed.style.display = 'block';
            } else {
                passwordInput.type = 'password';
                eyeOpen.style.display = 'block';
                eyeClosed.style.display = 'none';
            }
        }

        // Scroll to sections when clicking on sidebar menu items
        document.addEventListener('DOMContentLoaded', function() {
            const menuItems = document.querySelectorAll('.profile-menu-item:not(.premium-link)');

            menuItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    if (this.getAttribute('href').startsWith('#')) {
                        e.preventDefault();

                        // Remove active class from all items
                        menuItems.forEach(i => i.classList.remove('active'));

                        // Add active class to clicked item
                        this.classList.add('active');

                        // Scroll to the section
                        const targetId = this.getAttribute('href');
                        const targetSection = document.querySelector(targetId);

                        if (targetSection) {
                            window.scrollTo({
                                top: targetSection.offsetTop - 100,
                                behavior: 'smooth'
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
