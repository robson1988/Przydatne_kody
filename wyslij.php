<?php


 include_once 'PHPMailer/src/Exception.php';
 include_once 'PHPMailer/src/PHPMailer.php';
 include_once 'PHPMailer/src/SMTP.php';

 $customerMessage = file_get_contents('Maile/fitbox.html');

 $mail = new \PHPMailer\PHPMailer\PHPMailer(true);


  try {
  //Server settings
  $mail->isSMTP();                                            // Send using SMTP
  $mail->Host       = 'mail.fitbox.com.pl';                       // Set the SMTP server to send through
  $mail->SMTPAuth   = true;
  //$mail->SMTPDebug = true;
  $mail->SMTPSecure = 'smtp';                         // Enable SMTP authentication
  $mail->Username   = 'fitbox@fitbox.com.pl';               // SMTP username
  $mail->Password   = 'Lbu7QKLcgYDLF8H7';
  $mail->CharSet 		= "UTF-8";
  // 'echo' or 'error_log'
  //$mail->Debugoutput = 'echo';                   // SMTP password
  //$mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
  $mail->Port       = 587;                                    // TCP port to connect to
  //Recipients

  if (($handle = fopen('u.csv', 'r')) !== FALSE) { // Check the resource is valid
      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { // Check opening the file is OK!

        $mail->setFrom('fitbox@fitbox.com.pl', 'FitBOX');
        $mail->addAddress($data[0]);
        $mail->addReplyTo('fitbox@fitbox.com.pl', 'FitBOX');

        // Content
        $mail->isHTML(true);                                       // Set email format to HTML
        $mail->Subject = "Dziękujemy za zaufanie i wybór naszego cateringu dietetycznego!🥑🥦🍱";
        $mail->MsgHTML($customerMessage);
        $mail->Send();
        $mail->ClearAllRecipients();

      }
      fclose($handle);
  } else {
    echo "blad;"
  }



  // Add the admin address
  //$mail->AddAddress('office.rbcode@gmail.com');
  //$mail->Send();
  } catch (Exception $e){
    echo "Wystąpił błąd podczas wysyłki wiadomości.";
    echo '<br/>Informacja developerska: '.$e;
  }
  //wiadomość o wysłaniu wiadomości
 echo "ok";
