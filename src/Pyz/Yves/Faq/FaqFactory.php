<?php

namespace Pyz\Yves\Faq;

use Spryker\Client\Customer\CustomerClientInterface;
use Spryker\Yves\Kernel\AbstractFactory;

class FaqFactory extends AbstractFactory
{
    public function getCustomerClient(): CustomerClientInterface {
        return $this->getProvidedDependency(FaqDependencyProvider::CUSTOMER_CLIENT);
    }
}
