@extends('layouts.master')

@section('title', 'Maintenance Mode - 503')

@section('content')
    <div class="error-container">
        <div class="error-page">
            <div class="error-content">
                <div class="error-code" id="error-503">503</div>
                <h1 class="error-title">Maintenance Mode</h1>
                <p class="error-message">Website sedang dalam pemeliharaan. Kami akan kembali segera.</p>
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

                        <!-- Maintenance Lights -->
                        <circle cx="120" y="135" r="5" fill="#F59E0B" class="warning-light" />
                        <circle cx="140" y="135" r="5" fill="#F59E0B" class="warning-light" />
                        <circle cx="160" y="135" r="5" fill="#F59E0B" class="warning-light" />

                        <!-- Tools Icon -->
                        <path d="M180 90L195 105" stroke="#F59E0B" stroke-width="4" stroke-linecap="round" />
                        <path d="M195 90L180 105" stroke="#F59E0B" stroke-width="4" stroke-linecap="round" />
                        <circle cx="187.5" cy="97.5" r="5" fill="#F59E0B" />
                    </svg>
                </div>
                <div class="error-actions">
                    <a href="{{ url('/') }}" class="btn btn-primary">Refresh Halaman</a>
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
            background: linear-gradient(to right, #F59E0B, #D97706);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            line-height: 1;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 15px rgba(245, 158, 11, 0.3);
            position: relative;
            display: inline-block;
            animation: pulse 2s infinite;
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
            filter: drop-shadow(0 5px 15px rgba(245, 158, 11, 0.2));
        }

        .warning-light {
            animation: blink 2s ease-in-out infinite;
        }

        @keyframes blink {
            0%, 100% {
                opacity: 1;
                fill: #F59E0B;
            }
            50% {
                opacity: 0.5;
                fill: #D97706;
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
            background: linear-gradient(to right, #F59E0B, #D97706);
            color: #FFFFFF;
            box-shadow: 0 4px 10px rgba(245, 158, 11, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(to right, #D97706, #B45309);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(245, 158, 11, 0.4);
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