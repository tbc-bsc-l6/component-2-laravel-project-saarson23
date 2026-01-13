<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Assasin School') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            
            :root {
                --primary-color: #4a90e2;
                --input-bg: #ebebeb;
                --text-dark: #333333;
                --text-muted: #666666;
            }
            
            body {
                font-family: 'Montserrat', sans-serif;
                background-color: #f5f5f5;
                color: var(--text-dark);
                margin: 0;
                padding: 0;
                min-height: 100vh;
            }
            
            .top-bar {
                height: 5px;
                background: linear-gradient(to right, #903abb, #6c2e91);
                width: 100%;
                position: fixed;
                top: 0;
                left: 0;
                z-index: 1000;
            }
            
            .auth-container {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 40px 20px;
                padding-top: 60px;
            }
            
            .auth-card {
                width: 100%;
                max-width: 420px;
                background: white;
                border: none;
                padding: 40px 30px;
                box-shadow: none;
                margin: 0 auto;
            }
            
            .auth-title {
                font-weight: 700;
                font-size: 2rem;
                color: #333333;
                margin-bottom: 2.5rem;
                text-align: center;
            }
            
            .form-control {
                border-radius: 30px !important;
                background-color: var(--input-bg) !important;
                border: none !important;
                padding: 14px 50px !important;
                font-weight: 500;
                color: #1a1a1a !important;
                height: 55px !important;
                font-size: 0.95rem;
                transition: all 0.3s;
                text-align: center;
            }
            
            .form-control:focus {
                background-color: #e0e0e0 !important;
                outline: none !important;
                box-shadow: none !important;
            }
            
            .form-control::placeholder {
                color: #999999;
                font-weight: 400;
            }
            
            .input-group {
                position: relative;
                width: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                gap: 10px;

                margin-bottom: 1.25rem;
            }
            
            .input-group-icon {
                position: absolute;
                left: 20px;
                top: 50%;
                transform: translateY(-50%);
                z-index: 10;
                color: #888888;
                font-size: 1.1rem;
                pointer-events: none;
            }
            
            .btn-primary {
                background-color: var(--primary-color) !important;
                border: none !important;
                border-radius: 30px !important;
                padding: 0 !important;
                height: 55px !important;
                font-weight: 700;
                font-size: 1rem;
                letter-spacing: 1.5px;
                transition: all 0.3s;
                text-transform: uppercase;
                display: flex;
                align-items: center;
                justify-content: center;
                width: 100%;
                color: white !important;
            }
            
            .btn-primary:hover {
                background-color: #357abd !important;
                box-shadow: 0 8px 20px rgba(74, 144, 226, 0.3);
                transform: translateY(-2px);
            }
            
            .auth-links {
                color: var(--text-muted);
                font-size: 0.9rem;
                text-decoration: none;
                transition: color 0.2s;
                font-weight: 500;
            }
            
            .auth-links:hover {
                color: var(--primary-color);
            }
            
            .footer-links {
                margin-top: 3rem;
                text-align: center;
            }
            
            .text-center {
                text-align: center;
            }
            
            .mt-2 {
                margin-top: 0.5rem;
            }
            
            .mt-3 {
                margin-top: 1rem;
            }
            
            .mt-4 {
                margin-top: 1.5rem;
            }
            
            .mb-3 {
                margin-bottom: 1rem;
            }
            
            .mb-4 {
                margin-bottom: 1.5rem;
            }
            
            .d-grid {
                display: grid;
            }
            
            .gap-2 {
                gap: 0.5rem;
            }
            
            .small {
                font-size: 0.875rem;
            }
            
            .fw-bold {
                font-weight: 700;
            }
            
            .text-muted {
                color: var(--text-muted) !important;
            }
            
            .alert {
                padding: 12px 16px;
                border-radius: 8px;
                margin-bottom: 1.5rem;
                font-size: 0.9rem;
            }
            
            .alert-success {
                background-color: #d4edda;
                color: #155724;
                border: 1px solid #c3e6cb;
            }
            
            .alert-danger {
                background-color: #f8d7da;
                color: #721c24;
                border: 1px solid #f5c6cb;
            }
            
            .alert-info {
                background-color: #d1ecf1;
                color: #0c5460;
                border: 1px solid #bee5eb;
            }
        </style>
    </head>
    <body>
        <div class="top-bar"></div>
        <div class="auth-container">
            <div class="auth-card">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
