<?php

namespace Pyz\Zed\Faq;

use Orm\Zed\Faq\Persistence\PyzFaqQuestionQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class FaqDependencyProvider extends AbstractBundleDependencyProvider
{
    public const QUERY_QUESTION = 'QUERY_QUESTION';
    public const LOCALE_FACADE = 'LOCALE_FACADE';
    public const USER_FACADE = 'USER_FACADE';

    public function provideCommunicationLayerDependencies(Container $container)
    {
        $container = $this->addPyzFaqQuestionQuery($container);
//        TODO: business??
        $container = $this->addLocaleFacade($container);
        $container = $this->addUserFacade($container);

        return $container;
    }

    private function addPyzFaqQuestionQuery(Container $container): Container
    {
        $container->set(
            static::QUERY_QUESTION,
            $container->factory(
                fn() => PyzFaqQuestionQuery::create()
            )
        );
        return $container;
    }
    private function addLocaleFacade(Container $container): Container {
        $container->set(
            static::LOCALE_FACADE,
            function (Container $container) {
                return $container->getLocator()->locale()->facade();
            }
        );
        return $container;
    }
    private function addUserFacade(Container $container): Container {
        $container->set(
            static::USER_FACADE,
            function (Container $container) {
                return $container->getLocator()->user()->facade();
            }
        );
        return $container;
    }
}
