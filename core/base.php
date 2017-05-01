<?php
  require_once 'connection.php';
  require_once 'session.php';
/*
 * Created by PhpStorm.
 * User: Maa
 * Date: 1/13/2017
 * Time: 9:56 PM
 */
class Base
{
    public $conn;
    public $pdo;
    public $objsession;
    function __construct()
    {
      $this->conn = new Connection;
      $this->pdo = $this->conn->GetConnect();
      $this->objsession = Session::getInstance();

    }

    function sanitize_input($data)
    {
       // PDO::quote()
        $data = trim($data);
        $data = strip_tags($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    function Login($email,$password)
    {

        //$email = sanitize_input($email);
        //$password = sanitize_input($password);

       if(isset($email) && isset($password))
       {
           //$password =  password_hash($password, PASSWORD_DEFAULT);
           $stmt = $this->pdo->prepare("SELECT UserSno,UserName,Email,`Password`,Mobile FROM `user` WHERE Active=1 AND Email = ?");
           $stmt->execute([$email]);
           $Result = $stmt->fetch(PDO::FETCH_OBJ);

           $user_browser = "";
           $UserSystemName = "";
           $UserSystemName = gethostname();
           // Get the user-agent string of the user.
           $user_browser = $_SERVER['HTTP_USER_AGENT'];
           $LoginTime = date('Y-m-d H:i:s');
           if ($stmt->rowCount() == 1)
           {
               // If the user exists we check if the account is locked
               // from too many login attempts

               /* if (checkbrute($email,$conn) == true)
                {
                    // Account is locked
                    // Send an email to user saying their account is locked
                    return false;
                }*/
               //else
               //{
               // Check if the password in the database matches
               // the password the user submitted. We are using
               // the password_verify function to avoid timing attacks.

               $UserPassword = $Result->Password;
               if (password_verify($password, $UserPassword))
               {
                   $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $email);
                   $LoginIp = $this->get_client_ip_server();
                   $UserSessionID = hash('sha512',$email.$user_browser.date('Y-m-d H:i:s'));

                   $this->objsession->UserSno = $Result->UserSno;
                   $this->objsession->UserName = $Result->UserName;
                   $this->objsession->Mobile = $Result->Mobile;
                   $this->objsession->LoggedIn = "loggedIn";
                   $this->objsession->Login_String = hash('sha512',$password.$user_browser);
                   $this->objsession->UserSessionID = $UserSessionID;
                   $this->objsession->Machine_Ip = $LoginIp;
                   $this->objsession->LoginInDateTime = date('Y-m-d H:i:s');
                   $this->objsession->UserSystemName = $UserSystemName;
                   $this->objsession->LAST_ACTIVITY = time();

                   // Log user login time
                   $this->SubmitUserLogInTime($Result->UserSno,$email,$LoginTime,$user_browser,$LoginIp,$UserSessionID);

                   echo "varified";
                   die();
               }
               else
               {

                   $LoginIp = $this->get_client_ip_server();
                   $this->SubmitFailedLoginAttempt($Result->UserSno,$email,$LoginTime,$user_browser,$LoginIp);
               }
            }
           else
           {
               $LoginTime = date('Y-m-d H:i:s');
               $LoginIp = $this->get_client_ip_server();
               $this->SubmitFailedLoginAttempt($Result->UserSno,$email,$LoginTime,$user_browser,$LoginIp);

           }
       }

    }
    function SubmitFailedLoginAttempt($UserSno,$Email,$Logintime,$User_Browser,$LoginIp)
    {
         // Password is not correct
        // We record this attempt in the database
        $LoginTime = date('Y-m-d H:i:s');
        //$LoginIp = $_SERVER['REMOTE_ADDR'];


        /*echo php_uname();
                   echo gethostname();
                   exit;*/
        $UserSystemName = "";
        $UserSystemName = gethostname();
        $LoginIp = $this->get_client_ip_server();
        $sql = $this->pdo->prepare("INSERT INTO loginattempts (InDateTime,UpdateOn,UpdatedBy,InUID,EmailID,LoginTime,Browser,MachineIP,MachineName) VALUES (?,?,?,?,?,?,?,?,?)");

        $sql->bindParam(1, $Logintime);
        $sql->bindParam(2, $Logintime);
        $sql->bindParam(3, $UserSno);
        $sql->bindParam(4, $UserSno);
        $sql->bindParam(5, $Email);
        $sql->bindParam(6, $Logintime);
        $sql->bindParam(7, $User_Browser);
        $sql->bindParam(8, $LoginIp);
        $sql->bindParam(9, $UserSystemName);
        $sql->execute();
        echo "unvarified";
        die();
        //return false;
    }
    function SubmitUserLogInTime($UserSno,$Email,$Logintime,$User_Browser,$LoginIp,$UserSessionID)
    {
         // Password is not correct
        // We record log in time in the database
        $LoginTime = date('Y-m-d H:i:s');
        /*echo php_uname();
                   echo gethostname();
                   exit;*/
        $UserSystemName = "";
        $UserSystemName = gethostname();
        $LoginIp = $this->get_client_ip_server();

        $sql = $this->pdo->prepare("INSERT INTO userinoutlog (InDateTime,UpdateOn,UpdatedBy,InUID,EmailID,UserInTime,Browser,MachineIP,MachineName,UserSessionID) VALUES (?,?,?,?,?,?,?,?,?,?)");

        $sql->bindParam(1, $Logintime);
        $sql->bindParam(2, $Logintime);
        $sql->bindParam(3, $UserSno);
        $sql->bindParam(4, $UserSno);
        $sql->bindParam(5, $Email);
        $sql->bindParam(6, $Logintime);
        $sql->bindParam(7, $User_Browser);
        $sql->bindParam(8, $LoginIp);
        $sql->bindParam(9, $UserSystemName);
        $sql->bindParam(10, $UserSessionID);
        $sql->execute();
        return false;
    }

    function SubmitUserLogOutTime($UserSessionID)
    {
        $LogOutTime = "";
        $LogOutTime = date('Y-m-d H:i:s');
        $update = $this->pdo->prepare("UPDATE userinoutlog SET UserOutTime= ? WHERE UserSessionID = ?");
        $update->bindParam(1, $LogOutTime);
        $update->bindParam(2, $UserSessionID);
        $update->execute();
        return false;
    }



    function checkbrute($user_id, $mysqli)
    {
        // Get timestamp of current time
        $now = time();

        // All login attempts are counted from the past 2 hours.
        $valid_attempts = $now - (2 * 60 * 60);

        if ($stmt = $mysqli->prepare("SELECT time 
                             FROM login_attempts 
                             WHERE user_id = ? 
                            AND time > '$valid_attempts'")) {
            $stmt->bind_param('i', $user_id);

            // Execute the prepared query.
            $stmt->execute();
            $stmt->store_result();

            // If there have been more than 5 failed logins
            if ($stmt->num_rows > 5) {
                return true;
            } else {
                return false;
            }
        }
    }



    function login_check($mysqli) {
        // Check if all session variables are set
        if (isset($_SESSION['user_id'],
            $_SESSION['username'],
            $_SESSION['login_string'])) {

            $user_id = $_SESSION['user_id'];
            $login_string = $_SESSION['login_string'];
            $username = $_SESSION['username'];

            // Get the user-agent string of the user.
            $user_browser = $_SERVER['HTTP_USER_AGENT'];

            if ($stmt = $mysqli->prepare("SELECT password 
                                      FROM members 
                                      WHERE id = ? LIMIT 1")) {
                // Bind "$user_id" to parameter.
                $stmt->bind_param('i', $user_id);
                $stmt->execute();   // Execute the prepared query.
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    // If the user exists get variables from result.
                    $stmt->bind_result($password);
                    $stmt->fetch();
                    $login_check = hash('sha512', $password . $user_browser);

                    if (hash_equals($login_check, $login_string) ){
                        // Logged In!!!!
                        return true;
                    } else {
                        // Not logged in
                        return false;
                    }
                } else {
                    // Not logged in
                    return false;
                }
            } else {
                // Not logged in
                return false;
            }
        } else {
            // Not logged in
            return false;
        }
    }

    function esc_url($url) {

        if ('' == $url) {
            return $url;
        }

        $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);

        $strip = array('%0d', '%0a', '%0D', '%0A');
        $url = (string) $url;

        $count = 1;
        while ($count) {
            $url = str_replace($strip, '', $url, $count);
        }

        $url = str_replace(';//', '://', $url);

        $url = htmlentities($url);

        $url = str_replace('&amp;', '&#038;', $url);
        $url = str_replace("'", '&#039;', $url);

        if ($url[0] !== '/') {
            // We're only interested in relative links from $_SERVER['PHP_SELF']
            return '';
        } else {
            return $url;
        }
    }

    // Function to get the client ip address
    function get_client_ip_server()
    {

        //$_SERVER['REMOTE_ADDR'] or $_SERVER['REMOTE_HOST']
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        }
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
        {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        }

        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        }

