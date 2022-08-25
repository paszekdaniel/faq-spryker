<?php

namespace Pyz\Zed\Faq\Business;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;
use Generated\Shared\Transfer\FaqTranslationTransfer;
use Generated\Shared\Transfer\FaqVotesTransfer;

interface FaqFacadeInterface
{
    public function saveQuestion(FaqQuestionTransfer $transfer): FaqQuestionTransfer;

    public function findAllQuestions(FaqQuestionCollectionTransfer $questionCollectionTransfer): FaqQuestionCollectionTransfer;

    public function findActiveQuestions(FaqQuestionCollectionTransfer $questionCollectionTransfer): FaqQuestionCollectionTransfer;

    public function saveTranslation(FaqTranslationTransfer $translationTransfer): FaqTranslationTransfer;

    public function saveVote(FaqVotesTransfer $votesTransfer): FaqVotesTransfer;
}
