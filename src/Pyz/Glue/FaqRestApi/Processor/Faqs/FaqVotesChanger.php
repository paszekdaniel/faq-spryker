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
    private function mapRequestAndCustomerToTransfer(RestRequestInterface $restRequest): FaqVoteTransfer
    {
        $transfer = new FaqVoteTransfer();
        $data = $restRequest->getResource()->toArray()['attributes'];
        $transfer->fromArray($data);
        $customer = $this->customerClient->getCustomer();
        $transfer->setFkIdCustomer($customer->getIdCustomer());
        return $transfer;
    }
    private function authorizationGuard(FaqVoteTransfer $transfer): bool {
        $customer = $this->customerClient->getCustomer();
        return $customer->getIdCustomer() == $transfer->getFkIdCustomer();
    }

    private function addTransferToResponse(FaqVoteTransfer $transfer,  RestResponseInterface $restResponse): RestResponseInterface
    {
        $restResource = $this->restResourceBuilder->createRestResource(
            FaqRestApiConfig::RESOURCE_FAQ,
            $this->faqResourceMapper->generateVoteRestId($transfer),
            $this->faqResourceMapper->mapFaqVotesDataToFaqVoteRestAttributes($transfer)
        );
        $restResponse->addResource($restResource);
        return $restResponse;
    }

    public function createFaqVote(RestRequestInterface $restRequest): RestResponseInterface {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        $voteTransfer = $this->mapRequestAndCustomerToTransfer($restRequest);

        $voteTransfer = $this->faqClient->createFaqVote($voteTransfer);

        if(!$voteTransfer->getVote()) {
            $errorTransfer = new RestErrorMessageTransfer();
            $errorTransfer->setCode(500);
            $errorTransfer->setDetail("Failed to create question. Why?");
            $restResponse->addError($errorTransfer);
            return $restResponse;
        }
        $this->addTransferToResponse($voteTransfer, $restResponse);

        return $restResponse;
    }

    public function updateFaqVote(RestRequestInterface $restRequest): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        $idRequest = $restRequest->getResource()->getId();

        $voteTransfer = $this->mapRequestAndCustomerToTransfer($restRequest);
        $voteTransfer = $this->faqResourceMapper->decodeVoteId($voteTransfer, $idRequest);
        if(!$voteTransfer) {
            $errorTransfer = new RestErrorMessageTransfer();
            $errorTransfer->setCode(400);
            $errorTransfer->setDetail("Wrong id!");
            $restResponse->addError($errorTransfer);
            return $restResponse;
        }
        if(!$this->authorizationGuard($voteTransfer)) {
            $errorTransfer = new RestErrorMessageTransfer();
            $errorTransfer->setCode(403);
            $errorTransfer->setDetail("Not your vote");
            $restResponse->addError($errorTransfer);
            return $restResponse;
        }

        $voteTransfer = $this->faqClient->updateFaqVote($voteTransfer);

        if(!$voteTransfer->getVote()) {
            $errorTransfer = new RestErrorMessageTransfer();
            $errorTransfer->setCode(500);
            $errorTransfer->setDetail("Failed to create question. Why?");
            $restResponse->addError($errorTransfer);
            return $restResponse;
        }
        $this->addTransferToResponse($voteTransfer, $restResponse);

        return $restResponse;
    }

    public function deleteFaqVote(RestRequestInterface $restRequest): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        $idRequest = $restRequest->getResource()->getId();

        $voteTransfer = $this->mapRequestAndCustomerToTransfer($restRequest);
        $voteTransfer = $this->faqResourceMapper->decodeVoteId($voteTransfer, $idRequest);
        if(!$voteTransfer) {
            $errorTransfer = new RestErrorMessageTransfer();
            $errorTransfer->setCode(400);
            $errorTransfer->setDetail("Wrong id!");
            $restResponse->addError($errorTransfer);
            return $restResponse;
        }
        if(!$this->authorizationGuard($voteTransfer)) {
            $errorTransfer = new RestErrorMessageTransfer();
            $errorTransfer->setCode(403);
            $errorTransfer->setDetail("Not your vote");
            $restResponse->addError($errorTransfer);
            return $restResponse;
        }
        $voteTransfer = $this->faqClient->deleteFaqVote($voteTransfer);
//      No info about error in persistence
        $this->addTransferToResponse($voteTransfer, $restResponse);

        return $restResponse;
    }
}
