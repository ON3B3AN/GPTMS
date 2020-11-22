# Party Management Routes/Endpoints

## [SELECT ACTIVE PARTIES]
### URI [GET] : http://localhost/party-management/parties?course_id=1
* This URI requests the "party-management" document, “parties” collection, "course_id" filter, and value of "1". This request must not include any data.
#### Example Input: N/A
#### Output: Successful
    * Header: 200: Ok
    * Body (app/json): 200: Returns all active party and player data based on course id
#### Output: Unsuccessful
    * Header: 404: Page Not Found
    * Body (text/html): 404: Error, no active parties found
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (text/html): 501: Error, service not recognized

## [INSERT PARTY & PLAYER]
### URI [POST] : http://localhost/party-management/parties
* This URI requests the "party-management" document and “parties” collection. This request must include relevant data.
#### Example Input: {"data":{"handicap":"15","email":"smith@gmail.com,barker@gmail.com,email@gmail.com","course_id":"1","size":"3","longitude":"0","latitude":"0","golf_cart":"1"}}
#### Output: Successful
    * Header: 200: Ok
    * Body (text/html): Returns party id
#### Output: Unsuccessful
    * Header: 404: Page Not Found
    * Body (text/html): 404: Error, player and party not added
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (text/html): 501: Error, service not recognized

## [INSERT SCORE]
### URI [POST] : http://localhost/party-management/parties/1/scores
* This URI requests the "party-management" document, “parties” collection, "1" collection URI (represents party_id), and "scores" store. This request must include relevant data.
#### Example Input: {"data":{"Hole_hole_id":"1","Player_User_user_id":"2","stroke":"6","total_score":"10"}}
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
#### Example Input: {"data":{"Hole_hole_id":"1","Player_User_user_id":"1","stroke":"12","total_score":"120"}}
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
### URI [POST] : http://localhost/party-management/parties/1/rounds
* This URI requests the "party-management" document, “parties” collection, "1" collection URI (represents party id), and "rounds" store. This request must include relevant data.
#### Example Input: {"data":{"course_id":"1","start_hole":"1","end_hole":"9"}}
#### Output: Successful
    * Header: 200: Ok
    * Body (app/json): Returns party round info (Party, Course, Holes, and Tees)
#### Output: Unsuccessful
    * Header: 404: Page Not Found
    * Body (text/html): 404: Error, no round started
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (text/html): 501: Error, service not recognized

## [REQUEST SERVICES]
### URI [GET] : http://localhost/party-management/parties/1/request-services
* This URI requests the "party-management" document, “parties” collection, and "request-services" controller. This request must not include any data.
#### Example Input: N/A
#### Output: Successful
    * Header: 200: Ok
    * Body (text/html): Services have been successfully requested!
#### Output: Unsuccessful
    * Header: N/A
    * Body: N/A
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (text/html): 501: Error, service not recognized

## [UPDATE PARTY COORDINATES]
### URI [PUT] : http://localhost/party-management/parties/1/coordinates
* This URI requests the "party-management" document, “parties” collection, "1" collection URI (represents party_id), and "coordinates" store. This request must include relevant data.
#### Example Input: {"data":{"longitude":"1","latitude":"1"}}
#### Output: Successful
    * Header: 200: Ok
    * Body (text/html): 200: Coordinates updated successfully!
#### Output: Successful (no changes were made)
    * Header: 204: No content
    * Body: N/A
#### Output: Unsuccessful
    * Header: 404: Page Not Found
    * Body (text/html): 404: Error, coordinates not updated
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (text/html): 501: Error, service not recognized