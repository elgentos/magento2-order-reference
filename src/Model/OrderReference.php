<?php

/**
 * Copyright Elgentos BV. All rights reserved.
 * https://www.elgentos.nl/
 */

declare(strict_types=1);

namespace Elgentos\OrderReference\Model;

use Elgentos\OrderReference\Model\ResourceModel\OrderReference as ResourceModel;
use Elgentos\OrderReference\Api\Data\OrderReferenceInterface;
use Magento\Framework\Model\AbstractModel;

class OrderReference extends AbstractModel implements OrderReferenceInterface
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'order_reference_model';

    /**
     * Initialize magento model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    public function getId(): mixed
    {
        return $this->getData(self::ENTITY_ID);
    }

    public function getOrderId(): int
    {
        return $this->getData(self::ORDER_ID);
    }

    public function getOrderReference(): ?string
    {
        return $this->getData(self::ORDER_REFERENCE);
    }

    public function setId(mixed $value): self
    {
        return $this->setData(self::ENTITY_ID, $value);
    }

    public function setOrderId(int $id): self
    {
        return $this->setData(self::ORDER_ID, $id);
    }

    public function setOrderReference(string $reference): self {
        return $this->setData(self::ORDER_REFERENCE, $reference);
    }
}
