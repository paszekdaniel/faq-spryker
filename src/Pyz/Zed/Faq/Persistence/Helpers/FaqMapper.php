<?php

namespace Pyz\Zed\Faq\Persistence\Helpers;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;
use Generated\Shared\Transfer\FaqTranslationTransfer;
use Generated\Shared\Transfer\FaqVotesTransfer;

class FaqMapper
{
    /**
     * @param FaqQuestionCollectionTransfer $questionCollectionTransfer
     * @param mixed $questions this is collection of entities
     * @return FaqQuestionCollectionTransfer
     */
    public static function mapQuestionCollectionEntityToTransferCollection(
        FaqQuestionCollectionTransfer $questionCollectionTransfer, $questions, bool $mapRelations = false): FaqQuestionCollectionTransfer
    {
        foreach ($questions as $question) {
            $temp = (new FaqQuestionTransfer())->fromArray($question->toArray());
            if($mapRelations) {
                if(!$question->getPyzFaqTranslations()->isEmpty()) {
                    foreach ($question->getPyzFaqTranslations() as $translationEntity) {
                        $translation = (new FaqTranslationTransfer())->fromArray($translationEntity->toArray());
                        $temp->addTranslation($translation);
                    }
                }
                if (!$question->getPyzFaqVotess()->isEmpty()) {
                    foreach ($question->getPyzFaqVotess() as $voteEntity) {
                        $vote = (new FaqVotesTransfer())->fromArray($voteEntity->toArray());
                        $temp->addVote($vote);
                    }
                }
            }
            $questionCollectionTransfer->addQuestion($temp);
        }
        return $questionCollectionTransfer;
    }
}
