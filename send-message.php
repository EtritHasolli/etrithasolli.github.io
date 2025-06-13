<?php
    ob_start();
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'etrithasolli5@gmail.com';
            $mail->Password = $_ENV['MAIL_PASSWORD'];
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Get form data
            $name = htmlspecialchars($_POST["name"]);
            $email = htmlspecialchars($_POST["email"]);
            $subject = htmlspecialchars($_POST["subject"]);
            $message = htmlspecialchars($_POST["message"]);

            // Sender and receiver
            $mail->setFrom($email, $name);
            $mail->addAddress('etrithasolli5@gmail.com');

            // Email content
            $mail->Subject = $subject;
            $mail->Body    = "From: " . $name . "\n"
                          . "Email: " . $email . "\n\n"
                          . "Message:\n" . $message;

            $mail->send();
            
            // Show thank you message
            echo '<!DOCTYPE HTML>
            <html>
                <head>
                    <title>Thank You - Etrit Hasolli</title>
                    <meta charset="utf-8" />
                    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
                    <link rel="stylesheet" href="assets/css/main.css" />
                    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
                    <style>
                        body {
                            background-color: #1a1a1a;
                            color: #ffffff;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            min-height: 100vh;
                            margin: 0;
                            font-family: "Source Sans Pro", Helvetica, sans-serif;
                        }
                        .thank-you-container {
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            justify-content: center;
                            text-align: center;
                            padding: 2rem;
                        }
                        h1 {
                            font-size: 3rem;
                            margin-bottom: 1rem;
                            color: #ffffff;
                        }
                        p {
                            font-size: 1.2rem;
                            margin-bottom: 2rem;
                            color: #ffffff;
                        }
                        .button {
                            background: transparent;
                            color: #ffffff !important;
                            border: 3px solid #ffffff;
                            padding: 1rem 2rem;
                            font-size: 1.1rem;
                            font-weight: 700;
                            letter-spacing: 2px;
                            cursor: pointer;
                            transition: all 0.3s ease;
                            text-decoration: none;
                            display: inline-block;
                            border-radius: 0;
                            align-items: center;
                            display: flex;
                            justify-content: center;
                            width: fit-content;
                        }
                        .button:hover {
                            color: #24b9eb;
                            border: 2px solid #24b9eb;
                        }
                    </style>
                </head>
                <body>
                    <div class="thank-you-container">
                        <h1>Thank You!</h1>
                        <p>Thank you for contacting me. I will reply to your message as soon as possible.</p>
                        <a href="about.php" class="button">RETURN TO ABOUT PAGE</a>
                    </div>
                </body>
            </html>';
            exit;
            
        } catch (Exception $e) {
            echo '<!DOCTYPE HTML>
            <html>
                <head>
                    <title>Error - Etrit Hasolli</title>
                    <meta charset="utf-8" />
                    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
                    <link rel="stylesheet" href="assets/css/main.css" />
                    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
                    <style>
                        body {
                            background-color: #1a1a1a;
                            color: #ffffff;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            min-height: 100vh;
                            margin: 0;
                            font-family: "Source Sans Pro", Helvetica, sans-serif;
                        }
                        .error-container {
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            justify-content: center;
                            text-align: center;
                            padding: 2rem;
                        }
                        h1 {
                            font-size: 3rem;
                            margin-bottom: 1rem;
                            color: #ffffff;
                        }
                        p {
                            font-size: 1.2rem;
                            margin-bottom: 2rem;
                            color: #ffffff;
                        }
                        .button {
                            background: transparent;
                            color: #ffffff !important;
                            border: 3px solid #ffffff;
                            padding: 1rem 2rem;
                            font-size: 1.1rem;
                            font-weight: 700;
                            letter-spacing: 2px;
                            cursor: pointer;
                            transition: all 0.3s ease;
                            text-decoration: none;
                            display: inline-block;
                            border-radius: 0;
                            align-items: center;
                            display: flex;
                            justify-content: center;
                            width: fit-content;
                        }
                        .button:hover {
                            color: #24b9eb;
                            border: 2px solid #24b9eb;
                        }
                    </style>
                </head>
                <body>
                    <div class="error-container">
                        <h1>Oops!</h1>
                        <p>Sorry, there was an error sending your message. Please try again later.</p>
                        <a href="about.php" class="button">RETURN TO ABOUT PAGE</a>
                    </div>
                </body>
            </html>';
        }
    }
?> 