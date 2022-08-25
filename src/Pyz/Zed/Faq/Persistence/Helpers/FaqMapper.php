<?php

namespace Pyz\Zed\Faq\Persistence\Helpers;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;
use Generated\Shared\Transfer\FaqTranslationTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;

class FaqMapper
{
    /**
     * @param FaqQuestionCollectionTransfer $questionCollectionTransfer
     * @param mixed $questions this is collection of entities
     * @param bool $mapRelations
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
                if (!$question->getPyzFaqVotes()->isEmpty()) {
                    foreach ($question->getPyzFaqVotes() as $voteEntity) {
                        $vote = (new FaqVoteTransfer())->fromArray($voteEntity->toArray());
                        $temp->addVote($vote);
                    }
                }
            }
            $questionCollectionTransfer->addQuestion($temp);
        }
        return $questionCollectionTransfer;
    }
}
