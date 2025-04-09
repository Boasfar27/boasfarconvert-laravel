@extends('layouts.master')

@section('content')
    <main class="auth-page">
        <div class="container">
            <div class="auth-container">
                <div class="auth-card" data-aos="fade-up">
                    <div class="auth-header">
                        <h1>Verifikasi Email</h1>
                        <p>Silakan verifikasi email Anda untuk mengakses fitur lengkap</p>
                    </div>

                    <div class="auth-content">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                Link verifikasi baru telah dikirim ke email Anda.
                            </div>
                        @endif

                        <p class="mb-4">
                            Sebelum melanjutkan, silakan periksa email Anda untuk link verifikasi.
                            Jika Anda tidak menerima email tersebut, klik tombol di bawah untuk meminta link baru.
                        </p>

                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Kirim Ulang Email Verifikasi
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="auth-footer">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-secondary">Keluar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
