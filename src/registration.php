<?php

/**
 * Copyright Elgentos. All rights reserved.
 * https://elgentos.nl/
 */

declare(strict_types=1);

use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
    ComponentRegistrar::MODULE,
    'Elgentos_OrderReference',
    __DIR__
);
