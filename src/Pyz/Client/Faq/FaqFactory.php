<?php

namespace Pyz\Client\Faq;

use Pyz\Client\Faq\Plugin\Elasticsearch\Query\FaqQueryPlugin;
use Pyz\Client\Faq\Zed\FaqZedStub;
use Pyz\Client\Faq\Zed\FaqZedStubInterface;
use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\Search\SearchClientInterface;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;

class FaqFactory extends AbstractFactory
{
    public function createFaqZedStub(): FaqZedStubInterface {
        return new FaqZedStub($this->getZedRequestClient());
    }

    protected function getZedRequestClient(): ZedRequestClientInterface {
        return $this->getProvidedDependency(FaqDependencyProvider::CLIENT_ZED_REQUEST);
    }
    public function createFaqQueryPlugin(string $idQuestion): FaqQueryPlugin
    {
        return new FaqQueryPlugin($idQuestion);
    }
    public function getSearchQueryFormatters(): array {
        return $this->getProvidedDependency(FaqDependencyProvider::RESULT_FORMATTER_PLUGINS);
    }
    public function getSearchClient(): SearchClientInterface {
        return $this->getProvidedDependency(FaqDependencyProvider::CLIENT_ELASTIC_SEARCH);
    }

}
