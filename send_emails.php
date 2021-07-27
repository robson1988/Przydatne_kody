<?php

/////////////////////
///////////   Plik do wysyłki mailingu przygotowanego i zapisanego jako plik html.
///////////   Lista maili jest pobierana z pliku csv o nazwie users.csv
///////////   Skrypt używa biblioteki PHPMailer do wysyłki
///////////////////////////////////////////
 include_once 'PHPMailer/src/Exception.php';
 include_once 'PHPMailer/src/PHPMailer.php';
 include_once 'PHPMailer/src/SMTP.php';

 $customerMessage = file_get_contents('szablon.html');

 $mail = new \PHPMailer\PHPMailer\PHPMailer(true);


  try {
  //Server settings
  $mail->isSMTP();                                            // Send using SMTP
  $mail->Host       = 'Do_uzupełnienia_host';                       // Set the SMTP server to send through
  $mail->SMTPAuth   = true;
  $mail->SMTPSecure = 'smtp';                         // Enable SMTP authentication
  $mail->Username   = 'Do_uzupełnienia_login';               // SMTP username
  $mail->Password   = 'Do_uzupełnienia_haslo';
  $mail->CharSet 		= "UTF-8";
  $mail->Port       = 587;                                    // TCP port to connect to
  //Recipients

  if (($handle = fopen('u.csv', 'r')) !== FALSE) { // Check the resource is valid
      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { // Check opening the file is OK!

        $mail->setFrom('adres_email_wysyłającego', 'nazwa_wysyłającego');
        $mail->addAddress($data[0]);
        $mail->addReplyTo('adres_email_wysyłającego', 'nazwa_wysyłającego');

        // Content
        $mail->isHTML(true);                                       // Set email format to HTML
        $mail->Subject = "Tytuuł_mailingu";
        $mail->MsgHTML($customerMessage);
        $mail->Send();
        $mail->ClearAllRecipients();

      }
      fclose($handle);
  } else {
    echo "blad;"
  }

  } catch (Exception $e){
    echo "Wystąpił błąd podczas wysyłki wiadomości.";
    echo '<br/>Informacja developerska: '.$e;
  }
  //wiadomość o wysłaniu wiadomości
 echo "ok";

