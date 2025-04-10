@extends('layouts.master')

@section('title', 'Akses Ditolak - 403')

@section('content')
    <div class="error-container">
        <div class="error-page">
            <div class="error-content">
                <div class="error-code" id="error-403">403</div>
                <h1 class="error-title">Akses Ditolak</h1>
                <p class="error-message">Maaf, Anda tidak memiliki izin untuk mengakses halaman ini. Silakan hubungi
                    administrator jika Anda yakin seharusnya memiliki akses.</p>
                <div class="error-illustration">
                    <svg width="280" height="220" viewBox="0 0 280 220" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <!-- Background Circle -->
                        <circle cx="140" cy="110" r="85" fill="#8B5CF6" fill-opacity="0.05" />

                        <!-- Shield Icon -->
                        <path d="M140 50L200 70V120C200 155 175 180 140 190C105 180 80 155 80 120V70L140 50Z" fill="white"
                            fill-opacity="0.1" stroke="#8B5CF6" stroke-width="3" />

                        <!-- Lock Icon -->
                        <rect x="120" y="100" width="40" height="35" rx="4" fill="#FFFFFF" stroke="#EF4444"
                            stroke-width="3" class="lock-body" />
                        <path d="M130 100V85C130 79.477 134.477 75 140 75V75C145.523 75 150 79.477 150 85V100"
                            stroke="#EF4444" stroke-width="3" class="lock-shackle" />

                        <!-- Forbidden Symbol -->
                        <circle cx="140" cy="117.5" r="10" fill="#EF4444" class="lock-keyhole" />
                        <path d="M135 117.5H145" stroke="white" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </div>
                <div class="error-actions">
                    <a href="{{ url('/') }}" class="btn btn-primary">Kembali ke Halaman Utama</a>
                    <a href="{{ route('home') }}" class="btn btn-secondary">Dashboard</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .error-container {
            padding-top: 60px;
            min-height: 100vh;
            background: linear-gradient(180deg, rgba(30, 41, 59, 0.8) 0%, rgba(30, 41, 59, 1) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .error-page {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 2rem;
        }

        .error-content {
            text-align: center;
            max-width: 600px;
            background-color: rgba(30, 41, 59, 0.8);
            padding: 3rem;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(139, 92, 246, 0.2);
        }

        .error-code {
            font-size: 8rem;
            font-weight: 900;
            background: linear-gradient(to right, #8B5CF6, #EC4899);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            line-height: 1;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 15px rgba(139, 92, 246, 0.3);
            position: relative;
            display: inline-block;
            animation: shake 5s ease-in-out infinite;
            perspective: 1000px;
            transform-style: preserve-3d;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0) rotate3d(0, 1, 0, 0deg);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-5px) rotate3d(0, 1, 0, -5deg);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(5px) rotate3d(0, 1, 0, 5deg);
            }
        }

        .error-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #FFFFFF;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .error-message {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 2rem;
        }

        .error-illustration {
            margin: 2rem auto;
            animation: pulse 2s ease-in-out infinite;
            filter: drop-shadow(0 5px 15px rgba(139, 92, 246, 0.2));
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.03);
            }

            100% {
                transform: scale(1);
            }
        }

        .lock-body {
            animation: wiggle 8s ease-in-out infinite;
        }

        .lock-keyhole {
            animation: pulse-keyhole 2s ease-in-out infinite;
        }

        @keyframes wiggle {

            0%,
            100% {
                transform: rotate(0deg);
            }

            92%,
            94%,
            96%,
            98% {
                transform: rotate(-2deg);
            }

            93%,
            95%,
            97%,
            99% {
                transform: rotate(2deg);
            }
        }

        @keyframes pulse-keyhole {

            0%,
            100% {
                fill: #EF4444;
            }

            50% {
                fill: #ff6666;
            }
        }

        .error-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
        }

        .btn {
            display: inline-block;
            padding: 0.8rem 1.8rem;
            font-size: 1rem;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-primary {
            background: linear-gradient(to right, #8B5CF6, #6D28D9);
            color: #FFFFFF;
            box-shadow: 0 4px 10px rgba(109, 40, 217, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(to right, #7C3AED, #5B21B6);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(109, 40, 217, 0.4);
        }

        .btn-secondary {
            background-color: transparent;
            color: #FFFFFF;
            border: 2px solid rgba(139, 92, 246, 0.6);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-secondary:hover {
            background-color: rgba(139, 92, 246, 0.1);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .error-container {
                padding-top: 50px;
            }

            .error-content {
                padding: 2rem;
            }

            .error-code {
                font-size: 6rem;
            }

            .error-title {
                font-size: 2rem;
            }

            .error-actions {
                flex-direction: column;
                gap: 0.8rem;
            }

            .error-actions .btn {
                width: 100%;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const errorCode = document.getElementById('error-403');

            // Add 3D effect on hover
            errorCode.addEventListener('mousemove', function(e) {
                const rect = this.getBoundingClientRect();
                const x = ((e.clientX - rect.left) / rect.width - 0.5) * 20;
                const y = ((e.clientY - rect.top) / rect.height - 0.5) * 20;

                this.style.transform =
                    `perspective(1000px) rotateX(${-y}deg) rotateY(${x}deg) scale3d(1.1, 1.1, 1.1)`;
                this.style.textShadow = `
                ${x/2}px ${y/2}px 5px rgba(0, 0, 0, 0.3),
                ${x}px ${y}px 20px rgba(239, 68, 68, 0.5),
                ${-x}px ${-y}px 0px rgba(139, 92, 246, 0.3)
            `;

                // Add glow effect to the lock
                const lockBody = document.querySelector('.lock-body');
                const lockKeyhole = document.querySelector('.lock-keyhole');
                if (lockBody && lockKeyhole) {
                    lockBody.setAttribute('filter', 'drop-shadow(0 0 8px rgba(239, 68, 68, 0.8))');
                    lockKeyhole.setAttribute('filter', 'drop-shadow(0 0 5px rgba(239, 68, 68, 0.8))');
                }
            });

            // Reset on mouse leave
            errorCode.addEventListener('mouseleave', function() {
                this.style.transform = '';
                this.style.textShadow = '';

                // Reset lock effects
                const lockBody = document.querySelector('.lock-body');
                const lockKeyhole = document.querySelector('.lock-keyhole');
                if (lockBody && lockKeyhole) {
                    lockBody.removeAttribute('filter');
                    lockKeyhole.removeAttribute('filter');
                }

                setTimeout(() => {
                    this.style.animation = 'shake 5s ease-in-out infinite';
                }, 100);
            });
        });
    </script>
@endpush
