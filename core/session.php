<?php
/**
 * Created by PhpStorm.
 * User: Maa
 * Date: 2/4/2017
 * Time: 2:19 PM
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
        if ($this->sessionState == self::SESSION_NOT_STARTED )
        {
            session_name('ladylike');
            $this->sessionState = session_start();
            session_regenerate_id();
            //session_cache_expire(10000);
            $secure = true;
            // This stops JavaScript being able to access the session id.
            $httponly = true;

            // Forces sessions to only use cookies.
            /*if (ini_set('session.use_only_cookies', 1) === FALSE)
            {
                header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
                exit();
            }
            // Gets current cookies params.
            $cookieParams = session_get_cookie_params();
            session_set_cookie_params($cookieParams["lifetime"],
                $cookieParams["path"],
                $cookieParams["domain"],
                $secure,
                $httponly);*/

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

    public function __get($name)
    {
        if ( isset($_SESSION[$name]))
        {
            return $_SESSION[$name];
        }
    }


    public function __isset($name)
    {
        return isset($_SESSION[$name]);
    }


    public function __unset($name)
    {
        unset($_SESSION[$name]);
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
            unset($_SESSION );

            return !$this->sessionState;
        }

        return FALSE;
    }
}


/*class session
{
    function __construct()
    {
        // set our custom session functions.
        session_set_save_handler(array($this, 'open'), array($this, 'close'), array($this, 'read'), array($this, 'write'), array($this, 'destroy'), array($this, 'gc'));

        // This line prevents unexpected effects when using objects as save handlers.
        register_shutdown_function('session_write_close');
    }
}

*/







