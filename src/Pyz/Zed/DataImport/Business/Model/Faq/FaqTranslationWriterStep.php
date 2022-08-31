<?php

namespace Pyz\Zed\DataImport\Business\Model\Faq;

use Orm\Zed\Faq\Persistence\PyzFaqTranslationQuery;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class FaqTranslationWriterStep extends PublishAwareStep implements DataImportStepInterface
{
    public const KEY_FK_ID_QUESTION = 'fk_id_question';
    public const KEY_LANGUAGE = 'language';
    public const KEY_TRANSLATED_QUESTION = 'translated_question';
    public const KEY_TRANSLATED_ANSWER = 'translated_answer';

    public function execute(DataSetInterface $dataSet)
    {
        $translationEntity = PyzFaqTranslationQuery::create()
            ->filterByFkIdQuestion($dataSet[static::KEY_FK_ID_QUESTION])
            ->filterByLanguage($dataSet[static::KEY_LANGUAGE])
            ->findOneOrCreate();

        $translationEntity->setTranslatedQuestion($dataSet[static::KEY_TRANSLATED_QUESTION]);
        $translationEntity->setTranslatedAnswer($dataSet[static::KEY_TRANSLATED_ANSWER]);

        if($translationEntity->isNew() || $translationEntity->isModified()) {
            $translationEntity->save();
        }
    }
}
