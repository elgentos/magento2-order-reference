<?php

/**
 * Copyright Elgentos BV. All rights reserved.
 * https://www.elgentos.nl/
 */

declare(strict_types=1);

namespace Elgentos\OrderReference\Magewire;

use Magento\Checkout\Model\Session as SessionCheckout;
use Magewirephp\Magewire\Component\Form;
use Rakit\Validation\Validator;

class OrderReference extends Form
{
    public const string ORDER_REFERENCE_SESSION_KEY = 'order_reference';

    public ?string $order_reference = null;

    public function __construct(
        Validator $validator,
        protected readonly SessionCheckout $sessionCheckout
    ) {
        parent::__construct($validator);
    }

    public function boot(): void
    {
        $this->order_reference = $this->getSessionValue();
    }

    public function updatingOrderReference(mixed $value): mixed
    {
        $this->setSessionValue($value);
        return $value;
    }

    public function getSessionValue(): mixed
    {
        return $this->sessionCheckout->getData(self::ORDER_REFERENCE_SESSION_KEY);
    }

    public function setSessionValue(mixed $value): void
    {
        $this->sessionCheckout->setData(self::ORDER_REFERENCE_SESSION_KEY, $value);
    }
}
