<?php

namespace app\models\repositories;

/**
 * RepositoriesStorage class for storage repositories
 */
class RepositoriesStorage
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
        $key .= 'Repository';
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
        $key .= 'Repository';

        if (!isset($this->items[$key])) {
            $this->items[$key] = new $key();
        }

        return $this->items[$key];
    }
}
