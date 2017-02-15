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


use Descent\Contracts\FacadeInterface;
use Descent\Facades\Entities\HubEntityInterface;

abstract class AbstractFacade implements FacadeInterface
{
    /**
     * @var HubEntityInterface
     */
    private static $hub;

    /**
     * sets the hub entity.
     *
     * @param HubEntityInterface $hub
     * @return void
     */
    public static function withHub(HubEntityInterface $hub)
    {
        self::$hub = $hub;
    }

    /**
     * facade internal getter for the assigned hub.
     *
     * @return HubEntityInterface
     */
    protected static function facadeGetHub(): HubEntityInterface
    {
        return self::$hub;
    }

}