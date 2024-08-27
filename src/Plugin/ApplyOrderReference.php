<?php

/**
 * Copyright Elgentos BV. All rights reserved.
 * https://www.elgentos.nl/
 */

declare(strict_types=1);

namespace Elgentos\OrderReference\Plugin;

use Elgentos\OrderReference\Api\OrderReferenceRepositoryInterface;
use Elgentos\OrderReference\Helpers\OrderData;
use Elgentos\OrderReference\Model\OrderReference;
use Elgentos\OrderReference\Model\OrderReferenceFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\Data\OrderSearchResultInterface;
use Magento\Sales\Model\OrderRepository;

readonly class ApplyOrderReference
{
    public function __construct(
        private OrderData $orderData,
        private OrderReferenceRepositoryInterface $orderReferenceRepository,
        private OrderReferenceFactory $orderReferenceFactory
    ) {
    }

    /**
     *
     * @return OrderInterface
     */
    public function afterGet(
        OrderRepository $subject,
        OrderInterface $result,
        int $id
    ): OrderInterface {
        $this->orderData->setAdditionalOrderInformation($result);
        return $result;
    }

    /**
     *
     * @return OrderSearchResultInterface
     */
    public function afterGetList(
        OrderRepository $subject,
        OrderSearchResultInterface $result,
        SearchCriteriaInterface $searchCriteria
    ): OrderSearchResultInterface {
        foreach ($result->getItems() as $item) {
            $this->orderData->setAdditionalOrderInformation($item);
        }

        return $result;
    }

    /**
     *
     * @return OrderInterface
     */
    public function afterSave(
        OrderRepository $subject,
        OrderInterface $result,
        OrderInterface $entity
    ): OrderInterface {
        $extensionAttributes = $entity->getExtensionAttributes();

        if (
            !isset($extensionAttributes) ||
            (
                empty($extensionAttributes->getOrderReference())
            )
        ) {
            return $result;
        }

        $orderReference = $this->orderReferenceRepository->get(
            (int) $result->getEntityId()
        );

        if (!isset($orderReference)) {
            /** @var OrderReference $orderReference */
            $orderReference = $this->orderReferenceFactory->create();
            $orderReference->setOrderId((int) $result->getEntityId());
        }

        $reference = $extensionAttributes->getOrderReference();


        if (!empty($reference)) {
            $orderReference->setOrderReference($reference);
        }


        $this->orderReferenceRepository->save($orderReference);

        return $result;
    }
}
