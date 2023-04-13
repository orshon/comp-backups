<?php 
function getIPAddress(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])) $ip = $_SERVER['HTTP_CLIENT_IP'];  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
    else $ip = $_SERVER['REMOTE_ADDR'];
    return $ip;  
}
if(isset($_POST["g-recaptcha-response"]) && isset($_POST["name"]) && isset($_POST["phone"]) && isset($_POST["email"]) && isset($_POST["unit"]) && isset($_POST["text"])){
    $captcha = $_POST["g-recaptcha-response"];
    $secret   = '6Lcpu3EaAAAAAElnDz0QR8lSqQ4hPOYiTsoJs6y9';
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$captcha."&remoteip=".getIPAddress());
    $response = json_decode($response);
    if ($response->success == true && $response->score >= 0.5) {
        $strname = html_entity_decode(htmlentities($_POST["name"]));
        $strphone = html_entity_decode(htmlentities($_POST["phone"]));
        $stremail = html_entity_decode(htmlentities($_POST["email"]));
        $strunit = html_entity_decode(htmlentities($_POST["unit"]));
        $strtext = html_entity_decode(htmlentities($_POST["text"]));
        $mysqli = new mysqli("localhost", "u416943195_ttit", "1dFyZNk4s[R", "u416943195_ttit");
        if ($mysqli->connect_errno) {
            error_log($mysqli->connect_error);
            $_SESSION["alert"] = "שגיאה, נסו שנית";
            header("Location: /");
        }else{
            if ($mysqli->query("INSERT INTO `posts`(`name`,`phone`,`email`,`unit`,`text`) VALUES('$strname', '$strphone', '$stremail','$strunit','$strtext')") === TRUE) {
                $mysqli->close();
                $_SESSION["alert"] = "נשלח בהצלחה, תודה";
                $_SESSION["sent"] = 1;
                header("Location: /");
            } else {
                error_log($mysqli->error);
                $_SESSION["alert"] = "שגיאה, נסו שנית";
                header("Location: /");
            }
        }
    } else {
        error_log(print_r($response, true));
        $_SESSION["alert"] = "אימות לא תקין (".$response->score.")";
        header("Location: /");
    }
    exit();
}
$alert = "";
if(isset($_SESSION["alert"])) $alert = "<script>alert('".$_SESSION["alert"]."');</script>";
$_SESSION["alert"] = null;  
unset($_SESSION["alert"]);