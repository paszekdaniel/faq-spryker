<?php

namespace Pyz\Zed\Faq\Dependency;

interface FaqEvents
{
    public const ENTITY_PYZ_FAQ_QUESTION_CREATE = 'Entity.pyz_faq_question.create';
    public const ENTITY_PYZ_FAQ_QUESTION_UPDATE = 'Entity.pyz_faq_question.update';
    public const ENTITY_PYZ_FAQ_QUESTION_DELETE = 'Entity.pyz_faq_question.delete';
}
