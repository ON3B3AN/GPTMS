# Game Management Routes/Endpoints

## [INSERT PLAYER & PARTY]
### URI [POST] : http://localhost/game-management/games
* This URI requests the "game-management" document and “games” collection. This request must include relevant data.
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
### URI [POST] : http://localhost/game-management/games/1/scores
* This URI requests the "game-management" document, “games” collection, "1" collection URI, and "scores" store. This request must include relevant data.
#### Example Input: {"data":{"hole_id":"1","user_id":"1","party_id":"1","stroke":"6","total_score":"10"}}
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
### URI [PUT] : http://localhost/game-management/games/1/scores
* This URI requests the "game-management" document, “games” collection, "1" collection URI, and "scores" store. This request must include relevant data.
#### Example Input: {"data":{"hole_id":"1","user_id":"1","party_id":"1","stroke":"6","total_score":"10"}}
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