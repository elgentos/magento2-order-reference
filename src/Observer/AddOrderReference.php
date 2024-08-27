<?php

/**
 * Copyright Elgentos BV. All rights reserved.
 * https://www.elgentos.nl/
 */

declare(strict_types=1);

namespace Elgentos\OrderReference\Observer;

use Elgentos\OrderReference\Magewire\OrderReference;
use Magento\Checkout\Model\Session as SessionCheckout;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Api\Data\OrderInterface;

class AddOrderReference implements ObserverInterface
{
    public function __construct(
        private readonly SessionCheckout $sessionCheckout,
    ) {
    }

    public function execute(Observer $observer)
    {
        /** @var OrderInterface $order */
        $order     = $observer->getEvent()->getOrder();
        $reference = $this->sessionCheckout->getData(
            OrderReference::ORDER_REFERENCE_SESSION_KEY
        );

        $order->getExtensionAttributes()->setOrderReference($reference);

        $this->sessionCheckout->setData(
            OrderReference::ORDER_REFERENCE_SESSION_KEY,
            null
        );
    }
}
