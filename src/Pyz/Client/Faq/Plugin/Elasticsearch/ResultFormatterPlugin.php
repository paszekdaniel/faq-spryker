<?php

namespace Pyz\Client\Faq\Plugin\Elasticsearch;
use Elastica\ResultSet;
use Spryker\Client\SearchElasticsearch\Plugin\ResultFormatter\AbstractElasticsearchResultFormatterPlugin;

class ResultFormatterPlugin extends AbstractElasticsearchResultFormatterPlugin
{
    public const NAME = 'faq_question';
    protected function formatSearchResult(ResultSet $searchResult, array $requestParameters)
    {
        foreach ($searchResult->getResults() as $result) {
            return $result->getSource();
        }
        return [];
    }

    public function getName()
    {
        return static::NAME;
    }
}
