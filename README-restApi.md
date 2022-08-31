# /faq/{$id}
## GETs all
### response:
#### {
####    "data": [
####    {
####        "type": "faq",
####        "id": string (iq_question),
####        "attributes": {
####            "question": "string",
####            "answer": "string",
####            "state": int (FaqConfig::VOTE_UP/DOWN),
####            "votesUp": int,
####            "votesDown": int
####    },
####        "links": {
####            "self": "url"
####    }]
#### },
## GET one
### response:
#### {
####    "data": {
####        "type": "faq",
####        "id": string (iq_question),
####        "attributes": {
####            "question": "string",
####            "answer": "string",
####            "state": int (FaqConfig::VOTE_UP/DOWN),
####            "votesUp": int,
####            "votesDown": int
####    },
####        "links": {
####            "self": "url"
####    }
#### },
## POST
### important - it will create question with fk_id_user = null since it is created by customer, not user.
### Request:
#### {
####    "data": {
####        "type": "faq",
####        "attributes": {
####            "question": "string",
####            "answer": "string",
####            "state": int (FaqConfig::VOTE_UP/DOWN),
####    },
####        "links": {
####            "self": "url"
####    }
#### },
## PATCH
### important - it will override question fk_id_user = null since it is created by customer, not user.
### trying update no existing question will result in 500
### Request:
#### {
####    "data": {
####        "type": "faq",
####        "attributes": {
####            "question": "string",
####            "answer": "string",
####            "state": int (FaqConfig::VOTE_UP/DOWN),
####    },
####        "links": {
####            "self": "url"
####    }
#### },
## DELETE
### request -> null
### response -> null
# /faq-votes/{$id}
## Since vote primary key is a pair, then $id is "fk_id_question!fk_id_customer" eg 2!3.
## GET all
### response:
#### {
####    "data": [
####    {
####        "type": "faq-votes",
####        "id": string (fk_iq_question!fk_id_customer),
####        "attributes": {
####            "fkIdQuestion": int,
####            "fkIdCustomer": int,
####            "vote": int (FaqConfig::VOTE_UP/DOWN),
####    },
####        "links": {
####            "self": "url"
####    }]
#### },
## GET one
### response:
#### {
####    "data": {
####        "type": "faq-votes",
####        "id": string (fk_iq_question!fk_id_customer),
####        "attributes": {
####            "fkIdQuestion": int,
####            "fkIdCustomer": int,
####            "vote": int (FaqConfig::VOTE_UP/DOWN),
####    },
####        "links": {
####            "self": "url"
####    }
#### },
## POST
### Request: (fkIdCustomer is from session)
#### {
####    "data": {
####        "type": "faq-votes",
####        "attributes": {
####            "fkIdQuestion": int,
####            "vote": int (FaqConfig::VOTE_UP/DOWN),
####    },
####        "links": {
####            "self": "url"
####    }
#### },
## PATCH
### Request: (primary key is from id)
#### {
####    "data": {
####        "type": "faq-votes",
####        "attributes": {
####            "vote": int (FaqConfig::VOTE_UP/DOWN),
####    },
####        "links": {
####            "self": "url"
####    }
#### },
### response -> 400 (details: Not your vote)
### response -> 500 (details: Something went wrong)
## DELETE
### request -> null
### response -> null
### response -> 400 (details: Not your vote)
### response -> 500 (details: Something went wrong)
