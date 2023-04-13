<?php
function getIPAddress(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])) $ip = $_SERVER['HTTP_CLIENT_IP'];  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
    else $ip = $_SERVER['REMOTE_ADDR'];  
    return $ip;  
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST['recaptcha_response']) && isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["phone"]) && isset($_POST["note"])){
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = '6LceO0MaAAAAANqAmwNBWyOmcuEM8apwQaHHBjEG';
    $recaptcha_response = $_POST['recaptcha_response'];
    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);
    if($recaptcha->score >= 0.5) {
        require __DIR__."/PHPMailer/src/Exception.php";
        require __DIR__."/PHPMailer/src/PHPMailer.php";
        require __DIR__."/PHPMailer/src/SMTP.php";
        $strname = html_entity_decode(htmlentities($_POST["name"]));
        $strmail = html_entity_decode(htmlentities($_POST["email"]));
        $strphone = html_entity_decode(htmlentities($_POST["phone"]));
        $strnote = html_entity_decode(htmlentities($_POST["note"]));
        $date = date("H:i:s d/m/Y");
        $ip = getIPAddress();
        $agent = $_SERVER['HTTP_USER_AGENT'];
        $mail = new PHPMailer(TRUE);
        $mail->IsSMTP();
        $mail->Host = "smtp.hostinger.com";
        $mail->SMTPAuth = true;
        $mail->Port = 587; 
        $mail->CharSet = "UTF-8";
        $mail->Username = "team@dacs.co.il";
        $mail->Password = ":i+.q6AZ4N^?4V";
        $mail->From = "team@dacs.co.il";
        $mail->FromName = "הזמנה";
        $mail->addAddress("team@dacs.co.il", "שירותי פיתוח ואבטחת סייבר - טופס הרשמה");
        $mail->isHTML(true);
        $mail->Subject = "שירותי פיתוח ואבטחת סייבר - טופס הרשמה";
        $mail->Body = "
            <div style='text-align:right;direction:rtl;'>
                <h1>טופס הרשמה</h1>
                <p><b>שם מלא: </b>$strname</p>
                <p><b>כתובת מייל: </b>$strmail</p>
                <p><b>מספר טלפון: </b>$strphone</p>
                <p><b>הודעה או הערה: </b>$strnote</p>
                <p><b>תאריך ושעה: </b>$date</p>
                <p><b>Agent: </b>$agent</p>
                <p><b>IP: </b>$ip</p>
            </div>
        ";
        try {
            $mail->send();
            $_SESSION["alert"] = "נשלח בהצלחה, תודה";
            $_SESSION["sent"] = 1;
            header("Location: /");
        } catch (Exception $e) {
            error_log($mail->ErrorInfo);
            $_SESSION["alert"] = "שגיאה, נסו שנית";
            header("Location: /");
        }
    } else {
        $_SESSION["alert"] = "אימות לא תקין";
        header("Location: /");
    }
    exit();
}