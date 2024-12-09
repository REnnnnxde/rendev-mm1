<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Parma</title>
    <link rel="shortcut icon" href="{{ asset('assets/svgs/logo-mark.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <style>
        /* Styling tambahan untuk tampilan registrasi */
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f3f4f6;
        }
        .register-container {
            width: 100%;
            max-width: 400px;
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .register-header img {
            width: 80px;
            margin-bottom: 1.5rem;
        }
        .register-header p {
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
        .register-button {
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
        .register-button:hover {
            background-color: #4f46e5;
        }
        .register-footer {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.875rem;
            color: #4b5563;
        }
        .register-footer a {
            color: #6366f1;
            font-weight: 500;
            text-decoration: none;
        }
        .register-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <div class="register-header text-center">
            <!-- <img src="{{ asset('assets/svgs/logo.svg') }}" alt="Logo"> -->
            <p>Register</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name" class="text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="form-input" placeholder="Your full name" required autofocus>
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" id="email" class="form-input" placeholder="Your email address" required>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="form-input" placeholder="Create a password" required>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation" class="text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" placeholder="Confirm your password" required>
                @error('password_confirmation')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Register Button -->
            <button type="submit" class="register-button">Register</button>
        </form>

        <!-- Login Link -->
        <div class="register-footer">
            <p>Already registered? 
                <a href="{{ route('login') }}">Log in</a>
            </p>
        </div>
    </div>
</body>

</html>
