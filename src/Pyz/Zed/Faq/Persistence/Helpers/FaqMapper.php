<?php

namespace Pyz\Zed\Faq\Persistence\Helpers;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;
use Generated\Shared\Transfer\FaqTranslationTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;
use Pyz\Zed\Faq\FaqConfig;

class FaqMapper
{
    /**
     * Counts votes if provided
     * I don't use entity->countVotes(), because it will query for each question, and I use populateRelation already
     * @param FaqQuestionCollectionTransfer $questionCollectionTransfer
     * @param mixed $questions this is collection of entities
     * @param bool $mapRelations
     * @return FaqQuestionCollectionTransfer
     */
    public static function mapQuestionCollectionEntityToTransferCollection(
        FaqQuestionCollectionTransfer $questionCollectionTransfer, $questions, bool $mapRelations = false): FaqQuestionCollectionTransfer
    {
        foreach ($questions as $question) {
            $transfer = new FaqQuestionTransfer();
            $transfer = self::mapQuestionEntityToTransfer($transfer, $question, $mapRelations);
            $questionCollectionTransfer->addQuestion($transfer);
        }
        return $questionCollectionTransfer;
    }

    public static function mapQuestionEntityToTransfer(FaqQuestionTransfer $questionTransfer, $question, bool $mapRelations = false): FaqQuestionTransfer {
        $questionTransfer->fromArray($question->toArray());
        if($mapRelations) {
            if(!$question->getPyzFaqTranslations()->isEmpty()) {
                foreach ($question->getPyzFaqTranslations() as $translationEntity) {
                    $translation = (new FaqTranslationTransfer())->fromArray($translationEntity->toArray());
                    $questionTransfer->addTranslation($translation);
                }
            }
            $questionTransfer->setVotesUp(0);
            $questionTransfer->setVotesDown(0);
            if (!$question->getPyzFaqVotes()->isEmpty()) {
                $votesUp = 0;
                $votesDown = 0;
                foreach ($question->getPyzFaqVotes() as $voteEntity) {
                    $vote = (new FaqVoteTransfer())->fromArray($voteEntity->toArray());
                    $questionTransfer->addVote($vote);
                    if($vote->getVote() === FaqConfig::VOTE_UP) {
                        $votesUp++;
                    } else {
                        $votesDown++;
                    }
                }
                $questionTransfer->setVotesUp($votesUp);
                $questionTransfer->setVotesDown($votesDown);
            }
        }
        return $questionTransfer;
    }
}
