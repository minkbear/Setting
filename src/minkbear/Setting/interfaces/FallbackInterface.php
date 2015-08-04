<?php namespace minkbear\Setting\interfaces;

/**
 * Class FallbackInterface
 * @package minkbear\Setting\interfaces
 */
interface FallbackInterface {

    /**
     * @param $key
     * @return mixed
     */
    public function fallbackGet($key, $default = null);

    /**
     * @param $key
     * @return boolean
     */
    public function fallbackHas($key);

}