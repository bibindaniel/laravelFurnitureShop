<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>

<body> -->
<!-- register.blade.php -->
<!-- <form method="POST" action="{{ route('register') }}">

        @csrf
        <input type="text" name="name" placeholder="Username">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="password">
        <button type="submit">Submit</button>
    </form> -->
<!-- Display validation errors -->
<!-- @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

</body>
</html> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
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

        .register-form {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
        }

        .register-heading {
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

        .error {
            color: red;
        }

        .login-link {
            text-decoration: none;
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="logo-and-form-container">
        <!-- <div class="logo-container">
            <h2 class="logo-heading">Your Logo</h2>
            <p class="tagline">Tagline or Company Info</p>
            <a href="{{ route('login') }}" class="login-link">Already registered? Login here.</a>
        </div> -->
        <div class="logo-container">
            <h2 class="logo-heading">
                <img src="{{ asset('images/logo.jpg') }}" alt="Your Logo" style="max-width: 29%; height: auto;">
            </h2>
            <p class="company-name" style="font-family: 'YourDesignedFont', sans-serif; font-weight: bold; text-align: center;">Furni.</p>
            <p class="tagline" style="text-align: center;">"Where Comfort Meets Style."</p>
            <a href="{{ route('login') }}" class="login-link">Already registered? Login here.</a>
        </div>
        <div class="form-container">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <div class="register-form">
                <h2 class="register-heading">Register</h2>
                @if ($errors->any())
                <div class="error">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name">Username</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter username">
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn custom-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>