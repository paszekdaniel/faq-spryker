<?php

namespace Pyz\Zed\Faq\Persistence;

use Orm\Zed\Faq\Persistence\PyzFaqQuestionQuery;
use Orm\Zed\Faq\Persistence\PyzFaqTranslationQuery;
use Orm\Zed\Faq\Persistence\PyzFaqVoteQuery;
use Pyz\Zed\Faq\Persistence\Helpers\FaqSaver;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class FaqPersistenceFactory extends AbstractPersistenceFactory
{
    public function createFaqQuestionQuery(): PyzFaqQuestionQuery
    {
        return PyzFaqQuestionQuery::create();
    }
    public function createFaqTranslationQuery(): PyzFaqTranslationQuery
    {
        return PyzFaqTranslationQuery::create();
    }
    public function createFaqVotesQuery(): PyzFaqVoteQuery
    {
        return PyzFaqVoteQuery::create();
    }
    public function createFaqSaver(): FaqSaver {
        return new FaqSaver();
    }
}
