<?php

namespace Pyz\Client\FaqRestApi;

use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class FaqRestApiDependencyProvider extends AbstractDependencyProvider
{
    public const CLIENT_ZED_REQUEST = 'client_zed_request';

    public function provideServiceLayerDependencies(Container $container)
    {
        $container = $this->addZedRequestClient($container);
        return $container;
    }

    protected function addZedRequestClient(Container $container): Container {
        $container->set(static::CLIENT_ZED_REQUEST, function (Container $container) {
            return $container->getLocator()->zedRequest()->client();
        });
        return $container;
    }
}
