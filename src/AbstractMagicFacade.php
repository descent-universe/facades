<?php
/**
 * This file is part of the Descent Framework.
 *
 * (c)2017 Matthias Kaschubowski
 *
 * This code is licensed under the MIT license,
 * a copy of the license is stored at the project root.
 */

namespace Descent\Facades;


use Descent\Facades\Entities\HubEntityInterface;
use Descent\Facades\Exceptions\FacadeException;

/**
 * Class AbstractMagicFacade
 * @package Descent\Facades
 */
abstract class AbstractMagicFacade extends AbstractFacade
{
    private static $methods = [];

    /**
     * sets the hub entity.
     *
     * @param HubEntityInterface $hub
     * @return void
     */
    public static function withHub(HubEntityInterface $hub)
    {
        foreach ( array_keys(static::getContainmentInterfaces()) as $alias ) {
            $methods = array_fill_keys($hub->getMethodsOf($alias), $alias);
            $intersection = array_intersect_key(self::$methods, $methods);

            if ( ! empty($intersection) ) {
                throw new FacadeException(
                    'Incompatible to magic Facades: Interfaces for this facade will raise method conflicts'
                );
            }

            self::$methods = array_merge(self::$methods, $methods);
        }

        parent::withHub($hub);
    }

    /**
     * is triggered when invoking inaccessible methods in a static context.
     *
     * @param $name string
     * @param $arguments array
     * @return mixed
     * @link http://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.methods
     */
    public static function __callStatic($name, $arguments)
    {
        $key = strtolower($name);

        if ( ! array_key_exists($key, self::$methods) ) {
            throw new FacadeException(
                'Unknown method: '.$name
            );
        }

        return call_user_func_array(
            [
                self::facadeGetHub()->getInstance(self::$methods[$name]),
                $name
            ],
            $arguments
        );
    }
}