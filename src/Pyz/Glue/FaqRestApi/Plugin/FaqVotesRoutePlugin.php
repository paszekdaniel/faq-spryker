<?php

namespace Pyz\Glue\FaqRestApi\Plugin;

use Generated\Shared\Transfer\RestFaqResponseAttributesTransfer;
use Generated\Shared\Transfer\RestFaqVotesResponseAttributesTransfer;
use Pyz\Glue\FaqRestApi\FaqRestApiConfig;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class FaqVotesRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
{

    public function configure(ResourceRouteCollectionInterface $resourceRouteCollection
    ): ResourceRouteCollectionInterface {
        $resourceRouteCollection
            ->addGet('get', false)
            ->addPost('post')
            ->addPatch('patch')
            ->addDelete('delete');

        return $resourceRouteCollection;
    }

    public function getResourceType(): string
    {
        return FaqRestApiConfig::VOTES_FAQ;
    }

    public function getController(): string
    {
        return 'faq-votes-resource';
    }

    public function getResourceAttributesClassName(): string
    {
        return RestFaqVotesResponseAttributesTransfer::class;
    }
}
