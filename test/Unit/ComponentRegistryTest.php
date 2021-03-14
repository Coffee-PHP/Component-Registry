<?php

/**
 * ComponentRegistryTest.php
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

namespace CoffeePhp\ComponentRegistry\Unit;

use CoffeePhp\ComponentRegistry\ComponentRegistry;
use CoffeePhp\ComponentRegistry\Mock\MockComponentRegistrar;
use CoffeePhp\Di\Container;
use CoffeePhp\QualityTools\TestCase;

use stdClass;

use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

/**
 * Interface ComponentRegistryTest
 * @package coffeephp\component-registry
 * @author Danny Damsky <dannydamsky99@gmail.com>
 * @since 2021-03-14
 * @see ComponentRegistry
 */
final class ComponentRegistryTest extends TestCase
{
    private Container $di;
    private ComponentRegistry $registry;

    /**
     * @before
     */
    public function setupDependencies(): void
    {
        $this->di = new Container();
        $this->registry = new ComponentRegistry($this->di);
    }

    /**
     * @see ComponentRegistry::register()
     */
    public function testRegister(): void
    {
        assertFalse($this->di->has(stdClass::class));
        $this->registry->register(MockComponentRegistrar::class);
        assertTrue($this->di->has(stdClass::class));
    }
}
