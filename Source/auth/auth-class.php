<?php
session_start();
class authclass {
	public function isAuth() {
        if (isset($_SESSION["is_auth"])) { 
            return $_SESSION["is_auth"]; 
        }
        else return false; 
    }
    public function registration($mail, $password, $firstname, $lastname) {//firstname, lastname
        require '../connect.php';
        $link = mysqli_connect($host, $user, $password, $database) 
             or die("Ошибка " . mysqli_error($link));
        $link->set_charset("utf8");
        $query ="SELECT id, verification FROM users where mail = '".$mail."'";     
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
        $row = mysqli_fetch_row($result);
        if(isset($row)) {
        	if ($row[1] === '') {
            	//$_SESSION["is_auth"] = false;
 	            mysqli_close($link);
            	return false; 
        	} else {
        		$query ="DELETE FROM users WHERE id = '".$row[0]."'";     
        		$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
        	}
    	}
        	$password = md5($password);
        	$query ="INSERT INTO users VALUES ('', '$mail', '$password', '$firstname', '$lastname','')";     
        	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
            mysqli_close($link);
        	return true;
    	    
    }
    public function auth($mail, $password) {
        require 'connect.php';
        $link = mysqli_connect($host, $user, $password, $database) 
             or die("Ошибка " . mysqli_error($link));
        $link->set_charset("utf8");
        $password = md5($password);
        $query ="SELECT * FROM users where mail = '".$mail."' and password = '".$password."'";     
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
        $row = mysqli_fetch_row($result);
        if (isset($row)) {
        	if($row[5] !== '') return 2;
            $_SESSION["is_auth"] = true; 
            $_SESSION["mail"] = $mail;
            $_SESSION["id"] = $row[0];
            $_SESSION["firstname"] = $row[3];
            $_SESSION['lastname'] = $row[4];
            mysqli_close($link);
        	return true;
    	} else {
            $_SESSION["is_auth"] = false;
            mysqli_close($link);
            return false; 
    	}
    }
    private function getIp(){
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = @$_SERVER['REMOTE_ADDR'];
 
        if(filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
        elseif(filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
        else $ip = $remote;
        return $ip;
    }
	
    public function get_id() {
        if ($this->isAuth()) { 
            return $_SESSION["id"];
        }
    }
    public function get_name() {
    	$output = [];
        if ($this->isAuth()) { 
            $output['firstname'] = $_SESSION["firstname"];
            $output['lastname'] = $_SESSION["lastname"];
        } else {
        	$output['firstname'] = 'Гость';
        	$output['lastname'] = '';
        }
        return $output;
    }
    public function out() {
        $_SESSION = array(); 
        session_destroy(); 
    }
}
$auth = new authclass();
if (isset($_POST["login"]) && isset($_POST["password"])) { 
    if (!$auth->auth($_POST["login"], $_POST["password"])) { 
        echo "<h2 style=\"color:red;\">Логин и пароль введен не правильно!</h2>";
    }
}
if (isset($_GET["is_exit"])) {
    if ($_GET["is_exit"] == 1) {
        $auth->out(); 
        header("Location: ?is_exit=0");
    }
    }
 if (isset($_GET["is_exit"])) {
    if ($_GET["is_exit"] == 0) {
            //header("Location: table.php");
    }
    }
?>