<?php

namespace Pyz\Zed\Faq\Communication;

use Generated\Shared\Transfer\FaqQuestionTransfer;
use Pyz\Zed\Faq\Business\FaqFacadeInterface;
use Pyz\Zed\Faq\Communication\Form\QuestionCollectionForm;
use Pyz\Zed\Faq\Communication\Form\QuestionTranslationForm;
use Pyz\Zed\Faq\Communication\Form\QuestionValueTranslationForm;
use Pyz\Zed\Faq\FaqConfig;
use Spryker\Zed\Locale\Business\LocaleFacadeInterface;

class QuestionTranslationDataProvider
{

    protected FaqFacadeInterface $faqFacade;
    protected LocaleFacadeInterface $localeFacade;

    public function __construct(FaqFacadeInterface $faqFacade, LocaleFacadeInterface $localeFacade)
    {
        $this->faqFacade = $faqFacade;
        $this->localeFacade = $localeFacade;
    }

    public function getData($id)
    {
        $questionTransfer = new FaqQuestionTransfer();
        $questionTransfer->setIdQuestion($id);
        $questionTransfer = $this->faqFacade->findQuestionById($questionTransfer);
        return [
            QuestionCollectionForm::FIELD_TRANSLATIONS => $this->getTranslationFields($id, $questionTransfer),
            QuestionCollectionForm::FILED_STATE => $questionTransfer->getState() ?? FaqConfig::INACTIVE_STATE,
            QuestionCollectionForm::FIELD_DEFAULT_ANSWER => $questionTransfer->getAnswer(),
            QuestionCollectionForm::FIELD_DEFAULT_QUESTION => $questionTransfer->getQuestion(),

        ];
    }

    protected function getTranslationFields($id, FaqQuestionTransfer $questionTransfer)
    {
        $locales = $this->localeFacade->getLocaleCollection();

        $fields = [];
        $translations = [];
        foreach ($questionTransfer->getTranslations() as $translation) {
            $translations[$translation->getLanguage()] = $translation;
        }
        foreach ($locales as $localeName => $localeTransfer) {
            $fields[$localeName] = [

                QuestionTranslationForm::FIELD_ID_QUESTION => $id,
                QuestionTranslationForm::FIELD_VALUE_TRANSLATIONS => $this->generateKeyValueTranslations(
                    $translations,
                    $id,
                    $questionTransfer,
                    $localeName
                )
            ];
        }

        return $fields;
    }

    protected function generateKeyValueTranslations(array $translations, $id, $questionTransfer, string $localeName)
    {
        $results = [];
        $results[0] = [
            QuestionValueTranslationForm::FILED_ID_QUESTION => $id,
            QuestionValueTranslationForm::FIELD_VALUE => $questionTransfer->getQuestion(),
            QuestionValueTranslationForm::FIELD_TRANSLATION => $this->getQuestionTranslation($translations, $localeName)
        ];
        $results[1] = [
            QuestionValueTranslationForm::FILED_ID_QUESTION => $id,
            QuestionValueTranslationForm::FIELD_VALUE => $questionTransfer->getAnswer(),
            QuestionValueTranslationForm::FIELD_TRANSLATION => $this->getAnswerTranslation($translations, $localeName)
        ];
        return $results;
    }

    protected function getQuestionTranslation(array $translations, string $localeName)
    {
        try {
            return $translations[$localeName]->getTranslatedQuestion();
        } catch (\Exception $e) {
            return "";
        }
    }

    protected function getAnswerTranslation(array $translations, string $localeName)
    {
        try {
            return $translations[$localeName]->getTranslatedAnswer();
        } catch (\Exception $e) {
            return "";
        }
    }

}
