<?php
namespace Game;
class Registry
{
    /**
     * The actual lookup table
     *
     * @var array
     */
    static protected $arr = array();

    /**
     * the getter
     *
     * @param string $key
     * @return mixed
     */
    static public function get($key)
    {
        return self::$arr[$key];
    }

    /**
     * the setter
     *
     * @param string $key the key for retrieval
     * @param mixed $value
     * @return void
     */
    static public function set($key, $value)
    {
        self::$arr[$key] = $value;
    }

    /**
     * Saves the registry in the session
     *
     * @return void
     */
    static public function save()
    {
        $_SESSION['savedGame'] = serialize(self::$arr);
    }

    /**
     * Loads the registry from the session
     *
     * @return boolean true on successful load
     */
    static public function load()
    {
        if (! array_key_exists('savedGame', $_SESSION)) {
            return false;
        } else {
            self::$arr = unserialize($_SESSION['savedGame']);
            return true;
        }
    }
}