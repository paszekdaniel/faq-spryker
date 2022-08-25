<?php

namespace Pyz\Zed\Faq\Persistence;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;

interface FaqRepositoryInterface
{
    public function findAllQuestionsWithRelations(FaqQuestionCollectionTransfer $questionCollectionTransfer): FaqQuestionCollectionTransfer;

    public function findAllQuestions(FaqQuestionCollectionTransfer $questionCollectionTransfer): FaqQuestionCollectionTransfer;

    public function findActiveQuestionsWithRelations(FaqQuestionCollectionTransfer $questionCollectionTransfer): FaqQuestionCollectionTransfer;

    public function findActiveQuestions(FaqQuestionCollectionTransfer $questionCollectionTransfer): FaqQuestionCollectionTransfer;

}
