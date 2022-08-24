<?php

namespace Pyz\Zed\Faq\Business;

use Pyz\Zed\Faq\Persistence\FaqEntityManagerInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
// * @method FaqRepositoryInterface getRepository()
 * @method FaqEntityManagerInterface getEntityManager()
 */
class FaqBusinessFactory extends AbstractBusinessFactory
{
    public function getFaqWriterHandler(): FaqWriterHandler {
        return new FaqWriterHandler($this->getEntityManager());
    }
}
