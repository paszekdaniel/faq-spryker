<?php

namespace Pyz\Client\Faq;

use Generated\Shared\Transfer\FaqQuestionCollectionTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method FaqFactory getFactory()
 */
class FaqClient extends AbstractClient implements FaqClientInterface
{

    public function getActiveFaqQuestionCollection(FaqQuestionCollectionTransfer $questionCollectionTransfer
    ): FaqQuestionCollectionTransfer {
        return $this->getFactory()->createFaqZedStub()->getActiveQuestionCollection($questionCollectionTransfer);
    }

    public function postVote(FaqVoteTransfer $voteTransfer): FaqVoteTransfer
    {
        return $this->getFactory()->createFaqZedStub()->postVote($voteTransfer);
    }

    public function getFaqQuestionFromSearchById(string $idQuestion): array
    {
        $searchQuery = $this->getFactory()->createFaqQueryPlugin($idQuestion);
        $resultFormatters = $this->getFactory()->getSearchQueryFormatters();

        $searchResults = $this->getFactory()->getSearchClient()
            ->search(
                $searchQuery,
                $resultFormatters
            );
//        dd($searchResults);
        return $searchResults['faq_question'] ?? [];
    }
}
