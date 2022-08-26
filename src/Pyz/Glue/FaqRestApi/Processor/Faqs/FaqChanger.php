<?php

namespace Pyz\Glue\FaqRestApi\Processor\Faqs;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Pyz\Client\FaqRestApi\FaqRestApiClientInterface;
use Pyz\Glue\FaqRestApi\FaqRestApiConfig;
use Pyz\Glue\FaqRestApi\Processor\Mapper\FaqResourceMapperInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class FaqChanger implements FaqChangerInterface
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
    private function addTransferToResponse(FaqQuestionTransfer $questionTransfer, RestResponseInterface $restResponse)
    {
        $restResource = $this->restResourceBuilder->createRestResource(
            FaqRestApiConfig::RESOURCE_FAQ,
            $questionTransfer->getIdQuestion(),
            $this->faqResourceMapper->mapFaqDataToFaqRestAttributes($questionTransfer)
        );
        $restResponse->addResource($restResource);
    }
    private function requestToTransfer(RestRequestInterface $restRequest): FaqQuestionTransfer
    {
        $planetTransfer = new FaqQuestionTransfer();
        $data = $restRequest->getResource()->toArray()['attributes'];
        $planetTransfer->fromArray($data);
        return $planetTransfer;
    }
    public function createFaqQuestion(RestRequestInterface $restRequest): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        $questionTransfer = $this->requestToTransfer($restRequest);

        $questionTransfer = $this->faqClient->createFaqQuestion($questionTransfer);

        if(!$questionTransfer->getIdQuestion()) {
            $errorTransfer = new RestErrorMessageTransfer();
            $errorTransfer->setCode(500);
            $errorTransfer->setDetail("Failed to create question. Why?");
            $restResponse->addError($errorTransfer);
            return $restResponse;
        }
        $this->addTransferToResponse($questionTransfer, $restResponse);
        return $restResponse;
    }
    public function updateFaqQuestion(RestRequestInterface $restRequest): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        $questionTransfer = $this->requestToTransfer($restRequest);
        $questionTransfer->setIdQuestion($restRequest->getResource()->getId());

        $questionTransfer = $this->faqClient->updateFaqQuestion($questionTransfer);

        if(!$questionTransfer->getIdQuestion()) {
            $errorTransfer = new RestErrorMessageTransfer();
            $errorTransfer->setCode(500);
            $errorTransfer->setDetail("Failed to update question. Why?");
            $restResponse->addError($errorTransfer);
            return $restResponse;
        }
        $this->addTransferToResponse($questionTransfer, $restResponse);
        return $restResponse;
    }
    public function deleteFaqQuestion(RestRequestInterface $restRequest): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        $questionTransfer = $this->requestToTransfer($restRequest);
        $questionTransfer->setIdQuestion($restRequest->getResource()->getId());

//        I don't pass information about error unfortunately
        $planetTransfer = $this->faqClient->deleteFaqQuestion($questionTransfer);

        $this->addTransferToResponse($planetTransfer, $restResponse);

        return $restResponse;
    }
}
