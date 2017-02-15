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

interface HubEntityInterface
{
    /**
     * HubEntityInterface constructor.
     *
     * @param ServiceContainerInterface $services
     * @param array $associatedAliases
     */
    public function __construct(ServiceContainerInterface $services, array $associatedAliases);

    /**
     * gets the instance of an aliased interface.
     *
     * @param string $alias
     * @return object
     */
    public function getInstance(string $alias);

    /**
     * gets the lower-cased method names of an aliased interface
     *
     * @param string $alias
     * @return array
     */
    public function getMethodsOf(string $alias): array;
}