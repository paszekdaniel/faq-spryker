<?php

namespace Pyz\Glue\FaqRestApi\Processor\Mapper;

use Generated\Shared\Transfer\FaqQuestionTransfer;
use Generated\Shared\Transfer\RestFaqResponseAttributesTransfer;
use Pyz\Zed\Faq\FaqConfig;

class FaqResourceMapper implements FaqResourceMapperInterface
{

    public function mapFaqDataToFaqRestAttributes(FaqQuestionTransfer $transfer): RestFaqResponseAttributesTransfer
    {
        $restFaqAttributesTransfer = (new RestFaqResponseAttributesTransfer())->fromArray($transfer->toArray(), true);
        return $restFaqAttributesTransfer;
    }
}
