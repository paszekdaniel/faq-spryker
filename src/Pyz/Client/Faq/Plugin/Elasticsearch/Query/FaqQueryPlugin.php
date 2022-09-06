<?php

namespace Pyz\Client\Faq\Plugin\Elasticsearch\Query;

use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\Exists;
use Elastica\Query\Match;
use Generated\Shared\Transfer\SearchContextTransfer;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\SearchContextAwareQueryInterface;

class FaqQueryPlugin implements QueryInterface, SearchContextAwareQueryInterface
{
    protected string $idQuestion;
    protected const SOURCE_IDENTIFIER = 'page';
    protected ?SearchContextTransfer $searchContextTransfer = null;

    public function __construct(string $idQuestion)
    {
        $this->idQuestion = $idQuestion;
    }

    public function getSearchQuery()
    {
        $boolQuery = (new BoolQuery())
            ->addMust(
                new Match('id_question', $this->idQuestion)
            );
        $query = (new Query())
            ->setQuery($boolQuery);
        return $query;
    }

    public function getSearchContext(): SearchContextTransfer
    {
        if (!$this->hasSearchContext()) {
            $this->setupDefaultSearchContext();
        }
        return $this->searchContextTransfer;
    }

    public function setSearchContext(SearchContextTransfer $searchContextTransfer): void
    {
        $this->searchContextTransfer = $searchContextTransfer;
    }

    protected function setupDefaultSearchContext(): void
    {
        $searchContextTransfer = new SearchContextTransfer();
        $searchContextTransfer->setSourceIdentifier(static::SOURCE_IDENTIFIER);
        $this->searchContextTransfer = $searchContextTransfer;
    }

    protected function hasSearchContext(): bool
    {
        return (bool)$this->searchContextTransfer;
    }
}
