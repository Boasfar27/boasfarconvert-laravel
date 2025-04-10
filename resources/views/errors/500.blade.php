@extends('layouts.master')

@section('title', 'Kesalahan Server - 500')

@section('content')
    <div class="error-container">
        <div class="error-page">
            <div class="error-content">
                <div class="error-code" id="error-500">500</div>
                <h1 class="error-title">Kesalahan Server</h1>
                <p class="error-message">Maaf, terjadi kesalahan pada server kami. Tim teknis kami sedang bekerja untuk
                    memperbaikinya.</p>
                <div class="error-illustration">
                    <svg width="280" height="220" viewBox="0 0 280 220" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="error-svg">
                        <!-- Background Circle -->
                        <circle cx="140" cy="110" r="85" fill="#8B5CF6" fill-opacity="0.05" />

                        <!-- Server Icon -->
                        <rect x="105" y="70" width="70" height="90" rx="4" fill="#FFFFFF" stroke="#8B5CF6"
                            stroke-width="3" class="server-body" />

                        <!-- Server Rack Lines -->
                        <rect x="110" y="80" width="60" height="10" rx="2" fill="#EDEDED" stroke="#8B5CF6"
                            stroke-width="1" />
                        <rect x="110" y="95" width="60" height="10" rx="2" fill="#EDEDED" stroke="#8B5CF6"
                            stroke-width="1" />
                        <rect x="110" y="110" width="60" height="10" rx="2" fill="#EDEDED" stroke="#8B5CF6"
                            stroke-width="1" />

                        <!-- Warning Lights -->
                        <circle cx="120" y="135" r="5" fill="#EF4444" class="error-light" />
                        <circle cx="140" y="135" r="5" fill="#F59E0B" class="warning-light" />
                        <circle cx="160" y="135" r="5" fill="#10B981" class="healthy-light" />

                        <!-- Smoke/Sparks -->
                        <path class="smoke-path"
                            d="M125 70C125 70 120 60 130 60C140 60 135 50 145 50C155 50 150 60 160 60C170 60 165 70 165 70"
                            stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-dasharray="3 3" />

                        <!-- Error X Marks -->
                        <path d="M180 90L195 105" stroke="#EF4444" stroke-width="4" stroke-linecap="round"
                            class="error-x" />
                        <path d="M195 90L180 105" stroke="#EF4444" stroke-width="4" stroke-linecap="round"
                            class="error-x" />
                    </svg>
                </div>
                <div class="error-actions">
                    <a href="{{ url('/') }}" class="btn btn-primary">Kembali ke Halaman Utama</a>
                    <button onclick="window.location.reload()" class="btn btn-secondary">Coba Lagi</button>
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
            animation: glitch 5s infinite;
            perspective: 1000px;
            transform-style: preserve-3d;
        }

        @keyframes glitch {

            0%,
            100% {
                transform: translateX(0) rotate3d(1, 0, 1, 0deg);
            }

            7% {
                transform: translateX(-5px) skewX(10deg);
                text-shadow: -3px 0 #ff00ff, 3px 0 #00ffff;
            }

            10% {
                transform: translateX(5px) skewX(-10deg);
                text-shadow: 3px 0 #ff00ff, -3px 0 #00ffff;
            }

            13% {
                transform: translateX(0);
                text-shadow: 3px 3px 0px var(--color-purple-600);
            }

            20% {
                transform: translateX(0) rotate3d(1, 0, 1, 5deg);
            }

            30% {
                transform: translateX(0) rotate3d(1, 0, 1, 0deg);
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

        .error-x {
            animation: flash 2s ease-in-out infinite;
        }

        .error-light {
            animation: blink 1s ease-in-out infinite;
        }

        .warning-light {
            animation: blink 2s ease-in-out infinite 0.5s;
        }

        .healthy-light {
            animation: dimming 3s ease-in-out infinite;
        }

        .server-body {
            animation: shake-small 10s ease-in-out infinite;
        }

        @keyframes shake-small {

            0%,
            100% {
                transform: translateX(0);
            }

            98%,
            99% {
                transform: translateX(-2px);
            }

            97%,
            99.5% {
                transform: translateX(2px);
            }
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
                fill: #EF4444;
            }

            50% {
                opacity: 0.5;
                fill: #ff0000;
            }
        }

        @keyframes dimming {

            0%,
            100% {
                opacity: 1;
                fill: #10B981;
            }

            30% {
                opacity: 0.3;
                fill: #047857;
            }
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
            const errorCode = document.getElementById('error-500');
            const svg = document.querySelector('.error-svg');

            // Add 3D effect on hover
            errorCode.addEventListener('mousemove', function(e) {
                const rect = this.getBoundingClientRect();
                const x = ((e.clientX - rect.left) / rect.width - 0.5) * 20;
                const y = ((e.clientY - rect.top) / rect.height - 0.5) * 20;

                this.style.animation = 'none';
                this.style.transform =
                    `perspective(1000px) rotateX(${-y}deg) rotateY(${x}deg) scale3d(1.1, 1.1, 1.1)`;
                this.style.textShadow = `
                ${x/2}px ${y/2}px 5px rgba(0, 0, 0, 0.3),
                ${x}px ${y}px 20px rgba(239, 68, 68, 0.5),
                ${-x}px ${-y}px 0px rgba(139, 92, 246, 0.3)
            `;

                // Enhance the error elements
                const xMarks = document.querySelectorAll('.error-x');
                xMarks.forEach(mark => {
                    mark.style.stroke = '#ff0000';
                    mark.style.strokeWidth = '6';
                    mark.style.filter = 'drop-shadow(0 0 8px rgba(239, 68, 68, 0.8))';
                });

                // Add more sparks when hovered
                createSparks(5);
            });

            // Reset on mouse leave
            errorCode.addEventListener('mouseleave', function() {
                this.style.transform = '';
                this.style.textShadow = '';

                // Reset X marks
                const xMarks = document.querySelectorAll('.error-x');
                xMarks.forEach(mark => {
                    mark.style.stroke = '';
                    mark.style.strokeWidth = '';
                    mark.style.filter = '';
                });

                setTimeout(() => {
                    this.style.animation = 'glitch 5s infinite';
                }, 100);
            });

            // Add smoke effect - sparks flying occasionally from the server error
            function createSparks(count = 1) {
                for (let i = 0; i < count; i++) {
                    const spark = document.createElementNS("http://www.w3.org/2000/svg", "circle");
                    spark.setAttribute('cx', 140 + (Math.random() * 40 - 20));
                    spark.setAttribute('cy', 70 + (Math.random() * 20));
                    spark.setAttribute('r', Math.random() * 3 + 1);
                    spark.setAttribute('fill', Math.random() > 0.5 ? '#EF4444' : '#F59E0B');
                    spark.style.opacity = '0.8';

                    svg.appendChild(spark);

                    // Animate and remove
                    let opacity = 0.8;
                    const animate = () => {
                        opacity -= 0.05;
                        spark.style.opacity = opacity;

                        // Random movement
                        const currentX = parseFloat(spark.getAttribute('cx'));
                        const currentY = parseFloat(spark.getAttribute('cy'));
                        const dx = (Math.random() - 0.5) * 5;
                        const dy = -Math.random() * 2 - 1; // Always move upward

                        spark.setAttribute('cx', currentX + dx);
                        spark.setAttribute('cy', currentY + dy);
                        spark.setAttribute('r', parseFloat(spark.getAttribute('r')) - 0.05);

                        if (opacity > 0 && parseFloat(spark.getAttribute('r')) > 0) {
                            requestAnimationFrame(animate);
                        } else {
                            svg.removeChild(spark);
                        }
                    };

                    requestAnimationFrame(animate);
                }
            }

            // Create occasional sparks
            setInterval(() => {
                createSparks(Math.floor(Math.random() * 2) + 1);
            }, 500);
        });
    </script>
@endpush
