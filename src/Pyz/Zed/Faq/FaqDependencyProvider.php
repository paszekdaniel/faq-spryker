<?php

namespace Pyz\Zed\Faq;

use Orm\Zed\Faq\Persistence\PyzFaqQuestionQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class FaqDependencyProvider extends AbstractBundleDependencyProvider
{
    public const QUERY_QUESTION = 'QUERY_QUESTION';
    public const LOCALE_FACADE_COMMUNICATION = 'LOCALE_FACADE_COMMUNICATION';
    public const LOCALE_FACADE_BUSINESS = 'LOCALE_FACADE_BUSINESS';
    public const USER_FACADE = 'USER_FACADE';
    public const CUSTOMER_FACADE = 'CUSTOMER_FACADE';

    public function provideCommunicationLayerDependencies(Container $container)
    {
        $container = $this->addPyzFaqQuestionQuery($container);
        $container = $this->addLocaleFacadeCommunication($container);
        $container = $this->addUserFacade($container);
        $container = $this->addCustomerFacade($container);

        return $container;
    }
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = $this->addLocaleFacadeBusiness($container);
//        $container = $this->addUserFacade($container);
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
    private function addLocaleFacadeCommunication(Container $container): Container {
        $container->set(
            static::LOCALE_FACADE_COMMUNICATION,
            function (Container $container) {
                return $container->getLocator()->locale()->facade();
            }
        );
        return $container;
    }
    private function addLocaleFacadeBusiness(Container $container): Container {
        $container->set(
            static::LOCALE_FACADE_BUSINESS,
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
    private function addCustomerFacade(Container $container): Container {
        $container->set(
            static::CUSTOMER_FACADE,
            function (Container $container) {
                return $container->getLocator()->customer()->facade();
            }
        );
    }
}
