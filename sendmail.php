<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//required files
require 'phpmail/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'phpmail/vendor/phpmailer/phpmailer/src/Exception.php';
require 'phpmail/vendor/phpmailer/phpmailer/src/SMTP.php';

require 'phpmail/vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
if (isset($_POST["send"])) {

    $mail = new PHPMailer(true);
   

    //Server settings
    $mail->isSMTP();                              //Send using SMTP
    $mail->Host       = 'sandbox.smtp.mailtrap.io';       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;             //Enable SMTP authentication
    $mail->Username   = '4b0e184cc942ef';   //SMTP write your email
    $mail->Password   = '25620586cc074e';      //SMTP password
   // $mail->SMTPSecure = 'ssl';            //Enable implicit SSL encryption
    $mail->Port       = 2525;                                    

    //Recipients
    $mail->setFrom( $_POST["email"], $_POST["name"]); // Sender Email and name
    $mail->addAddress('anupamfbd17@gmail.com');     //Add a recipient email  
    $mail->addReplyTo($_POST["email"], $_POST["name"]); // reply to sender email
    $mail->addCC('anupamfbd17@gmail.com');
    $mail->addBCC('annol46740@gmail.com');

    //Content
    $mail->isHTML(true);               //Set email format to HTML
    $mail->Subject = $_POST["subject"];   // email subject headings
    $mail->Body    = $_POST["message"]; //email message
    if(!empty($_FILES["uploadfile"]["name"])){
        $mail->addAttachment ($_FILES["uploadfile"]["tmp_name"],$_FILES["uploadfile"]["tmp_name"]);
    }

    $mail->send();
    echo
    " 
    <script> 
     alert('Message was sent successfully!');
     document.location.href = 'user.php';
    </script>
    ";
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">

    <title>CRUD OPERATIONS!</title>
  </head>
  <body>
    <main class="container p-3 mb-2 bg-secondary my-5 w-50 text-white">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group ">
            <label for="contactName">Name</label>
                <input type="text" class="form-control" name="name" id="" placeholder="Your name" required>
            </div>
            <div class="form-group">
            <label for="contactEmail">Email</label>
                <input type="email" class="form-control" name="email" id="" placeholder="Your Email" required>
            </div>
            <div class="form-group">
            <label for="contactSubject">Subject</label>
                <input type="text" class="form-control" name="subject" id="" placeholder="Enter the subject you want to contact for..." required>
            </div>
            <div class="form-group">
                <label for="contactMsg">Message</label>
                <textarea name="message" class="form-control" id="" cols="30" rows="5" placeholder="Write your message here..." required ></textarea>
            </div>
            <div class="form-group">
                <input type="file" class="form-control" name="uploadfile" id=""/>
            </div>
            <button type="submit" class="btn btn-success" name="send">Send</button>
        </form>
    </main>
</body>
</html>