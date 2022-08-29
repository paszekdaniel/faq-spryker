<?php

namespace Pyz\Glue\FaqRestApi\Processor\Faqs;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqQuestionTransfer;
use Pyz\Client\FaqRestApi\FaqRestApiClientInterface;
use Pyz\Glue\FaqRestApi\FaqRestApiConfig;
use Pyz\Glue\FaqRestApi\Processor\Mapper\FaqResourceMapperInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class FaqReader implements FaqReaderInterface
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

    public function getActiveFaqQuestions(RestRequestInterface $restRequest): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();
        $faqCollectionTransfer = $this->faqClient->getFaqQuestionCollection(new FaqQuestionCollectionTransfer());

        foreach ($faqCollectionTransfer->getQuestions() as $question) {
            $this->addTransferToResponse($question, $restResponse);
        }
        return $restResponse;
    }


    public function getOneFaqQuestion(RestRequestInterface $restRequest): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();
        $id = $restRequest->getResource()->getId();
        $faqTransfer = new FaqQuestionTransfer();
        $faqTransfer->setIdQuestion($id);
        $faqTransfer = $this->faqClient->getOneFaqQuestion($faqTransfer);
        $this->addTransferToResponse($faqTransfer, $restResponse);
        return $restResponse;
    }
}
