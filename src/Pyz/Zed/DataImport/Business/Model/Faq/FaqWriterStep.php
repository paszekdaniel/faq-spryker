<?php

namespace Pyz\Zed\DataImport\Business\Model\Faq;

use Orm\Zed\Faq\Persistence\PyzFaqQuestionQuery;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class FaqWriterStep extends PublishAwareStep implements DataImportStepInterface
{
    public const KEY_QUESTION = 'question';
    public const KEY_ANSWER = 'answer';
    public const KEY_STATE = 'state';
    public const KEY_FK_ID_USER = 'fk_id_user';

    public function execute(DataSetInterface $dataSet)
    {
        $questionEntity = PyzFaqQuestionQuery::create()
            ->filterByQuestion($dataSet[static::KEY_QUESTION])
            ->filterByAnswer($dataSet[static::KEY_ANSWER])
            ->findOneOrCreate();
        $questionEntity->setState($dataSet[static::KEY_STATE]);
        $questionEntity->setFkIdUser($dataSet[static::KEY_FK_ID_USER]);

        if($questionEntity->isNew() || $questionEntity->isModified()) {
            $questionEntity->save();
        }
    }
}
