<?php
use PHPMailer\PHPMailer\PHPMailer;

require __DIR__.'/vendor/autoload.php';
$loader = new Twig_Loader_Filesystem(__DIR__.'/templates');
$twig = new Twig_Environment($loader);

$actual_link = $_SERVER['REQUEST_URI'];

if ("/services" == $actual_link) {
    echo $twig->render('services.html');
}
else if ("/contact" == $actual_link) {
    echo $twig->render('contact.html');
}
else if ("/contact/send" == $actual_link) {
    if( !isset($_POST['email']) || !isset($_POST['subject']) || !isset($_POST['body']) )
    {
        echo "Ein Fehler ist aufgetreten. Versuchen Sie es erneut, sofern der Fehler bestehen bleibt versuchen Sie es später nochmal.";
        return;
    }
    
    if( empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['body']) )
    {
        echo "Füllen Sie bitte alle Felder aus.";
        return;
    }
    
    
    $fromMailAdress = "bot@bossnet.ch";
    $recipients = array(
        'boss@bossnet.ch',
        'steven.pilatschek@bossnet.ch',
    );
    
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings                                   // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'mail.stepping-stone.ch';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = $fromMailAdress;                     // SMTP username
        $mail->Password   = '6iBZa?3Z~=s4';                               // SMTP password
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom($fromMailAdress);
        foreach($recipients as $email) {
            $mail->addAddress($email);
        }
        
        $message = "<b><i>From:</b></i> " . $_POST['email'] . "<br><br><b><i>Message:</b></i><br><br>" . $_POST['body']; 

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $_POST['subject'];
        $mail->Body    = $message;
        $mail->AltBody = $message;

        $mail->send();
        
        echo "Die Email wurde erfolgreich gesendet.";
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    
}
else {
    echo $twig->render('index.html');
}
