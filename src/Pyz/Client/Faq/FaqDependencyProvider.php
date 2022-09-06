<?php

namespace Pyz\Client\Faq;

use Pyz\Client\Faq\Plugin\Elasticsearch\ResultFormatterPlugin;
use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class FaqDependencyProvider extends AbstractDependencyProvider
{
    public const CLIENT_ZED_REQUEST = 'client_zed_request';
//    public const CLIENT_FAQ_REST_API = 'client-faq-rest-api';
    public const CLIENT_ELASTIC_SEARCH = 'CLIENT_ELASTIC_SEARCH';
    public const RESULT_FORMATTER_PLUGINS = 'PLANET_RESULT_FORMATTER_PLUGINS';

    public function provideServiceLayerDependencies(Container $container)
    {
        $container = $this->addZedRequestClient($container);
        $container = $this->addSearchClient($container);
        $container = $this->addSearchFormatterPlugin($container);
        return $container;
    }

    protected function addZedRequestClient(Container $container): Container {
        $container->set(static::CLIENT_ZED_REQUEST, function (Container $container) {
            return $container->getLocator()->zedRequest()->client();
        });
        return $container;
    }
    protected function addSearchClient(Container $container): Container {
        $container->set(static::CLIENT_ELASTIC_SEARCH, function (Container $container) {
            return $container->getLocator()->search()->client();
        });
        return $container;
    }
    protected function addSearchFormatterPlugin(Container $container): Container {
        $container->set(static::RESULT_FORMATTER_PLUGINS, function () {
            return [new ResultFormatterPlugin()];
        });
        return $container;
    }
}
