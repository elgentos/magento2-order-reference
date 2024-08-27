<?php

/**
 * Copyright Elgentos BV. All rights reserved.
 * https://www.elgentos.nl/
 */

declare(strict_types=1);

namespace Elgentos\OrderReference\Api;

use Elgentos\OrderReference\Api\Data\OrderReferenceInterface;

interface OrderReferenceRepositoryInterface
{
    public function get(int $orderId): ?OrderReferenceInterface;

    public function save(OrderReferenceInterface $orderReference): OrderReferenceInterface;
}
