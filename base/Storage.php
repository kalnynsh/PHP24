<?php

namespace app\base;

/**
 * Storage class for storage components
 */
class Storage
{
    protected $items = [];

    /**
     * Set new object by key
     *
     * @param string $key    - key
     * @param object $object - given object
     * 
     * @return void
     */
    public function set($key, $object)
    {
        $this->items[$key] = $object;
    }

    /**
     * Method get - create new component instance of given $key
     * or return existant
     *
     * @param string $key - given component key
     * 
     * @return object
     */
    public function get($key)
    {
        if (!isset($this->items[$key])) {
            $this->items[$key] = App::call()->createComponent($key);
        }

        return $this->items[$key];
    }
}
