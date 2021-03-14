<?php

/**
 * ComponentRegistry.php
 *
 * Copyright 2021 Danny Damsky
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @package coffeephp\component-registry
 * @author Danny Damsky <dannydamsky99@gmail.com>
 * @since 2021-03-14
 */

declare(strict_types=1);

namespace CoffeePhp\ComponentRegistry;

use CoffeePhp\ComponentRegistry\Contract\ComponentRegistrarInterface;
use CoffeePhp\ComponentRegistry\Contract\ComponentRegistryInterface;
use CoffeePhp\Di\Contract\ContainerInterface;

/**
 * Interface ComponentRegistry
 * @package coffeephp\component-registry
 * @author Danny Damsky <dannydamsky99@gmail.com>
 * @since 2021-03-14
 */
final class ComponentRegistry implements ComponentRegistryInterface
{
    private ContainerInterface $di;

    /**
     * ComponentRegistry constructor.
     * @param ContainerInterface $di
     */
    public function __construct(ContainerInterface $di)
    {
        $this->di = $di;
    }

    /**
     * @inheritDoc
     */
    public function register(string $id): void
    {
        $this->getRegistrar($id)->register();
    }

    /**
     * @param class-string<ComponentRegistrarInterface> $id
     * The identifier of the component registrar class.
     *
     * @return ComponentRegistrarInterface
     */
    private function getRegistrar(string $id): ComponentRegistrarInterface
    {
        $this->di->bind($id, $id);

        /** @var ComponentRegistrarInterface $registrar */
        $registrar = $this->di->get($id);
        return $registrar;
    }
}