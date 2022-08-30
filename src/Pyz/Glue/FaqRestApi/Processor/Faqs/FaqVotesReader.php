<?php

namespace Pyz\Glue\FaqRestApi\Processor\Faqs;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;
use Generated\Shared\Transfer\FaqVoteCollectionTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;
use Pyz\Client\FaqRestApi\FaqRestApiClientInterface;
use Pyz\Glue\FaqRestApi\FaqRestApiConfig;
use Pyz\Glue\FaqRestApi\Processor\Mapper\FaqResourceMapperInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class FaqVotesReader implements FaqVotesReaderInterface
{
    private FaqRestApiClientInterface $faqClient;
    private RestResourceBuilderInterface $restResourceBuilder;
    private FaqResourceMapperInterface $faqResourceMapper;

    public function __construct(
        FaqRestApiClientInterface $faqClient,
        RestResourceBuilderInterface $restResourceBuilder,
        FaqResourceMapperInterface $faqResourceMapper
    ) {
        $this->faqClient = $faqClient;
        $this->restResourceBuilder = $restResourceBuilder;
        $this->faqResourceMapper = $faqResourceMapper;
    }
    private function addTransferToResponse(FaqVoteTransfer $transfer,  RestResponseInterface $restResponse): RestResponseInterface
    {
        $restResource = $this->restResourceBuilder->createRestResource(
            FaqRestApiConfig::VOTES_FAQ,
            $this->faqResourceMapper->generateVoteRestId($transfer),
            $this->faqResourceMapper->mapFaqVotesDataToFaqVoteRestAttributes($transfer)
        );
        $restResponse->addResource($restResource);
        return $restResponse;
    }

    public function getAllVotes(RestRequestInterface $restRequest): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();
        $voteCollectionTransfer = $this->faqClient->getAllVotes(new FaqVoteCollectionTransfer());

        foreach ($voteCollectionTransfer->getVotes() as $vote) {
            $this->addTransferToResponse($vote, $restResponse);
        }
        return $restResponse;
    }

    public function getOneVote(RestRequestInterface $restRequest): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();
        $id = $restRequest->getResource()->getId();
        $voteTransfer = new FaqVoteTransfer();
        $voteTransfer = $this->faqResourceMapper->decodeVoteId($voteTransfer, $id);
        $voteTransfer = $this->faqClient->getVoteByKey($voteTransfer);
        $this->addTransferToResponse($voteTransfer, $restResponse);
        return $restResponse;
    }
}
