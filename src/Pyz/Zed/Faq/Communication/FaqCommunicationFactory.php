<?php

namespace Pyz\Zed\Faq\Communication;

use Orm\Zed\Faq\Persistence\PyzFaqQuestionQuery;
use Pyz\Zed\Faq\Communication\Table\FaqTable;
use Pyz\Zed\Faq\FaqDependencyProvider;
use Pyz\Zed\Faq\Persistence\FaqEntityManagerInterface;
use Pyz\Zed\Faq\Persistence\FaqRepositoryInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @method FaqEntityManagerInterface getEntityManager()
 * @method FaqRepositoryInterface getRepository()
 */
class FaqCommunicationFactory extends AbstractCommunicationFactory
{
    public function createFaqTable(): FaqTable {
        return new FaqTable(
            $this->getEntityManager(),
            $this->getRepository(),
            $this->getQuestionQuery()
        );
    }

    private function getQuestionQuery(): PyzFaqQuestionQuery {
        return $this->getProvidedDependency(FaqDependencyProvider::QUERY_QUESTION);
    }
}
