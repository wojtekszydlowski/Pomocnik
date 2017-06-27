<?php
/*
#Funkcja mail:

bool mail ( string $to , string $subject , string $message [, string $additional_headers] )

Wysyła wiadomość poczty elektronicznej adresowaną do $to o temacie $subject i treści:
$message
$additional_headers – dodatkowe nagłówki, takie jak From, Bcc, Cc, Reply-To, X-Mailer.

Przykład:

$to = 'nobody@example.com';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: webmaster@example.com'. "\r\n" . 'Reply-To: webmaster@example.com' . "\r\n" . 'X- Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

--

Przykład:
$message = '<html><body>Hello world</body></html>';
$to = 'mary@example.com' . ',' . 'kelly@example.com';

// To send HTML mail, the Content-type header must be set
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
$headers .= 'From: Birthday <birthday@example.com>' . "\r\n";
$headers .= 'Cc: john@example.com' . "\r\n";
$headers .= 'Bcc: bill@example.com' . "\r\n";

// Mail it
mail($to, $subject, $message, $headers);

--

#Nagłówek:
From – pole określające nadawcę np.: From: Jan Kowalski jan.kowalski@gmail.com
Cc – adresat kopi wiadomości, np.: Cc: Jan Kowalski jan.kowalski@gmail.com
Bcc – adresat ukrytej kopi wiadomości
Reply-To – adres do odpowiedzi
Content-type – typ zawartości, np.: Content-type: text/html; charset=UTF-8
X-Mailer – identyfikuje program wysyłający wiadomość

--

#PHPMailer:

PHPMailer jest biblioteką napisaną w PHP, która umożliwia wysyłanie maila w prosty sposób i oferuje szereg zaawansowanych opcji.
-Wysyłanie maili tekstowych i HTML
-Wysyłka za pośrednictwem SMTP
-Wspiera kodowanie UTF-8
-Wspiera ”podpisywanie” DKIM i S/MIME

Instalacja PHPMailera za pomocą Composera:
composer require phpmailer/phpmailer

https://github.com/PHPMailer/PHPMailer

Przykład:

$mail = new PHPMailer;
$mail->setFrom('from@example.com', 'Mailer');
$mail->addAddress('joe@example.net', 'Joe User');
$mail->addReplyTo('info@example.com', 'Information');

$mail->addAttachment('/var/tmp/file.tar.gz');
$mail->isHTML(true);

$mail->Subject = 'Here is the subject';
$mail->Body = 'This is the HTML <b>message body</b>';
$mail->AltBody = 'This is the body in plain text for non-
HTML mail clients';
if(!$mail->send()){
echo 'Message could not be sent.';
echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
echo 'Message has been sent';
}

*/

#Przykład z biblioteki PHPMaile z githuba:
require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'user@example.com';                 // SMTP username
$mail->Password = 'secret';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
$mail->CharSet = "UTF-8";  //Koduje do polskich znaków

$mail->setFrom('from@example.com', 'Mailer');
$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo('info@example.com', 'Information');
$mail->addCC('cc@example.com');
$mail->addBCC('bcc@example.com');

$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}



#---------------

/**
Napisz stronę kontakt posiadającą formularz z następującymi polami:

imię i nazwisko,
adres email,
treść wiadomości.

Wypełniony formularz ma być przesyłany w postaci emaila na ustalony w kodzie adres.

Skorzystaj z biblioteki PHPMailer.
 */

#Najpierw trzeba przejść do katalogu, w którym działamy i w konsoli wpisać:
//  composer require phpmailer/phpmailer
//Zainstaluje nam to w tym katalogu phpmailer'a


//require 'PHPMailerAutoload.php';

//Przykładowy plik z formularzem:
/*
<div>
    <form action="zadanie1.php" method="POST">
        <label>
Imię i nazwisko:
            <input type="text" name="userName">
        </label>
        <br><br>
        <label>
Adres email:
            <input type="text" name="userMail">
        </label>
        <br><br>
        <label>
Treść wiadomości:
            <textarea rows="4" cols="50" name="userMessage">

            </textarea>
        </label>
        <br><br>
        <input type="submit">
    </form>

</div>
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['userName']) && isset($_POST['userMail']) && isset($_POST['userMessage'])) {
        $userName = $_POST['userName'];
        $userMail = $_POST['userMail'];
        $userMessage = $_POST['userMessage'];




        require 'vendor/phpmailer/phpmailer/PHPMailerAutoload.php';

        $mail = new PHPMailer;


//$mail->isSMTP();                                      // Set mailer to use SMTP
//$mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
//$mail->SMTPAuth = true;                               // Enable SMTP authentication
//$mail->Username = 'szydlowski100@poczta.onet.pl';                 // SMTP username
//$mail->Password = 'secret';                           // SMTP password
//$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
//$mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom('szydlowski100@poczta.onet.pl', 'Administrator Wojtek');
        $mail->addAddress($userMail, $userName);     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo('szydlowski100@poczta.onet.pl', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
        $mail->CharSet = "UTF-8";
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);  // Set email format to HTML
        $mail->setLanguage('pl', '/optional/path/to/language/directory/');
//phpmailer.lang-pl.php
        $mail->Subject = "Mail od $userName";
        $mail->Body    = $userMessage;
//$mail->AltBody = $userMessage;

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent' . "<br>";
            echo "userName: $userName<br>";
            echo "userMail: $userMail<br>";
            echo "userMessage: $userMessage<br>";
        }


    }
}
