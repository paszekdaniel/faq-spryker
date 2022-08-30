<?php

namespace Pyz\Glue\FaqRestApi\Processor\Mapper;

use Generated\Shared\Transfer\FaqQuestionTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;
use Generated\Shared\Transfer\RestFaqResponseAttributesTransfer;
use Generated\Shared\Transfer\RestFaqVotesResponseAttributesTransfer;

interface FaqResourceMapperInterface
{
    public function mapFaqDataToFaqRestAttributes(FaqQuestionTransfer $faqData): RestFaqResponseAttributesTransfer;
    public function mapFaqVotesDataToFaqVoteRestAttributes(FaqVoteTransfer $transfer): RestFaqVotesResponseAttributesTransfer;
}
