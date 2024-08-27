<?php

/**
 * Copyright Elgentos BV. All rights reserved.
 * https://www.elgentos.nl/
 */

declare(strict_types=1);

namespace Elgentos\OrderReference\Model;

use Elgentos\OrderReference\Api\Data\OrderReferenceInterface;
use Elgentos\OrderReference\Api\OrderReferenceRepositoryInterface;
use Elgentos\OrderReference\Model\ResourceModel\OrderReference as ResourceModel;
use Magento\Framework\Exception\AlreadyExistsException;

readonly class OrderReferenceRepository implements OrderReferenceRepositoryInterface
{
    public function __construct(
        private ResourceModel $resouceModel,
        private OrderReferenceFactory $orderReferenceFactory
    ) {
    }

    public function get(int $orderId): ?OrderReferenceInterface
    {
        $orderReference = $this->orderReferenceFactory->create();
        $this->resouceModel->load($orderReference, $orderId, OrderReferenceInterface::ORDER_ID);

        return ($orderReference->getId() !== null) ? $orderReference : null;
    }

    /**
     * @throws AlreadyExistsException
     */
    public function save(OrderReferenceInterface $orderReference): OrderReferenceInterface
    {
        $this->resouceModel->save($orderReference);
        return $orderReference;
    }
}
