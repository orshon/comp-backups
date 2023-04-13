<?php
function authenticate() {
    header('WWW-Authenticate: Basic realm="Test Authentication System"');
    header('HTTP/1.0 401 Unauthorized');
    echo "You must enter a valid login ID and password to access this resource\n";
    exit;
}
if (!isset($_SERVER['PHP_AUTH_USER']) || ($_POST['SeenBefore'] == 1 && $_POST['OldAuth'] == $_SERVER['PHP_AUTH_USER'])) {
    authenticate();
} else {    
    if(htmlspecialchars($_SERVER['PHP_AUTH_USER']) == "kigel" && $_SERVER['PHP_AUTH_PW'] == "shmigel"){
        $mysqli = new mysqli("localhost", "u416943195_ttit", "1dFyZNk4s[R", "u416943195_ttit");
        if ($mysqli->connect_errno) {
            error_log($mysqli->connect_error);
            die($mysqli->connect_error);
        }else{
            $result = $mysqli->query("SELECT `id`,`name`,`phone`,`email`,`unit`,`text`,`date` FROM `posts`");
            echo <<<HTML
            <table border="1" style="text-align:center;margin:10px auto 0 auto;">
                <tr>
                    <th>ID</th>
                    <th>שם</th>
                    <th>טלפון</th>
                    <th>דואל</th>
                    <th>יחידה</th>
                    <th>הודעה</th>
                    <th>תאריך</th>
                    <th></th>
                </tr>
HTML;
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo <<<HTML
                    <tr>
                        <td>{$row["id"]}</td>
                        <td>{$row["name"]}</td>
                        <td>{$row["phone"]}</td>
                        <td>{$row["email"]}</td>
                        <td>{$row["unit"]}</td>
                        <td>{$row["text"]}</td>
                        <td>{$row["date"]}</td>
                    </tr>
HTML;
                }
            }
            echo "</table>";
        }
        $mysqli->close();
    }else authenticate();
}