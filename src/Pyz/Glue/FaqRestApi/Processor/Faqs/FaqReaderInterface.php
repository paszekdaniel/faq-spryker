<?php

namespace Pyz\Glue\FaqRestApi\Processor\Faqs;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface FaqReaderInterface
{
    public function getFaqQuestions(RestRequestInterface $restRequest): RestResponseInterface;
    public function getOneFaqQuestion(RestRequestInterface $restRequest): RestResponseInterface;
}
