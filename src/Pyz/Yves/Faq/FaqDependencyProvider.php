<?php

namespace Pyz\Yves\Faq;

use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;

class FaqDependencyProvider extends AbstractBundleDependencyProvider
{
    public const CUSTOMER_CLIENT = 'CUSTOMER_CLIENT';

    public function provideDependencies(Container $container)
    {
        $container = $this->addCustomerClient($container);
        return $container;
    }
    protected function addCustomerClient(Container $container): Container {
        $container->set(static::CUSTOMER_CLIENT, function (Container $container) {
            return $container->getLocator()->customer()->client();
        });
        return $container;
    }
}
