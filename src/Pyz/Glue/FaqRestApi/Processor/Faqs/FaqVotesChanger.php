<?php

namespace Pyz\Glue\FaqRestApi\Processor\Faqs;

use Generated\Shared\Transfer\FaqQuestionTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Pyz\Client\FaqRestApi\FaqRestApiClientInterface;
use Pyz\Glue\FaqRestApi\FaqRestApiConfig;
use Pyz\Glue\FaqRestApi\Processor\Mapper\FaqResourceMapperInterface;
use Spryker\Client\Customer\CustomerClientInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class FaqVotesChanger implements FaqVotesChangerInterface
{
    private FaqRestApiClientInterface $faqClient;
    private RestResourceBuilderInterface $restResourceBuilder;
    private FaqResourceMapperInterface $faqResourceMapper;
    private CustomerClientInterface $customerClient;

    public function __construct(
        FaqRestApiClientInterface $faqClient,
        RestResourceBuilderInterface $restResourceBuilder,
        FaqResourceMapperInterface $faqResourceMapper,
        CustomerClientInterface $customerClient
    ) {
        $this->faqClient = $faqClient;
        $this->restResourceBuilder = $restResourceBuilder;
        $this->faqResourceMapper = $faqResourceMapper;
        $this->customerClient = $customerClient;
    }
    private function requestAndCustomerToTransfer(RestRequestInterface $restRequest): FaqVoteTransfer
    {
        $transfer = new FaqVoteTransfer();
        $data = $restRequest->getResource()->toArray()['attributes'];
        $transfer->fromArray($data);
        $customer = $this->customerClient->getCustomer();
        $transfer->setFkIdCustomer($customer->getIdCustomer());
        return $transfer;
    }
    private function generateIdBasedOnPrimaryKey(FaqVoteTransfer $transfer): string
    {
        return  $transfer->getFkIdQuestion() . '|'. $transfer->getFkIdCustomer();
    }

    public function createFaqVote(RestRequestInterface $restRequest): RestResponseInterface {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        $voteTransfer = $this->requestAndCustomerToTransfer($restRequest);

        $voteTransfer = $this->faqClient->createFaqVote($voteTransfer);

        if(!$voteTransfer->getVote()) {
            $errorTransfer = new RestErrorMessageTransfer();
            $errorTransfer->setCode(500);
            $errorTransfer->setDetail("Failed to create question. Why?");
            $restResponse->addError($errorTransfer);
            return $restResponse;
        }
        $restResource = $this->restResourceBuilder->createRestResource(
            FaqRestApiConfig::RESOURCE_FAQ,
            $this->generateIdBasedOnPrimaryKey($voteTransfer),
            $this->faqResourceMapper->mapFaqVotesDataToFaqVoteRestAttributes($voteTransfer)
        );
        $restResponse->addResource($restResource);
        return $restResponse;
    }

    public function updateFaqVote(RestRequestInterface $restRequest): RestResponseInterface
    {
        // TODO: Implement updateFaqVote() method.
    }

    public function deleteFaqVote(RestRequestInterface $restRequest): RestResponseInterface
    {
        // TODO: Implement deleteFaqVote() method.
    }
}
