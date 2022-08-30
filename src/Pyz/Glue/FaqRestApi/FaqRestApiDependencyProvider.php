<?php

namespace Pyz\Glue\FaqRestApi;

use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

class FaqRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const CUSTOMER_CLIENT = 'customer-client';
    public function provideDependencies(Container $container)
    {
        $this->addCustomerClient($container);
        return $container;
    }
    protected function addCustomerClient(Container $container) {
        $container->set(static::CUSTOMER_CLIENT, function (Container $container) {
            return $container->getLocator()->customer()->client();
        });
        return $container;
    }
}
