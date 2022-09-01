# Faq module in spryker
## Data model
table relations model - "faq diagram.png" <br>
#### pyz_faq_question ->
question & answer is default(fallback) text. It is displayed when there is no translation(or it wasn't fetched) <br>
    Also table contains fk_id_user which is creator of question. It actually doesn't do anything, since you can modify any question in backoffice and ownership will be overwritten <br>
#### pyz_faq_translation ->
Thanks to (fk_id_question, language) as PK, there is only 1 translation per question per language <br>
#### pyz_faq_votes ->
Same case as in translations, thanks to PK customer can have 1 vote per question <br>

## Business facade
General rules are: <br>
When it fetches relations(including fetch by id) it counts votes automatically in persistence layer(while mapping from entity to transfer),<br>
and translates questions in business layer. <br>
When relations are NOT provided question won't be translated, and votes count will be null. <br>
Every saveSth uses propel findOneOrCreate method. So from user perspective there is no difference between creating new and updating old one <br>
Where ever there is searching by active question we filter state by  FaqConfig::STATE_ACTIVE constant. <br>
All 4 important constants(votes and state) are in FaqConfig.
FaqFacadeInterface is;

    public function saveQuestion(FaqQuestionTransfer $transfer): FaqQuestionTransfer;

    public function findAllQuestions(FaqQuestionCollectionTransfer $questionCollectionTransfer
    ): FaqQuestionCollectionTransfer;

    public function findActiveQuestions(FaqQuestionCollectionTransfer $questionCollectionTransfer
    ): FaqQuestionCollectionTransfer;

    public function findAllQuestionsWithRelations(FaqQuestionCollectionTransfer $questionCollectionTransfer
    ): FaqQuestionCollectionTransfer;

    public function findActiveQuestionsWithRelations(FaqQuestionCollectionTransfer $questionCollectionTransfer
    ): FaqQuestionCollectionTransfer;

    public function saveTranslation(FaqTranslationTransfer $translationTransfer): FaqTranslationTransfer;

    public function saveVote(FaqVoteTransfer $votesTransfer): FaqVoteTransfer;

    public function findQuestionById(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer;

    public function deleteQuestion(FaqQuestionTransfer $questionTransfer): FaqQuestionTransfer;

    public function deleteVote(FaqVoteTransfer $voteTransfer): FaqVoteTransfer;

    public function deleteTranslation(FaqTranslationTransfer $translationTransfer): FaqTranslationTransfer;

    public function findAllVotes(FaqVoteCollectionTransfer $collectionTransfer): FaqVoteCollectionTransfer;

    public function findVoteByKey(FaqVoteTransfer $voteTransfer): FaqVoteTransfer;


## Communication Layer
### Forms
We switched to CollectionForm(FaqQuestionForm is legacy) so translations' field are generated based on available locales. <br>
QuestionTranslationDataProvider with FaqCommunicationMapper ensures correct data format is provided to form, and it mapped back to transfer . <br>
Gateway controller exposes most of the facade to clients <br>

## Rest api
There are 2 exposed endpoints /faq and /faq-votes for questions and votes. They expose 4 methods get,post patch and delete <br>
For more see README-restApi.md <br>

## Yves
It has its own client, which communicates with zed. From here customer can read questions and vote on them.
