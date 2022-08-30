<?php

namespace Pyz\Glue\FaqRestApi\Processor\Faqs;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface FaqVotesReaderInterface
{
    public function getAllVotes(RestRequestInterface $restRequest): RestResponseInterface;
    public function getOneVote(RestRequestInterface $restRequest): RestResponseInterface;
}
