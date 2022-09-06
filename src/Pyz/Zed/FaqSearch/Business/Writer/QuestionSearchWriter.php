<?php

namespace Pyz\Zed\FaqSearch\Business\Writer;

use Generated\Shared\Transfer\FaqQuestionTransfer;
use Orm\Zed\Faq\Persistence\PyzFaqQuestionQuery;
use Orm\Zed\FaqSearch\Persistence\PyzFaqQuestionSearchQuery;

class QuestionSearchWriter
{
    public function publish(int $idQuestion): void {
        $questionEntity = PyzFaqQuestionQuery::create()
            ->filterByIdQuestion($idQuestion)
            ->findOne();

        $questionTransfer = new FaqQuestionTransfer();
        $questionTransfer->fromArray($questionEntity->toArray());

        $searchEntity = PyzFaqQuestionSearchQuery::create()
            ->filterByFkFaqQuestion($idQuestion)
            ->findOneOrCreate();
        $searchEntity->setFkFaqQuestion($idQuestion);
        $searchEntity->setData($questionTransfer->toArray());

        $searchEntity->save();
    }
}
