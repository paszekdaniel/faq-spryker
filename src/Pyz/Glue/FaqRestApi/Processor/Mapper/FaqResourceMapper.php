<?php

namespace Pyz\Glue\FaqRestApi\Processor\Mapper;

use Generated\Shared\Transfer\FaqQuestionTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;
use Generated\Shared\Transfer\RestFaqResponseAttributesTransfer;
use Generated\Shared\Transfer\RestFaqVotesResponseAttributesTransfer;
use Pyz\Zed\Faq\FaqConfig;

class FaqResourceMapper implements FaqResourceMapperInterface
{

    public function mapFaqDataToFaqRestAttributes(FaqQuestionTransfer $transfer): RestFaqResponseAttributesTransfer
    {
        $restFaqAttributesTransfer = (new RestFaqResponseAttributesTransfer())->fromArray($transfer->toArray(), true);
        return $restFaqAttributesTransfer;
    }

    public function mapFaqVotesDataToFaqVoteRestAttributes(FaqVoteTransfer $transfer
    ): RestFaqVotesResponseAttributesTransfer {
        return (new RestFaqVotesResponseAttributesTransfer())->fromArray($transfer->toArray(), true);
    }

    public function generateVoteRestId(FaqVoteTransfer $transfer): string
    {
        return  $transfer->getFkIdQuestion() . '!'. $transfer->getFkIdCustomer();
    }

    public function decodeVoteId(FaqVoteTransfer $transfer, string $id): ?FaqVoteTransfer
    {
        $values = explode('!', $id);
        if(count($values) !== 2) {
//            wrong id
            return null;
        }
        $transfer->setFkIdQuestion($values[0]);
        $transfer->setFkIdCustomer($values[1]);
        return $transfer;
    }
}
