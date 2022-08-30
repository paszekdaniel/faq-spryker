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
        $id = $data[QuestionCollectionForm::FIELD_ID_QUESTION];
        if($id === 0 || $id === "0") {
            $id = null;
        }
        $questionTransfer->setIdQuestion($id);

        foreach ($data[QuestionCollectionForm::FIELD_TRANSLATIONS] as $name => $translation) {
            $translationTransfer = new FaqTranslationTransfer();
            $ok = true;
            $translationTransfer->setLanguage($name);
            foreach ($translation[QuestionTranslationForm::FIELD_VALUE_TRANSLATIONS] as $field => $item) {
                if($item["translation"] === null) {
                    $ok = false;
                    break;
                }
                if($field === QuestionTranslationDataProvider::QUESTION) {
                    $translationTransfer->setTranslatedQuestion($item["translation"]);
                }
                if($field === QuestionTranslationDataProvider::ANSWER) {
                    $translationTransfer->setTranslatedAnswer($item["translation"]);
                }
            }
            if($ok) {
                $questionTransfer->addTranslation($translationTransfer);
            }
        }
        return $questionTransfer;
    }
}
