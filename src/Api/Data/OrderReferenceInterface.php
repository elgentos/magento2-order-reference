<?php

/**
 * Copyright Elgentos BV. All rights reserved.
 * https://www.elgentos.nl/
 */

declare(strict_types=1);

namespace Elgentos\OrderReference\Api\Data;

interface OrderReferenceInterface
{
    public const TABLE = 'sales_order_reference';
    public const ENTITY_ID = 'entity_id';
    public const ORDER_ID = 'order_id';
    public const ORDER_REFERENCE = 'order_reference';
    public function getId(): mixed;

    public function getOrderId(): int;

    public function getOrderReference(): ?string;

    public function setId(mixed $value): self;

    public function setOrderId(int $id): self;

    public function setOrderReference(string $reference): self;
}
