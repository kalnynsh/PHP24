<?php

namespace app\models\repositories;

/**
 * RepositoriesStorage class for storage repositories
 */
class RepositoriesRegister
{
    protected $items = [];

    /**
     * Add new object in $items array
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
     * Method get - create new *Repository instance of given $key (e.g. Product)
     * like ProductRepository object or return existent from $items
     *
     * @param string $key - given one of Repository names: Category, Comment,...
     * 
     * @return object
     */
    public function get($key)
    {
        $class = $key . 'Repository';

        if (!isset($this->items[$key])) {
            $class = 'app\\models\\repositories\\' . $class;

            if (class_exists($class)) {
                $this->items[$key] = new $class();
            } else {
                \trigger_error(
                    'Couldn`t load class: ' . $class,
                    E_USER_WARNING
                );
            }

        }

        return $this->items[$key];
    }
}
