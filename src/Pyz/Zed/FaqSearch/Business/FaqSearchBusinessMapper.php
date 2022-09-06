<?php

namespace Pyz\Zed\FaqSearch\Business;

use Generated\Shared\Transfer\FaqQuestionTransfer;
use Orm\Zed\Faq\Persistence\PyzFaqQuestion;
use Pyz\Zed\Faq\FaqConfig;

class FaqSearchBusinessMapper
{
    public static function mapFaqEntityToSearchEntityData(PyzFaqQuestion $questionEntity) {
        $data = $questionEntity->toArray();
        $data["defaultQuestion"] = $questionEntity->getQuestion();
        $data["defaultAnswer"] = $questionEntity->getAnswer();
        $votes = $questionEntity->getPyzFaqVotes();
        $votesUp = 0;
        $votesDown = 0;
        foreach ($votes as $vote) {
            if($vote->getVote() === FaqConfig::VOTE_UP) {
                $votesUp++;
            } else {
                $votesDown++;
            }
        }
        $data["votesUp"] = $votesUp;
        $data["votesDown"] = $votesDown;
        $data["translations"] = $questionEntity->getPyzFaqTranslations();
        return $data;
    }
}
