# Faq module
tables relations: faq diagram.png <br>

# Documentation: README-docs.md

## TODO:
[x] US6 - data importer <br>
[x] There are only 3 tests for easy persistence operations :) <br>
[ ] Pagination for yves <br>
[ ] Navigation in yves? <br>

## CHALLENGES:
- Translation is fully working: <br>
* Automatic translation in yves, glue and backoffice table <br>
* Fully functioning form (CollectionType form) where it generates form based on available locales <br>
- Votes: <br>
* Customer can vote on 1 question once, can change vote by voting again on the opposite vote <br>
* No revoking mechanism
* Votes are counted when fetching, so yves, glue and backoffice table all display voting count
## PROBLEMS:
- Glue API is FaqRestApi, instead of FaqsRestApi(S!), so data.type is faq, not faqs! <br>
- changing in FaqRestApiConfig probably would work(but then it won't match file structure), so I leave it as it is <br>
- Probably can throw unhandled error when id is overwritten, also ALL functions in entityManager (repo too?) throw sth <br>
     but there isn't try catch in business. Test that if you will have time <br>
- Delete response isn't based on succeeding or failing <br>
- Table can't sort by votes count
