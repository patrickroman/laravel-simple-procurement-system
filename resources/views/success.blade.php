<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>E-Procurement Success Page</title>
    <link rel="stylesheet" type="text/css" href="/reset.css">
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
                <img src="{{ asset('/bower_components/admin-lte/dist/img/PROMS LOGO 1.png') }}" alt="PROMS-logo" style="width: 250px;height:55px;"><br><br>


                <p>
                    Your Password was successfully updated. Please click <a href="{{route('login')}}">here</a> to login.
                </p>
            </div>
            <!-- End of Login Containter -->
        </div>
    </main>
</body>

</html>