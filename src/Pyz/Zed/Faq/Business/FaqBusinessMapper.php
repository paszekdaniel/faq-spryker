<?php

namespace Pyz\Zed\Faq\Business;

use Generated\Shared\Transfer\FaqQuestionTransfer;

class FaqBusinessMapper
{
    public static function translateQuestion(FaqQuestionTransfer $questionTransfer, string $language): FaqQuestionTransfer {
        foreach ($questionTransfer->getTranslations() as $translation) {
            if($translation->getLanguage() === $language) {
                $questionTransfer->setQuestion($translation->getTranslatedQuestion());
                $questionTransfer->setAnswer($translation->getTranslatedAnswer());
            }
        }
        return $questionTransfer;
    }
}
