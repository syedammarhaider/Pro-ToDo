<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Reset Password - Professional Todo App</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- CSS -->
        <link rel="stylesheet" href="/css/app.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        
        <style>
            body {
                background: linear-gradient(135deg,var(--bg-main) 0%,#1a2a6c 50%,var(--card-dark) 100%);
                color: var(--text-primary);
                font-family:'Inter',sans-serif;
                min-height:100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0;
                padding: 20px;
            }
            
            .auth-container {
                background: var(--glass-bg);
                backdrop-filter: blur(25px) saturate(180%);
                -webkit-backdrop-filter: blur(25px) saturate(180%);
                border:1.5px solid var(--glass-border);
                border-radius:28px;
                box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5), inset 0 1px 0 0 rgba(255,255,255,0.1);
                padding: 2.5rem;
                width: 100%;
                max-width: 450px;
            }
            
            .auth-header {
                text-align: center;
                margin-bottom: 2rem;
            }
            
            .auth-title {
                font-size: 2rem;
                font-weight: 700;
                background: linear-gradient(135deg, #667eea, #764ba2, #f093fb);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                color: transparent;
                margin-bottom: 0.5rem;
            }
            
            .auth-subtitle {
                color: var(--text-secondary);
                font-size: 0.9rem;
                line-height: 1.5;
            }
            
            .form-group {
                margin-bottom: 1.5rem;
            }
            
            .form-label {
                display: block;
                color: white;
                font-weight: 500;
                margin-bottom: 0.5rem;
                font-size: 0.9rem;
            }
            
            .form-input {
                width: 100%;
                background: rgba(255,255,255,0.07);
                border: 1.5px solid rgba(255,255,255,0.12);
                color: white;
                border-radius: 14px;
                padding: 0.75rem 1rem;
                font-size: 0.9rem;
                transition: all 0.3s ease;
            }
            
            .form-input:focus {
                background: rgba(255,255,255,0.12);
                border-color: var(--accent-cyan);
                box-shadow: 0 0 0 0.25rem rgba(0,210,255,0.2);
                color: white;
                outline: none;
            }
            
            .form-input::placeholder {
                color: rgba(255,255,255,0.5);
            }
            
            .btn-primary {
                background: linear-gradient(135deg, #f81ce5, #7000ff);
                color: white;
                border: none;
                padding: 0.75rem 1.5rem;
                border-radius: 14px;
                font-weight: 600;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 8px;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(248,28,229,0.3);
                cursor: pointer;
                font-size: 0.9rem;
                width: 100%;
                justify-content: center;
            }
            
            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(248,28,229,0.5);
            }
            
            .btn-link {
                color: var(--accent-cyan);
                text-decoration: none;
                font-size: 0.9rem;
                transition: color 0.3s ease;
            }
            
            .btn-link:hover {
                color: var(--accent-blue);
                text-decoration: underline;
            }
            
            .text-error {
                color: var(--accent-red);
                font-size: 0.8rem;
                margin-top: 0.25rem;
            }
            
            .auth-footer {
                text-align: center;
                margin-top: 2rem;
                padding-top: 1.5rem;
                border-top: 1px solid rgba(255,255,255,0.1);
            }
            
            .auth-footer p {
                color: var(--text-secondary);
                font-size: 0.9rem;
            }
        </style>
    </head>
    <body>
        <div class="auth-container">
            <div class="auth-header">
                <h1 class="auth-title">Reset Password</h1>
                <p class="auth-subtitle">Enter your new password below</p>
            </div>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input id="email" 
                           class="form-input" 
                           type="email" 
                           name="email" 
                           value="{{ old('email', $request->email) }}" 
                           required 
                           autofocus 
                           autocomplete="username"
                           placeholder="Enter your email address">
                    @error('email')
                        <div class="text-error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">New Password</label>
                    <input id="password" 
                           class="form-input"
                           type="password"
                           name="password"
                           required 
                           autocomplete="new-password"
                           placeholder="Create a new password">
                    @error('password')
                        <div class="text-error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                    <input id="password_confirmation" 
                           class="form-input"
                           type="password"
                           name="password_confirmation" 
                           required 
                           autocomplete="new-password"
                           placeholder="Confirm your new password">
                    @error('password_confirmation')
                        <div class="text-error">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-primary">
                    <i class="fas fa-key"></i>
                    Reset Password
                </button>
            </form>

            <div class="auth-footer">
                <p>
                    <a href="{{ route('login') }}" class="btn-link" style="font-weight: 600;">
                        <i class="fas fa-arrow-left"></i> Back to login
                    </a>
                </p>
            </div>
        </div>
    </body>
</html>
