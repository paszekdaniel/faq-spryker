<?php

namespace Pyz\Zed\Faq\Persistence\Helpers;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;

class FaqMapper
{
    public static function mapQuestionCollectionEntityToTransferCollection(
        FaqQuestionCollectionTransfer $questionCollectionTransfer, $questions): FaqQuestionCollectionTransfer
    {
        foreach ($questions as $question) {
            $temp = (new FaqQuestionTransfer())->fromArray($question->toArray());
            $questionCollectionTransfer->addQuestion($temp);
        }
        return $questionCollectionTransfer;
    }
}
