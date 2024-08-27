<?php

/**
 * Copyright Elgentos BV. All rights reserved.
 * https://www.elgentos.nl/
 */

declare(strict_types=1);

namespace Elgentos\OrderReference\Helpers;

use Elgentos\OrderReference\Api\OrderReferenceRepositoryInterface;
use Magento\Sales\Api\Data\OrderExtensionFactory;
use Magento\Sales\Api\Data\OrderInterface;

readonly class OrderData
{
    public function __construct(
        private OrderExtensionFactory $orderExtensionFactory,
        private OrderReferenceRepositoryInterface $orderReferenceRepository
    ) {
    }

    public function setAdditionalOrderInformation(OrderInterface $order): void
    {
        $extensionAttributes = $order->getExtensionAttributes();

        if ($extensionAttributes === null) {
            $extensionAttributes = $this->orderExtensionFactory->create();
        }

        $info = $this->orderReferenceRepository->get((int) $order->getEntityId());

        if (!isset($info)) {
            return;
        }

        $extensionAttributes->setOrderReference($info->getOrderReference());

        $order->setExtensionAttributes($extensionAttributes);
    }
}
