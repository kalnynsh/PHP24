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
    private $_instance;

    /**
     * Empty contructor
     */
    public function __construct()
    {
        $this->_sessionState = session_start();
    }

    /**
     * Gets data from the session.
     * Example: echo $_instance->get(userId);
     *    
     * @param string $name - Name of the data to get.
     * 
     * @return mixed - Data stored in session.
     **/
    public function get($name)
    {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        } else {
            return null;
        }
    }

    /**
     * Stores data in the session.
     *    
     * @param string $name  - Name of the data.
     * @param mixed  $value - Your data.
     * 
     * @return void
     **/
    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
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
        if ($this->_sessionState == self::SESSION_STARTED) {
            $this->_sessionState = !session_destroy();
            unset($_SESSION);

            return !$this->_sessionState;
        }

        return false;
    }
}