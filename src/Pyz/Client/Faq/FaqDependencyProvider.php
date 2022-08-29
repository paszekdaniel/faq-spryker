<?php

namespace Pyz\Client\Faq;

use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class FaqDependencyProvider extends AbstractDependencyProvider
{
    public const CLIENT_ZED_REQUEST = 'client_zed_request';
//    public const CLIENT_FAQ_REST_API = 'client-faq-rest-api';

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
//    protected function addFaqRestApiClient(Container $container): Container {
//        $container->set(static::CLIENT_FAQ_REST_API, function (Container $container) {
//            return $container->getLocator()->
//        });
//    }
}
