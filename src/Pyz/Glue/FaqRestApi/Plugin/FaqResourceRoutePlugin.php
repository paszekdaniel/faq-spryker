<?php

namespace Pyz\Glue\FaqRestApi\Plugin;

use Generated\Shared\Transfer\RestFaqResponseAttributesTransfer;
use Pyz\Glue\FaqRestApi\FaqRestApiConfig;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\Kernel\AbstractPlugin;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;

class FaqResourceRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
{

    public function configure(ResourceRouteCollectionInterface $resourceRouteCollection
    ): ResourceRouteCollectionInterface {
        $resourceRouteCollection->addGet('get', false)
            ->addPost('post', false)
            ->addPatch('patch', false)
            ->addDelete('delete', false);
        return $resourceRouteCollection;
    }

    public function getResourceType(): string
    {
        return FaqRestApiConfig::RESOURCE_FAQ;
    }

    public function getController(): string
    {
        return 'faq-resource';
    }

    public function getResourceAttributesClassName(): string
    {
        return RestFaqResponseAttributesTransfer::class;
    }
}
