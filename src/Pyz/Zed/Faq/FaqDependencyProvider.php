<?php

namespace Pyz\Zed\Faq;

use Orm\Zed\Faq\Persistence\PyzFaqQuestionQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class FaqDependencyProvider extends AbstractBundleDependencyProvider
{
    public const QUERY_QUESTION = 'QUERY_QUESTION';

    public function provideCommunicationLayerDependencies(Container $container)
    {
        $container = $this->addPyzFaqQuestionQuery($container);

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
}
