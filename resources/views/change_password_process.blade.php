<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>E-Procurement Check Email</title>
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



                <?php

                $dbhost = '127.0.0.1';
                $dbuser = 'root';
                $dbpassword = '';
                $dbname = 'procurement_system';

                $conn = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);

                if ($conn->connect_error) {
                    die('Could not connect to database');
                };

                if (isset($_POST['changepass'])) {
                    $email = $_POST['email'];
                    $newpassword = $_POST['newpass'];

                    $newpassword =  $newpassword;

                    $changeQuery = $conn->query("UPDATE users SET Password= '$newpassword' WHERE email = '$email'");

                    if ($changeQuery) {
                        echo "<p class='msg'>Your Password was successfully updated. Click <a href='/'> here</a> to Login</p>";
                    } else {
                        echo "Your Password Change was Unsuccessfull";
                    }
                }

                ?>

            </div>

            <!-- End of Login Containter -->

        </div>
    </main>
</body>

</html>
