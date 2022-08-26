<?php

namespace Pyz\Glue\FaqRestApi\Processor\Mapper;

use Generated\Shared\Transfer\FaqQuestionTransfer;
use Generated\Shared\Transfer\RestFaqResponseAttributesTransfer;

interface FaqResourceMapperInterface
{
    public function mapFaqDataToFaqRestAttributes(FaqQuestionTransfer $faqData): RestFaqResponseAttributesTransfer;
}
