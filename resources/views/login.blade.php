<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>

<body>

    <div class="container" id="container">
        <!-- Star Register -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{$item}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="form-container sign-up">
            <form action="" method="post">
                @csrf
                <h2>Sign In</h2>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>Use Your Email or Password </span>
                <input type="text" value="{{ old('email') }}" name="email" id="email" placeholder="email">
                <input type="password" name="password" id="password" placeholder="password">
                <button type="submit">Sign In</button>
            </form>
        </div>
        <!-- and Register -->
        <!-- Star Login -->
        <div class="form-container sign-in">
            <form action="#" method="post">
                <img src="{{ asset ('img/logo.jpg') }}" alt="klinik" width="100px">
                <h1>Al-Basmallah</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><h2>S</h2></a>
                    <a href="#" class="icon"><h2>E</h2></a>
                    <a href="#" class="icon"><h2>L</h2></a>
                    <a href="#" class="icon"><h2>A</h2></a>
                    <a href="#" class="icon"><h2>M</h2></a>
                    <a href="#" class="icon"><h2>A</h2></a>
                    <a href="#" class="icon"><h2>T</h2></a>
                </div>
                <div class="social-icons">
                    <a href="#" class="icon"><h2>D</h2></a>
                    <a href="#" class="icon"><h2>A</h2></a>
                    <a href="#" class="icon"><h2>T</h2></a>
                    <a href="#" class="icon"><h2>A</h2></a>
                    <a href="#" class="icon"><h2>N</h2></a>
                    <a href="#" class="icon"><h2>G</h2></a>
                </div>
            </form>
        </div>
        <!-- And Login  -->
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Click here to return</p>
                    <button class="hidden" id="login">Back</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1></h1>
                    <p>Click here to Login</p>
                    <button class="hidden" id="register">Sign In</button>
                </div>
            </div>
        </div>
    </div>

    <script >
const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});
    </script>
</body>

</html>