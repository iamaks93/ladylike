<?php
/**
 * Created by PhpStorm.
 * User: Maa
 * Date: 2/8/2017
 * Time: 9:06 PM
 */



// Slug



$products = [
    [
        'title' =>  'Cool T-Shirt',
        'size'  =>  'S',
        'eur'   =>  '100',
    ],
    [
        'title' =>  'Cool T-Shirt',
        'size'  =>  'M',
        'eur'   =>  '200',
    ],
    [
        'title' =>  'Cool T-Shirt',
        'size'  =>  'L',
        'eur'   =>  '300',
    ],

];

$titleArr = array_map(function($product) {

    $title = $product['title'] . ' ' .  $product['size'] . ' ' . $product['eur'];

    return preg_replace(
        '/[^a-zA-Z0-9]/', '-', strtolower(trim(strip_tags($title)))
    );

}, $products);

///RESULT

print_r($titleArr);


$string = 'very long description of some product and something else';

function slugify($string)
{
    return preg_replace(
        '/[^a-zA-Z0-9]/', '-', strtolower(trim(strip_tags($string)))
    );
}


echo slugify($string);



//https://gist.github.com/sgmurphy/3098978



class ClassNameA
{
    private $session;
    private $name;
    private $email;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->session->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->session->name;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->session->email = $email;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->session->email;
    }

}


$session = Session::getInstance();
$user = new ClassNameA($session);

$user->setName('Alex');
$user->setEmail('aaa@bbb.net');

echo $user->getName();
echo $user->getEmail();

//or

echo $session->name;
echo $session->email;








//


class ClassNameB
{
    private $session;
    private $name;
    private $email;

    public function __construct()
    {
        $this->session = Session::getInstance();
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->session->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->session->name;
    }


    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->session->email = $email;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->session->email;
    }

}

$user = new ClassNameB();

$user->setName('Alex');
$user->setEmail('aaa@bbb.net');

echo $user->getName();
echo $user->getEmail();



//Cron job

//http://kvz.io/blog/2007/07/29/schedule-tasks-on-linux-using-crontab/



/*
    Examples:
*/

// We get the instance
$data = Session::getInstance();

// Let's store datas in the session
$data->nickname = 'Someone';
$data->age = 18;

// Let's display datas
printf( '<p>My name is %s and I\'m %d years old.</p>' , $data->nickname , $data->age );

/*
    It will display:

    Array
    (
        [nickname] => Someone
        [age] => 18
    )
*/

printf( '<pre>%s</pre>' , print_r( $_SESSION , TRUE ));

// TRUE
var_dump( isset( $data->nickname ));

// We destroy the session
$data->destroy();

// FALSE
var_dump( isset( $data->nickname ));

?>






function start_session($session_name, $secure) {
    // Make sure the session cookie is not accessible via javascript.
    $httponly = true;

    // Hash algorithm to use for the session. (use hash_algos() to get a list of available hashes.)
    $session_hash = 'sha512';

    // Check if hash is available
    if (in_array($session_hash, hash_algos())) {
        // Set the has function.
        ini_set('session.hash_function', $session_hash);
    }
    // How many bits per character of the hash.
    // The possible values are '4' (0-9, a-f), '5' (0-9, a-v), and '6' (0-9, a-z, A-Z, "-", ",").
    ini_set('session.hash_bits_per_character', 5);

    // Force the session to only use cookies, not URL variables.
    ini_set('session.use_only_cookies', 1);

    // Get session cookie parameters
    $cookieParams = session_get_cookie_params();
    // Set the parameters
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
    // Change the session name
    session_name($session_name);
    // Now we cat start the session
    session_start();
    // This line regenerates the session and delete the old one.
    // It also generates a new encryption key in the database.
    session_regenerate_id(true);
}

require('session.class.php');
$session = new session();
// Set to true if using https
$session->start_session('_s', false);

$_SESSION['something'] = 'A value.';
echo $_SESSION['something'];