        else if(isset($_SERVER['HTTP_FORWARDED']))
        {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        }

        else if(isset($_SERVER['REMOTE_ADDR']))
        {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        }
        else
        {
            $ipaddress = 'UNKNOWN';
        }


        return $ipaddress;
    }
    /* Use for : This function help to find count of duplication data
     *       Paramter :
     *                 1)$TableName : In which table you have want to check duplication
     *                 2)$TableSno : Primary key of table
     *                 3)$Where : Whereclause
     *                 4) $Conn : Connection object
     */
    function getcount($TableName,$TableSno,$Where,$Conn)
    {
        $Result = "";
        $sql = "SELECT COUNT($TableSno) As count from $TableName WHERE $Where";
        $stmt = $Conn->query($sql);
        $Result = $stmt->fetch(PDO::FETCH_OBJ);
        return $Result->count;
        //$stmt->closeCursor(); // Close the old Connection
    }
    /**
     *
     * Sanatize a single var according to $type.
     * Allows for static calling to allow simple sanatization
     */
    public static function sanatizeItem($var, $type)
    {
        $flags = NULL;
        switch($type)
        {
            case 'url':
                $filter = FILTER_SANITIZE_URL;
                break;
            case 'int':
                $filter = FILTER_SANITIZE_NUMBER_INT;
                break;
            case 'float':
                $filter = FILTER_SANITIZE_NUMBER_FLOAT;
                $flags = FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND;
                break;
            case 'email':
                $var = substr($var, 0, 254);
                $filter = FILTER_SANITIZE_EMAIL;
                break;
            case 'string':
            default:
                $filter = FILTER_SANITIZE_STRING;
                $flags = FILTER_FLAG_NO_ENCODE_QUOTES;
                break;

        }
        $output = filter_var($var, $filter, $flags);
        return($output);
    }

    /**
     *
     * Validates a single var according to $type.
     * Allows for static calling to allow simple validation.
     *
     */
    public static function validateItem($var, $type)
    {
        $filter = false;
        switch($type)
        {
            case 'email':
                $var = substr($var, 0, 254);
                $filter = FILTER_VALIDATE_EMAIL;
                break;
            case 'int':
                $filter = FILTER_VALIDATE_INT;
                break;
            case 'boolean':
                $filter = FILTER_VALIDATE_BOOLEAN;
                break;
            case 'ip':
                $filter = FILTER_VALIDATE_IP;
                break;
            case 'url':
                $filter = FILTER_VALIDATE_URL;
                break;
        }
        return ($filter === false) ? false : filter_var($var, $filter) !== false ? true : false;
    }
    function UpdateUserActivityTime()
    {
        $this->objsession->LAST_ACTIVITY = time();
    }
    function UploadFileInFolder($FileControl,$FileType,$FileSize,$UploadPath)
    {
        $ErrMsg = "";
        $ValidFile = "";
        $NewFileName = "";
        $SubmitedFileName = "";
        $ReturnArray = array();
        if(!empty($FileControl))
        {
            if(is_array($FileControl))
            {
                $MaxFileSize = 1024 * 1024 * 10; // 10 mb
                $RequestedFileName = $FileControl['name'];
                $RequestedFileType = $FileControl['type'];
                $RequestedTmp_Name = $FileControl['tmp_name'];
                $RequestedErrorStatus = $FileControl['error'];
                $RequestedFileSize = $FileControl['size'];

                $FileName = pathinfo($RequestedFileName, PATHINFO_FILENAME);
                $FileExtension = pathinfo($RequestedFileName, PATHINFO_EXTENSION);

                if($RequestedFileSize < $MaxFileSize)
                {
                    switch(trim($FileType))
                    {
                        Case "image":
                        {

                            if (($RequestedFileType == 'application/octet-stream') or ($RequestedFileType == "image/gif") or ($RequestedFileType == "image/jpg") or ($RequestedFileType == "image/jpeg") or ($RequestedFileType == "image/pjpeg") or ($RequestedFileType == "image/png") or ($RequestedFileType == "image/x-png")) //or ($cntfile['type'] == "image/bmp")
                            {
                                $ValidFile = 1;
                                $ErrMsg = "Sucess";
                            }
                            else
                            {
                                $ErrMsg = "Invalid File";
                                $ValidFile = 0;
                                $NewFileName = "Null";
                            }
                            break;
                        }
                        default:
                        {
                            $ErrMsg = "Invalid File";
                            $ValidFile = 0;
                            $NewFileName = "Null";
                            break;
                        }
                    }

                    if($ValidFile == 1)
                    {

                        $time = date("YmdHis") . substr((string)microtime(), 2, 7); //date("YmdHisu");
                        //\W is the non-word character group. A word character is a-z, A-Z, 0-9, and _. \W matches everything not previously mentioned*.
                        $NewFileName = $str = preg_replace('/[^A-Za-z0-9\. -]/', '', $FileName).$time.".".$FileExtension;

                        $path = UPLOADPATH.$UploadPath."/".$NewFileName;


                        if(move_uploaded_file($RequestedTmp_Name,$path))
                        {
                            $SubmitedFileName = $NewFileName;
                        }

                    }
                }
                else
                {
                    $ErrMsg = "Big Size";
                    $ValidFile = false;
                    $NewFileName = "Null";

                }
            }
            else
            {
                $ErrMsg = "Not an array";
                $ValidFile = false;
                $NewFileName = null;
            }
        }
        else
        {
            $ErrMsg = "Empty array";
            $ValidFile = false;
            $NewFileName = null;
        }


        $ReturnArray[0] = $ErrMsg;
        $ReturnArray[1] = intval($ValidFile);
        $ReturnArray[2] = $NewFileName;
        return $ReturnArray;

    }
    function UnLinkFileFromFolder($FileName,$FolderName)
    {
        //$ReturnArray = array();
        $Path = UPLOADPATH.$FolderName;
        if(unlink($Path."/".$FileName) === true)
        {
            //$ReturnArray = array("Success");
            echo "File deleted";
        }
        else
        {
            echo "Failed";
            //$ReturnArray = array("Failed");
        }
       // return $ReturnArray;
    }

    function SetDatabaseDateFormat($date, $from_format = 'd/m/Y', $to_format = 'Y-m-d')
    {
        $date_aux = date_create_from_format($from_format, $date);
        return date_format($date_aux,$to_format);
    }
}