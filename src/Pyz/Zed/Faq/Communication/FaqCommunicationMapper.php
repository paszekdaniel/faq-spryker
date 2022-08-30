<?php

namespace Pyz\Zed\Faq\Communication;

use Generated\Shared\Transfer\FaqQuestionTransfer;
use Generated\Shared\Transfer\FaqTranslationTransfer;
use Pyz\Zed\Faq\Communication\Form\QuestionCollectionForm;
use Pyz\Zed\Faq\Communication\Form\QuestionTranslationForm;

class FaqCommunicationMapper
{
    public static function mapTranslationFormToQuestionTransfer(array $data): FaqQuestionTransfer {
        $questionTransfer = new FaqQuestionTransfer();
        $questionTransfer->setState($data[QuestionCollectionForm::FILED_STATE]);
        $questionTransfer->setAnswer($data[QuestionCollectionForm::FIELD_DEFAULT_ANSWER]);
        $questionTransfer->setQuestion($data[QuestionCollectionForm::FIELD_DEFAULT_QUESTION]);
        $questionTransfer->setIdQuestion($data[QuestionCollectionForm::FIELD_ID_QUESTION] ?? null);

        foreach ($data[QuestionCollectionForm::FIELD_TRANSLATIONS] as $name => $translation) {
            $translationTransfer = new FaqTranslationTransfer();
            $translationTransfer->setLanguage($name);
            foreach ($translation[QuestionTranslationForm::FIELD_VALUE_TRANSLATIONS] as $field => $item) {
                if($field === QuestionTranslationDataProvider::QUESTION) {
                    $translationTransfer->setTranslatedQuestion($item["translation"]);
                }
                if($field === QuestionTranslationDataProvider::ANSWER) {
                    $translationTransfer->setTranslatedAnswer($item["translation"]);
                }
            }
            $questionTransfer->addTranslation($translationTransfer);
        }
        return $questionTransfer;
    }
}
