<?php

namespace Pyz\Zed\Faq\Persistence;

use Orm\Zed\Faq\Persistence\PyzFaqQuestion;
use Orm\Zed\Faq\Persistence\PyzFaqQuestionQuery;
use Orm\Zed\Faq\Persistence\PyzFaqTranslation;
use Orm\Zed\Faq\Persistence\PyzFaqTranslationQuery;
use Orm\Zed\Faq\Persistence\PyzFaqVotesQuery;
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
    public function createFaqVotesQuery(): PyzFaqVotesQuery
    {
        return PyzFaqVotesQuery::create();
    }
    public function createFaqSaver(): FaqSaver {
        return new FaqSaver();
    }
}
