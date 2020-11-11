# Party Management Routes/Endpoints

## [SELECT ACTIVE PARTIES]
### URI [GET] : http://localhost/party-management/parties
* This URI requests the "party-management" document and “parties” collection. This request must not include any data.
#### Example Input: N/A
#### Output: Successful
    * Header: 200: Ok
    * Body (app/json): 200: Returns all active parties
#### Output: Unsuccessful
    * Header: 404: Page Not Found
    * Body (text/html): 404: Error, no active parties found
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (text/html): 501: Error, service not recognized

## [INSERT PLAYER & PARTY]
### URI [POST] : http://localhost/party-management/parties
* This URI requests the "party-management" document and “parties” collection. This request must include relevant data.
#### Example Input: {"data":{"user_id":"1","handicap":"15","course_id":"1","size":"4","longitude":"0","latitude":"0","golf_cart":"TRUE"}}
#### Output: Successful
    * Header: 200: Ok
    * Body (text/html): 200: Player and Party added successfully!
#### Output: Unsuccessful
    * Header: 404: Page Not Found
    * Body (text/html): 404: Error, player and party not added
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (text/html): 501: Error, service not recognized

## [INSERT SCORE]
### URI [POST] : http://localhost/party-management/parties/1/scores
* This URI requests the "party-management" document, “parties” collection, "1" collection URI (represents party_id), and "scores" store. This request must include relevant data.
#### Example Input: {"data":{"hole_id":"1","user_id":"1","party_id":"1","stroke":"6"}}
#### Output: Successful
    * Header: 200: Ok
    * Body (text/html): 200: Score added successfully!
#### Output: Unsuccessful
    * Header: 404: Page Not Found
    * Body (text/html): 404: Error, score not added
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (text/html): 501: Error, service not recognized

## [UPDATE SCORE]
### URI [PUT] : http://localhost/party-management/parties/1/scores
* This URI requests the "party-management" document, “parties” collection, "1" collection URI (represents party_id), and "scores" store. This request must include relevant data.
#### Example Input: {"data":{"hole_id":"1","user_id":"1","party_id":"1","stroke":"6"}}
#### Output: Successful
    * Header: 200: Ok
    * Body (text/html): 200: Score updated successfully!
#### Output: Successful (no changes were made)
    * Header: 204: No content
    * Body: N/A
#### Output: Unsuccessful
    * Header: 404: Page Not Found
    * Body (text/html): 404: Error, score not updated
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (text/html): 501: Error, service not recognized

## [START ROUND]
### URI [POST] : http://localhost/party-management/parties/start-round
* This URI requests the "party-management" document, “parties” collection, and "start-round" controller. This request must include relevant data.
#### Example Input: {"data":{"course_id":"1","start_hole":"1","end_hole":"9"}}
#### Output: Successful
    * Header: 200: Ok
    * Body (app/json): Returns party round (Course, Holes, and Tees)
#### Output: Unsuccessful
    * Header: 404: Page Not Found
    * Body (text/html): 404: Error, no round started
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (text/html): 501: Error, service not recognized