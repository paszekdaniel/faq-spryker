<?php

namespace Pyz\Shared\FaqSearch;

class FaqSearchConstants
{
    /**
     * Specification:
     * - Queue name as used for processing question messages
     * @api
     *
     * @var string
     */
    public const PLANET_SYNC_SEARCH_QUEUE = 'sync.search.faq_question';
}
