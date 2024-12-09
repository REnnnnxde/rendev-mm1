<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | Parma</title>
    <link rel="shortcut icon" href="{{ asset('assets/svgs/logo-mark.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <style>
        /* Styling tambahan untuk tampilan login */
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f3f4f6;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .login-header img {
            width: 80px;
            margin-bottom: 1.5rem;
        }
        .login-header p {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            color: #333;
            text-align: center;
        }
        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            margin-top: 0.5rem;
        }
        .form-input:focus {
            border-color: #6366f1;
            outline: none;
        }
        .form-group {
            margin-bottom: 1.25rem;
        }
        .error-message {
            color: #e53e3e;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .login-button {
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            font-weight: bold;
            color: white;
            background-color: #6366f1;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .login-button:hover {
            background-color: #4f46e5;
        }
        .login-footer {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.875rem;
            color: #4b5563;
        }
        .login-footer a {
            color: #6366f1;
            font-weight: 500;
            text-decoration: none;
        }
        .login-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-header text-center">
            <!-- <img src="{{ asset('assets/svgs/logo.svg') }}" alt="Logo"> -->
            <p>Sign In</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" id="email" class="form-input" placeholder="Your email address" required autofocus>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="form-input" placeholder="Protect your password" required>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="form-group flex items-center justify-between">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="remember" class="form-checkbox text-indigo-600 border-gray-300 rounded">
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:underline">Forgot Password?</a>
                @endif
            </div>

            <!-- Sign In Button -->
            <button type="submit" class="login-button">Sign In</button>
        </form>

        <!-- Register Link -->
        <div class="login-footer">
            <p>Don't have an account? 
                <a href="{{ route('register') }}">Create New Account</a>
            </p>
        </div>
    </div>
</body>

</html>
