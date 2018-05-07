<?php

namespace app\services;

/**
 * Session driver
 */
class Session
{
    const SESSION_STARTED = true;
    const SESSION_NOT_STARTED = false;
    
    // The state of the session
    private $_sessionState = self::SESSION_NOT_STARTED;
    
    // THE only instance of the class
    private static $_instance;

    /**
     * Empty contructor
     */
    private function __construct()
    {
    }

    /**
     * Returns THE instance of 'Session'.
     * The session is automatically initialized if it wasn't.
     *    
     * @return object
     **/
    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        self::$_instance->startSession();

        return self::$_instance;
    }

    /**
     * (Re)starts the session.
     *    
     * @return bool TRUE if the session has been initialized, else FALSE.
     **/
    public function startSession() : bool
    {
        if ($this->sessionState == self::SESSION_NOT_STARTED) {
            $this->sessionState = session_start();
        }

        return $this->sessionState;
    }

    /**
     * Stores datas in the session.
     *    
     * @param string $name  - Name of the datas.
     * @param mixed  $value - Your datas.
     * 
     * @return void
     **/
    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    /**
     * Gets datas from the session.
     * Example: echo $_instance->get(userID);
     *    
     * @param string $name - Name of the datas to get.
     * 
     * @return mixed - Datas stored in session.
     **/
    public function get($name)
    {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }
    }

    /**
     * Check if data exists in $_SESSION
     *
     * @param string $name - Data's name
     * 
     * @return boolean
     */
    public function __isset($name)
    {
        return isset($_SESSION[$name]);
    }

    /**
     * Unset given data name
     *
     * @param string $name - Data's name
     * 
     * @return void
     */
    public function __unset($name)
    {
        unset($_SESSION[$name]);
    }

    /**
     * Destroys the current session.
     *    
     * @return bool TRUE is session has been deleted, else FALSE.
     **/
    public function destroy()
    {
        if ($this->sessionState == self::SESSION_STARTED) {
            $this->sessionState = !session_destroy();
            unset($_SESSION);

            return !$this->sessionState;
        }

        return false;
    }
}