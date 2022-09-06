<?php

namespace Pyz\Zed\FaqSearch\Business;

use Pyz\Zed\FaqSearch\Business\Writer\QuestionSearchWriter;

class FaqSearchBusinessFactory
{
    public function createQuestionSearchWriter(): QuestionSearchWriter
    {
        return new QuestionSearchWriter();
    }
}
