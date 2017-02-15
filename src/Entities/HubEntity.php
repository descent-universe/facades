<?php
/**
 * This file is part of the Descent Framework.
 *
 * (c)2017 Matthias Kaschubowski
 *
 * This code is licensed under the MIT license,
 * a copy of the license is stored at the project root.
 */

namespace Descent\Facades\Entities;


use Descent\Contracts\ServiceContainerInterface;
use Descent\Facades\Exceptions\FacadeException;

final class HubEntity implements HubEntityInterface
{
    private $services;
    private $associatedAliases = [];
    private $associatedMethods = [];

    /**
     * HubEntityInterface constructor.
     *
     * @param ServiceContainerInterface $services
     * @param array $associatedAliases
     */
    public function __construct(ServiceContainerInterface $services, array $associatedAliases)
    {
        $this->services = $services;
        $this->associatedAliases = $associatedAliases;
    }

    /**
     * gets the instance of an aliased interface.
     *
     * @param string $alias
     * @return object
     */
    public function getInstance(string $alias)
    {
        if ( ! array_key_exists($alias, $this->associatedAliases) ) {
            throw new FacadeException(
                'Unknown alias: '.$alias
            );
        }

        return $this->services->make($this->associatedAliases[$alias]);
    }

    /**
     * gets the lower-cased method names of an aliased interface
     *
     * @param string $alias
     * @return array
     */
    public function getMethodsOf(string $alias): array
    {
        if ( ! array_key_exists($alias, $this->associatedMethods) ) {
            $methods = (new \ReflectionClass($this->associatedAliases[$alias]))->getMethods(\ReflectionMethod::IS_PUBLIC);
            $this->associatedMethods[$alias] = array_map('strtolower', $methods);
        }

        return $this->associatedMethods[$alias];
    }

}