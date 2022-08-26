<?php

namespace Pyz\Zed\Faq\Communication\Controller;

use Orm\Zed\Faq\Persistence\Base\PyzFaqQuestionQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Pyz\Zed\Faq\Communication\FaqCommunicationFactory;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @method FaqCommunicationFactory getFactory()
 */
class IndexController extends AbstractController
{
    public function indexAction(): array
    {
//        $locale = $this->getFactory()->getLocaleFacade();
//        $language = $locale->getCurrentLocaleName();
        $table = $this->getFactory()->createFaqTable();
        return $this->viewResponse([
            'questionTable' => $table->render()
        ]);
    }

    public function tableAction(): JsonResponse {
        $table = $this->getFactory()->createFaqTable();

        return $this->jsonResponse($table->fetchData());
    }
}