// Error Reporting

// Turn off all error reporting
error_reporting(0);

// Report simple running errors
error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Reporting E_NOTICE can be good too (to report uninitialized
// variables or catch variable name misspellings ...)
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

// Report all errors except E_NOTICE
error_reporting(E_ALL & ~E_NOTICE);

// Report all PHP errors (see changelog)
error_reporting(E_ALL);

// Report all PHP errors
error_reporting(-1);





// Same as error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);



// Error Handler function


//error handler function
function customError($errno, $errstr) {
    echo "<b>Error:</b> [$errno] $errstr";
}

//set error handler
set_error_handler("customError");

//trigger error
echo($test);


/*
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/config.php');*/




// Templete reference

http://www.venmond.com/demo/vendroid


//http://php.net/manual/en/function.session-start.php





//Use this small snippet inside your bootstrap in order to always have a way to know reliably what was the last page of your site that the user have visited, without having to use $_SERVER['HTTP_REFERER'].

session_start();

// Get current page
$current_page = htmlspecialchars($_SERVER['SCRIPT_NAME'], ENT_QUOTES, 'UTF-8');
$current_page .= $_SERVER['QUERY_STRING'] ? '?'.htmlspecialchars($_SERVER['QUERY_STRING'], ENT_QUOTES, 'UTF-8') : '';

// Set previous page at the end
register_shutdown_function(function ($current_page) {
    $_SESSION['previous_page'] = $current_page;
}, $current_page);




//cookie expiration
/*
private function startSession($time = 3600, $ses = 'MYSES') {
    session_set_cookie_params($time);
    session_name($ses);
    session_start();

    // Reset the expiration time upon page load
    if (isset($_COOKIE[$ses]))
        setcookie($ses, $_COOKIE[$ses], time() + $time, "/");
}*/


//PHP_EOL


//http://www.phptherightway.com/pages/Design-Patterns.html
//http://php-di.org/doc/understanding-di.html




/*SELECT Timein,
  CONVERT(VARCHAR(8), Timein, 108) + ' ' + right(convert(varchar(30), Timein, 9), 2) from phpers order by Timein asc


create table phpers (Timein Time);

insert into phpers values ('9:12:16');
insert into phpers values ('18:12:16');
insert into phpers values ('10:12:16');
insert into phpers values ('15:12:16');
insert into phpers values ('12:12:16');*/

//RewriteRule ^(.*)$ index.php?url=$1 [QSA,L]


// header("Location: ".$_SERVER['HTTP_REFERER']); go back page


/*(function(){
    setTimeout(function(){
        location.href = '/customer/account/logout';
    },60000);
})();*/

//location.reload();


/*var check = function() {
    // Make AJAX call
    var call = $.get('/path/to/php/file');

    // Check returned promise
    call
    .done(function(data){
        if(!data.loggedIn) window.location.href='http://www.google.com';
    });
}*/

//http://php.net/manual/en/functions.anonymous.php

//closure factory

//Data table
/*
$('#example tbody').on( 'click', 'td', function () {
    alert('Data:'+$(this).html().trim());
    alert('Row:'+$(this).parent().find('td').html().trim());
    alert('Column:'+$('#example thead tr th').eq($(this).index()).html().trim());
});*/

//get host by name
echo gethostname();
echo "<br>";
//get OS
echo php_uname();


function _replace($message,$replace_array) {
$i = 0;
$j = count($replace_array) - 1;
foreach ($replace_array as $k => $v) {
$pattern[$i] = "/\[\[$k\]\]/";
$replacements[$j] = $v;
$i++;
$j--;
}
return preg_replace($pattern,$replacements,$message);
}

$name = 'John';
$order_num = 12241;
$email = 'test@mail.com';
$replace_array = ['name' => $name, 'order_num' => $order_num ,'email'=> $email];

// get your template from database;
// user can edit template from CMS editor;
$message = 'Dear [[name]],<br><br>
Your Order Number is: [[order_num]]<br><br>
We send this mail to: [[email]]';

// send this to recipient
// mail($to,$subject,$message,$headers);
echo $message = _replace($message,$replace_array);
?>





If you want to handle sessions with a class, I wrote this little class:

<?php

/*
    Use the static method getInstance to get the object.
*/

class Session
{
    const SESSION_STARTED = TRUE;
    const SESSION_NOT_STARTED = FALSE;

    // The state of the session
    private $sessionState = self::SESSION_NOT_STARTED;

    // THE only instance of the class
    private static $instance;


    private function __construct() {}


    /**
     *    Returns THE instance of 'Session'.
     *    The session is automatically initialized if it wasn't.
     *
     *    @return    object
     **/

    public static function getInstance()
    {
        if ( !isset(self::$instance))
        {
            self::$instance = new self;
        }

        self::$instance->startSession();

        return self::$instance;
    }


    /**
     *    (Re)starts the session.
     *
     *    @return    bool    TRUE if the session has been initialized, else FALSE.
     **/

    public function startSession()
    {
        if ( $this->sessionState == self::SESSION_NOT_STARTED )
        {
            $this->sessionState = session_start();
        }

        return $this->sessionState;
    }


    /**
     *    Stores datas in the session.
     *    Example: $instance->foo = 'bar';
     *
     *    @param    name    Name of the datas.
     *    @param    value    Your datas.
     *    @return    void
     **/

    public function __set( $name , $value )
    {
        $_SESSION[$name] = $value;
    }


    /**
     *    Gets datas from the session.
     *    Example: echo $instance->foo;
     *
     *    @param    name    Name of the datas to get.
     *    @return    mixed    Datas stored in session.
     **/

    public function __get( $name )
    {
        if ( isset($_SESSION[$name]))
        {
            return $_SESSION[$name];
        }
    }


    public function __isset( $name )
    {
        return isset($_SESSION[$name]);
    }


    public function __unset( $name )
    {
        unset( $_SESSION[$name] );
    }


    /**
     *    Destroys the current session.
     *
     *    @return    bool    TRUE is session has been deleted, else FALSE.
     **/

    public function destroy()
    {
        if ( $this->sessionState == self::SESSION_STARTED )
        {
            $this->sessionState = !session_destroy();
            unset( $_SESSION );

            return !$this->sessionState;
        }

        return FALSE;
    }
}

/*
    Examples:
*/

// We get the instance
$data = Session::getInstance();

// Let's store datas in the session
$data->nickname = 'Someone';
$data->age = 18;

// Let's display datas
printf( '<p>My name is %s and I\'m %d years old.</p>' , $data->nickname , $data->age );

/*
    It will display:

    Array
    (
        [nickname] => Someone
        [age] => 18
    )
*/

printf( '<pre>%s</pre>' , print_r( $_SESSION , TRUE ));

// TRUE
var_dump( isset( $data->nickname ));

// We destroy the session
$data->destroy();

// FALSE
var_dump( isset( $data->nickname ));

?>

I prefer using this class instead of using directly the array $_SESSION.

var formElement = document.querySelector("form");
var formData = new FormData(formElement);














































class ClassNameA
{
private $session;
private $name;
private $email;

public function __construct(Session $session)
{
$this->session = $session;
}

/**
* @param mixed $name
*/
public function setName($name)
{
$this->session->name = $name;
}

/**
* @return mixed
*/
public function getName()
{
return $this->session->name;
}

/**
* @param mixed $email
*/
public function setEmail($email)
{
$this->session->email = $email;
}

/**
* @return mixed
*/
public function getEmail()
{
return $this->session->email;
}

}


$session = Session::getInstance();
$user = new ClassNameA($session);

$user->setName('Alex');
$user->setEmail('aaa@bbb.net');

echo $user->getName();
echo $user->getEmail();

//or

echo $session->name;
echo $session->email;