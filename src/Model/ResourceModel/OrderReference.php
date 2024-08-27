<?php

/**
 * Copyright Elgentos BV. All rights reserved.
 * https://www.elgentos.nl/
 */

declare(strict_types=1);

namespace Elgentos\OrderReference\Model\ResourceModel;

use Elgentos\OrderReference\Api\Data\OrderReferenceInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class OrderReference extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'order_reference_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init(
            OrderReferenceInterface::TABLE,
            OrderReferenceInterface::ENTITY_ID
        );
        $this->_useIsObjectNew = true;
    }
}
