@extends('layouts.master')

@section('title', 'Halaman Tidak Ditemukan - 404')

@section('content')
    <div class="error-container">
        <div class="error-page">
            <div class="error-content">
                <div class="error-code" id="error-404">404</div>
                <h1 class="error-title">Halaman Tidak Ditemukan</h1>
                <p class="error-message">Maaf, halaman yang Anda cari tidak ditemukan atau telah dipindahkan.</p>
                <div class="error-illustration">
                    <svg width="280" height="220" viewBox="0 0 280 220" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <!-- Background Circle -->
                        <circle cx="140" cy="110" r="85" fill="#8B5CF6" fill-opacity="0.05" />

                        <!-- Document Icon -->
                        <rect x="105" y="70" width="70" height="85" rx="4" fill="#FFFFFF" stroke="#8B5CF6"
                            stroke-width="3" />
                        <rect x="115" y="85" width="50" height="4" rx="2" fill="#8B5CF6" />
                        <rect x="115" y="95" width="50" height="4" rx="2" fill="#8B5CF6" />
                        <rect x="115" y="105" width="35" height="4" rx="2" fill="#8B5CF6" />

                        <!-- X Mark -->
                        <path d="M130 135L150 155" stroke="#EF4444" stroke-width="4" stroke-linecap="round"
                            class="error-x" />
                        <path d="M150 135L130 155" stroke="#EF4444" stroke-width="4" stroke-linecap="round"
                            class="error-x" />

                        <!-- Magnifying Glass -->
                        <circle cx="185" cy="75" r="20" stroke="#8B5CF6" stroke-width="3" fill="#FFFFFF"
                            fill-opacity="0.5" />
                        <path d="M200 90L210 100" stroke="#8B5CF6" stroke-width="3" stroke-linecap="round" />
                    </svg>
                </div>
                <div class="error-actions">
                    <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Dashboard</a>
                    <a href="{{ url('/') }}" class="btn btn-secondary">Halaman Utama</a>
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
            animation: floating 3s ease-in-out infinite;
            perspective: 1000px;
            transform-style: preserve-3d;
        }

        @keyframes floating {
            0% {
                transform: translateY(0) rotate3d(1, 2, 0, 0deg);
            }

            50% {
                transform: translateY(-15px) rotate3d(1, 2, 0, 10deg);
            }

            100% {
                transform: translateY(0) rotate3d(1, 2, 0, 0deg);
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

        .error-x {
            animation: flash 2s ease-in-out infinite;
        }

        @keyframes flash {

            0%,
            100% {
                opacity: 1;
                stroke: #EF4444;
            }

            50% {
                opacity: 0.5;
                stroke: #ff0000;
            }
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
            const errorCode = document.getElementById('error-404');

            // Add 3D effect on hover
            errorCode.addEventListener('mousemove', function(e) {
                const rect = this.getBoundingClientRect();
                const x = ((e.clientX - rect.left) / rect.width - 0.5) * 20;
                const y = ((e.clientY - rect.top) / rect.height - 0.5) * 20;

                this.style.transform =
                    `perspective(1000px) rotateX(${-y}deg) rotateY(${x}deg) scale3d(1.1, 1.1, 1.1)`;
                this.style.textShadow = `
                ${x/2}px ${y/2}px 5px rgba(0, 0, 0, 0.3),
                ${x}px ${y}px 20px rgba(139, 92, 246, 0.5),
                ${-x}px ${-y}px 0px rgba(239, 68, 68, 0.3)
            `;
            });

            // Reset on mouse leave
            errorCode.addEventListener('mouseleave', function() {
                this.style.transform = '';
                this.style.textShadow = '';
                setTimeout(() => {
                    this.style.animation = 'floating 3s ease-in-out infinite';
                }, 100);
            });
        });
    </script>
@endpush
