<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <button type="submit">Login</button>
        </div>
    </form>
</body>
</html> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .logo-and-form-container {
            display: flex;
            width: 80%;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .logo-container {
            flex: 1;
            background-color: #435c51;
            color: #fff;
            padding: 20px;
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo-heading {
            text-align: center;
            margin-bottom: 10px;
        }

        .tagline {
            text-align: center;
        }

        .form-container {
            flex: 1;
            padding: 20px;
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .login-form {
            background-color: #fff;
            border-radius: 8px;
        }

        .login-heading {
            text-align: center;
            color: #435c51;
        }

        .custom-btn {
            background-color: #435c51;
            border: none;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: all 0.3s;
            width: 100%;
        }

        .custom-btn:hover {
            background-color: #34473e;
            color: #fff;
        }

        .register-link {
            text-decoration: none;
            color: #435c51;
        }
    </style>
</head>

<body>

    <div class="logo-and-form-container">
        <div class="logo-container">
            <h2 class="logo-heading">
                <img src="{{ asset('images/logo.jpg') }}" alt="Your Logo" style="max-width: 29%; height: auto;">
            </h2>
            <p class="company-name" style="font-family: 'YourDesignedFont', sans-serif; font-weight: bold; text-align: center;">Furni.</p>
            <p class="tagline" style="text-align: center;">"Where Comfort Meets Style."</p>
        </div>

        <div class="form-container">
            <div class="login-form">
                <h2 class="login-heading">Login</h2>
                @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn custom-btn">Login</button>
                    </div>
                    <div class="mt-3 text-center">
                        <a href="{{ route('register') }}" class="register-link">New user? Register here.</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>