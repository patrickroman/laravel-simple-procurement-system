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

                <p>
                    <?php
                    if (isset($_POST['reset'])) {
                        $email = $_POST['email'];
                    } else {
                        exit();
                    };
                    //Import PHPMailer classes into the global namespace
                    //These must be at the top of your script, not inside a function
                    use PHPMailer\PHPMailer\PHPMailer;
                    use PHPMailer\PHPMailer\SMTP;
                    use PHPMailer\PHPMailer\Exception;

                    require '..\mail\Exception.php';
                    require '..\mail\PHPMailer.php';
                    require '..\mail\SMTP.php';
                    //Create an instance; passing `true` enables exceptions
                    $mail = new PHPMailer(true);

                    try {
                        //Server settings
                        //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = "smtp.gmail.com";                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = "rlvigo@rtu.edu.ph"; //Set the SMTP username                     //SMTP username
                        $mail->Password   = 'reymart11';                               //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                        $mail->Port       =  465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                        //Recipients
                        $mail->setFrom('rlvigo@rtu.edu.ph', 'Admin');
                        $mail->addAddress($email);     //Add a recipient

                        $code = substr(str_shuffle("0123456789QWERTYUUIOPASDFGHJKLZXCVBNM"), 0, 10);

                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'PASSWORD RESET';
                        $mail->Body    = 'To reset your password click <a href="http://127.0.0.1:8000/change_password?code=' . $code . '">here</a>';

                        $dbhost = '127.0.0.1';
                        $dbuser = 'root';
                        $dbpassword = '';
                        $dbname = 'procurement_system';

                        $conn = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);

                        if ($conn->connect_error) {
                            die("Could not connect to database");
                        }

                        $verifyQuery = $conn->query("SELECT * FROM users WHERE Email = '$email'");

                        if ($verifyQuery->num_rows) {
                            $codeQuery = $conn->query("UPDATE users SET code ='$code' WHERE Email = '$email'");
                            $mail->send();
                            echo 'Message has been sent, please check your email address <a href="http://gmail.com">here</a>';
                        };

                        $conn->close();
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }

                    ?>

                </p>
            </div>

            <!-- End of Login Containter -->

        </div>
    </main>
</body>

</html>
