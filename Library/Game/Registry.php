<?php
namespace Game;
class Registry
{
    static protected $arr = array();

    static public function get($key)
    {
        return self::$arr[$key];
    }

    static public function set($key, $value)
    {
        self::$arr[$key] = $value;
    }

    static public function save()
    {
        $_SESSION['savedGame'] = serialize(self::$arr);
    }

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