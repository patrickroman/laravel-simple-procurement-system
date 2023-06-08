<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>E-Procurement Login Page</title>
    <link rel="icon" type="image/png" href="{{ asset('/bower_components/admin-lte/dist/img/rtu-logo.png') }}" />
    <link rel="stylesheet" href="/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400&display=swap" rel="stylesheet">
    <script type="text/javascript" src="login-regi.js" defer></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.7/dist/sweetalert2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.7/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">


</head>

<body>
    <main>
        <!--RTU LOGO-->
        <div class="container">
            <div class="logo">
                <img src="{{ asset('/bower_components/admin-lte/dist/img/rtu-logo.png') }}" alt="rtu-logo">
            </div>
            <script>
                var msg = "{{ Session::get('alert') }}";
                var exist = "{{ Session::has('alert') }}";
                if (exist) {
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    Toast.fire({
                        icon: 'error',
                        title: msg
                    })
                }
            </script>
            <!-- LOGIN FORM -->
            <div class="login-container">
                <img src="{{ asset('/bower_components/admin-lte/dist/img/PROMS LOGO 1.png') }}" alt="PROMS-logo" aria-hidden="true" style="width: 250px;height:55px;">
                <h3>Sign-In</h3>

                <form action="login" method="post">
                    @csrf
                    <!-- Form Group -->
                    @if(Cookie::has('login_cookie'))
                    <?php $cookie_data = json_decode(Cookie::get('login_cookie'), true); ?>
                    <div class="form-group">
                        <input type="email" id="username" name="username" placeholder="Email:" value="{{ $cookie_data['username'] }}" required>
                        <input type="password" id="password" name="password" placeholder="Password:" value="{{ $cookie_data['password'] }}" required>
                    </div>
                    @else
                    <div class="form-group">
                        <input type="email" id="username" name="username" placeholder="Email:" required>
                        <input type="password" id="password" name="password" placeholder="Password:" required>
                    </div>
                    @endif


                    <!-- Form Group 1-->
                    <div class="form-group1">
                        <div class="remember-wrapper">
                            <input type="checkbox" id="remember" name="remember" value="1">
                            <label>Remember Me</label>
                        </div>


                        <a href=" reset_password">Forgot Password?</a>
                    </div>
                    <!-- Submit Button -->
                    <div class="button">
                        <button class="sign-in" name="signin">Sign In</button>
                    </div>

                </form>
            </div>

            <!-- End of Login Containter -->
        </div>
    </main>
</body>

</html>