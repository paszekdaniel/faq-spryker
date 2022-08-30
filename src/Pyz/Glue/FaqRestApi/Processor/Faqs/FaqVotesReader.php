<?php

namespace Pyz\Glue\FaqRestApi\Processor\Faqs;

use Pyz\Client\FaqRestApi\FaqRestApiClientInterface;
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
    public function getAllVotes(RestRequestInterface $restRequest): RestResponseInterface
    {
        // TODO: Implement getAllVotes() method.
    }

    public function getOneVote(RestRequestInterface $restRequest): RestResponseInterface
    {
        // TODO: Implement getOneVote() method.
    }
}
