<?php

namespace Pyz\Glue\FaqRestApi\Processor\Faqs;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface FaqVotesChangerInterface
{
    public function createFaqVote(RestRequestInterface $restRequest): RestResponseInterface;
    public function updateFaqVote(RestRequestInterface $restRequest): RestResponseInterface;
    public function deleteFaqVote(RestRequestInterface $restRequest): RestResponseInterface;
}
