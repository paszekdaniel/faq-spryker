<?php

namespace Pyz\Glue\FaqRestApi\Processor\Faqs;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface FaqChangerInterface
{
    public function createFaqQuestion(RestRequestInterface $restRequest): RestResponseInterface;
    public function updateFaqQuestion(RestRequestInterface $restRequest): RestResponseInterface;
    public function deleteFaqQuestion(RestRequestInterface $restRequest): RestResponseInterface;
}
