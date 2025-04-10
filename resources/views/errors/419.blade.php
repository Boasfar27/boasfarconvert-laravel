@extends('layouts.master')

@section('title', 'Sesi Kedaluwarsa - 419')

@section('content')
    <div class="error-container">
        <div class="error-page">
            <div class="error-content">
                <div class="error-code" id="error-419">419</div>
                <h1 class="error-title">Sesi Kedaluwarsa</h1>
                <p class="error-message">Maaf, sesi Anda telah kedaluwarsa karena tidak aktif terlalu lama. Silakan refresh
                    halaman atau login kembali.</p>
                <div class="error-illustration">
                    <svg width="280" height="220" viewBox="0 0 280 220" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="error-svg">
                        <!-- Background Circle -->
                        <circle cx="140" cy="110" r="85" fill="#8B5CF6" fill-opacity="0.05" />

                        <!-- Hourglass -->
                        <path d="M140 50L160 70H120L140 50Z" fill="#FFFFFF" stroke="#8B5CF6" stroke-width="2"
                            class="hourglass-top" />
                        <path d="M140 170L160 150H120L140 170Z" fill="#FFFFFF" stroke="#8B5CF6" stroke-width="2"
                            class="hourglass-bottom" />
                        <path d="M120 70V150" stroke="#8B5CF6" stroke-width="2" />
                        <path d="M160 70V150" stroke="#8B5CF6" stroke-width="2" />

                        <!-- Sand Top -->
                        <path d="M122 75H158V95C158 95 150 105 140 105C130 105 122 95 122 95V75Z" fill="#F59E0B"
                            fill-opacity="0.5" class="sand-top" />

                        <!-- Sand Bottom -->
                        <path d="M122 145H158V125C158 125 150 115 140 115C130 115 122 125 122 125V145Z" fill="#F59E0B"
                            class="sand-bottom" />

                        <!-- Sand Particles -->
                        <circle cx="140" cy="108" r="2" fill="#F59E0B" class="sand-particle" />

                        <!-- Clock Elements -->
                        <circle cx="190" cy="85" r="25" stroke="#EF4444" stroke-width="3" fill="white"
                            fill-opacity="0.1" class="clock-face" />
                        <path d="M190 70V85" stroke="#EF4444" stroke-width="2" stroke-linecap="round"
                            class="clock-hour-hand" />
                        <path d="M190 85L205 95" stroke="#EF4444" stroke-width="2" stroke-linecap="round"
                            class="clock-minute-hand" />
                        <circle cx="190" cy="85" r="3" fill="#EF4444" class="clock-center" />

                        <!-- CSRF Token Symbol -->
                        <path d="M85 100H100V115H85V100Z" stroke="#EF4444" stroke-width="2" fill="white"
                            fill-opacity="0.1" class="token-symbol" />
                        <path d="M80 95L105 120" stroke="#EF4444" stroke-width="2" stroke-linecap="round" class="token-x" />
                        <path d="M105 95L80 120" stroke="#EF4444" stroke-width="2" stroke-linecap="round" class="token-x" />
                    </svg>
                </div>
                <div class="error-actions">
                    <button onclick="window.location.reload()" class="btn btn-primary">Refresh Halaman</button>
                    <a href="{{ route('login') }}" class="btn btn-secondary">Login Kembali</a>
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
            animation: fadeIn 3s ease-in-out;
            perspective: 1000px;
            transform-style: preserve-3d;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px) rotate3d(1, 0, 0, 90deg);
            }

            100% {
                opacity: 1;
                transform: translateY(0) rotate3d(1, 0, 0, 0deg);
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
            filter: drop-shadow(0 5px 15px rgba(139, 92, 246, 0.2));
        }

        /* Animations for hourglass elements */
        .hourglass-top,
        .hourglass-bottom {
            animation: pulse 4s ease-in-out infinite;
        }

        .sand-particle {
            animation: fallingSand 2s linear infinite;
        }

        .sand-top {
            animation: decreaseSand 20s linear infinite;
            transform-origin: center bottom;
        }

        .sand-bottom {
            animation: increaseSand 20s linear infinite;
            transform-origin: center top;
        }

        .clock-hour-hand {
            transform-origin: center;
            animation: clockHour 12s linear infinite;
        }

        .clock-minute-hand {
            transform-origin: 190px 85px;
            animation: clockMinute 3s linear infinite;
        }

        .token-x {
            animation: blink 2s ease-in-out infinite alternate;
        }

        .token-symbol {
            animation: wiggle 5s ease-in-out infinite;
        }

        @keyframes clockHour {
            0% {
                transform: rotate(0);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes clockMinute {
            0% {
                transform: rotate(0);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes fallingSand {
            0% {
                transform: translateY(0);
                opacity: 1;
            }

            100% {
                transform: translateY(32px);
                opacity: 0;
            }
        }

        @keyframes decreaseSand {
            0% {
                transform: scaleY(1);
            }

            90% {
                transform: scaleY(0.1);
            }

            100% {
                transform: scaleY(0.1);
            }
        }

        @keyframes increaseSand {
            0% {
                transform: scaleY(0.1);
            }

            90% {
                transform: scaleY(1);
            }

            100% {
                transform: scaleY(1);
            }
        }

        @keyframes wiggle {

            0%,
            100% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(-5deg);
            }

            75% {
                transform: rotate(5deg);
            }
        }

        @keyframes blink {

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
            const errorCode = document.getElementById('error-419');
            const svg = document.querySelector('.error-svg');

            // Add ticking sound effect (optional, commented to avoid annoying users)
            // const tickSound = () => {
            //     const tick = new Audio();
            //     tick.src = 'data:audio/wav;base64,UklGRiQDAA...'; // base64 audio data
            //     tick.play();
            // };
            // setInterval(tickSound, 1000);

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

                // Speed up the animations
                const hourHand = document.querySelector('.clock-hour-hand');
                const minuteHand = document.querySelector('.clock-minute-hand');

                if (hourHand && minuteHand) {
                    hourHand.style.animation = 'clockHour 3s linear infinite';
                    minuteHand.style.animation = 'clockMinute 1s linear infinite';
                }

                // Create more sand particles
                for (let i = 0; i < 3; i++) {
                    createSandParticle();
                }
            });

            // Reset on mouse leave
            errorCode.addEventListener('mouseleave', function() {
                this.style.transform = '';
                this.style.textShadow = '';

                // Reset clock animation
                const hourHand = document.querySelector('.clock-hour-hand');
                const minuteHand = document.querySelector('.clock-minute-hand');

                if (hourHand && minuteHand) {
                    hourHand.style.animation = 'clockHour 12s linear infinite';
                    minuteHand.style.animation = 'clockMinute 3s linear infinite';
                }
            });

            // Create sand particles dynamically
            function createSandParticle() {
                const sand = document.createElementNS("http://www.w3.org/2000/svg", "circle");
                const x = 140 + (Math.random() * 16 - 8);
                const y = 95 + (Math.random() * 5);

                sand.setAttribute('cx', x);
                sand.setAttribute('cy', y);
                sand.setAttribute('r', Math.random() * 1.5 + 0.5);
                sand.setAttribute('fill', '#F59E0B');
                sand.style.opacity = '0.8';

                svg.appendChild(sand);

                // Animate falling sand
                let posY = parseFloat(sand.getAttribute('cy'));
                const speed = Math.random() * 1 + 0.5;

                const animateSand = () => {
                    posY += speed;
                    sand.setAttribute('cy', posY);

                    // Remove when it reaches bottom
                    if (posY < 140) {
                        requestAnimationFrame(animateSand);
                    } else {
                        svg.removeChild(sand);
                    }
                };

                requestAnimationFrame(animateSand);
            }

            // Create occasional sand particles
            setInterval(() => {
                createSandParticle();
            }, 300);
        });
    </script>
@endpush
