<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>E-Procurement Change Password</title>
    <link rel="stylesheet" type="text/css" href="./reset.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400&display=swap" rel="stylesheet">
    <script type="text/javascript" src="login-regi.js" defer></script>
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
                <img src="{{ asset('/bower_components/admin-lte/dist/img/PROMS LOGO 1.png') }}" alt="PROMS-logo" style="width: 250px;height:55px;"><br><br>
                <h3>RESET PASSWORD</h3>

                <form action="change_password_process" method="post">
                    <!-- Form Group -->
                    @csrf
                    <div class="form-group">

                        <input type="email" id="username" name="email" placeholder="Email:" required>
                        <span class="text-danger"></span>
                        <input type="password" id="password" name="newpass" placeholder="New Password:" required>
                        <span class="text-danger"></span>
                    </div>
                    <!-- Submit Button -->
                    <div class="button">
                        <button class="change-password" name="changepass" value="change_pass">Change Password</button>
                    </div>
                </form>

            </div>

            <!-- End of Login Containter -->

        </div>
    </main>
</body>

</html>