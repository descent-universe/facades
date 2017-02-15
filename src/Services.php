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


use Descent\Contracts\ServiceContainerInterface;
use Descent\Contracts\Provider\ServiceProviderInterface;
use Descent\Services\Entities\ServiceInterface;

/**
 * Services Facade
 * @package Descent\Facades
 *
 * @method static ServiceInterface get(string $interface)
 * @method static bool has(string ... $interface)
 * @method static ServiceInterface bind(string $interface, $concrete = null)
 * @method static ServiceInterface factory(string $interface, callable $callback)
 * @method static object make(string $interface, array $parameters = [], string ... $enforcedOptionalParameters)
 * @method static mixed call(callable $callback, array $parameters = [], string ... $enforcedOptionalParameters)
 * @method static ServiceContainerInterface split(string ... $interfaces)
 * @method static ServiceContainerInterface expel(string ... $interfaces)
 * @method static ServiceContainerInterface register(ServiceProviderInterface ... $providers)
 */
class Services extends AbstractMagicFacade
{
    /**
     * returns an associative string indexed array. The key defines the alias for a class to interface for further
     * reference and the value must be the interface name of the interface that will be controlled by the facade.
     *
     * @return string[]
     */
    public static function getContainmentInterfaces(): array
    {
        return [
            'services' => ServiceContainerInterface::class
        ];
    }

}