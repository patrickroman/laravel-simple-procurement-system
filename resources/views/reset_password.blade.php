<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>E-Procurement Reset Password</title>
    <link rel="stylesheet" href="./reset.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400&display=swap" rel="stylesheet">

</head>

<body>
    <main>
        <!--RTU LOGO-->
        <div class="container">
            <div class="logo">
                <img src="{{ asset('/bower_components/admin-lte/dist/img/rtu-logo.png') }}" alt="rtu-logo">
            </div>

            <!-- LOGIN FORM -->
            <div class="login-container">
                <img src="{{ asset('/bower_components/admin-lte/dist/img/PROMS LOGO 1.png') }}" style="width: 250px;height:55px;"><br><br>
                <h3>Reset Password</h3>

                <form action="forgot_password" method="post">
                    @csrf
                    <!-- Form Group -->
                    <div class="form-group">
                        <input type="email" id="username" name="email" placeholder="Email:" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="button">
                        <button class="reset" name="reset">Reset</button>
                    </div>
                </form>
            </div>

            <!-- End of Login Containter -->

        </div>
    </main>
</body>

</html>