<?php

namespace Pyz\Zed\FaqSearch\Business;

use Pyz\Zed\Faq\Business\FaqFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method FaqSearchBusinessFactory getFactory()
 */
class FaqSearchFacade extends AbstractFacade implements FaqSearchFacadeInterface
{

    public function publish(int $idQuestion): void
    {
        $this->getFactory()->createQuestionSearchWriter()->publish($idQuestion);
    }
}
