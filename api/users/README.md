# Users Route/Endpoint

## [LOGIN]
### URL [POST] : http://localhost/login/
* This URL requests a collection but does not query a service b/c the “login” collection only offers one service; which is used to login a user
#### Example Input (app/json): {"data":{"email":"tthayer@oakland.edu","password":"1234"}}
#### Output: Successful
    * Header: 200: Ok
    * Body (app/json): Returns all user data associated with email and password
#### Output: Unsuccessful
    * Header: 401 Unauthorized 
    * Body (text/html): 401: Login failed
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (text/html): 501: Error, service not recognized

## [SIGNUP]
### URL [POST] : http://localhost/signup/
* This URL requests the “signup” collection but does not query a service b/c the “signup” collection only offers one service; which is used to sign up a user
#### Example Input (app/json): {"data":{"first_name":"Joe","last_name":"Blow","phone":"298-999-4343","email":"email@gmail.com","password":"1234"}}
#### Output: Successful 
    * Header: 201 Created
    * Body (text/html): 201: Profile created successfully
#### Output: Unsuccessful 
    * Header: 404: Page Not Found
    * Body (text/html): 404: Error, profile not created
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (text/html): 501: Error, service not recognized

## [HISTORY SELECT ALL]
### URL [GET] : http://localhost/history/
* This URL requests the “history” collection but does not query a service, therefore a default service is called
#### Example Input: N/A; refers to user id set via session cookie on login
#### Output (app/json): Successful
    * Header: 200: Ok
    * Body (app/json): Returns all history associated with a user id via session cookies set on successful login
#### Output: Unsuccessful
    * Header: 404: Page Not Found
    * Body (text/html): 404: No user history
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (text/html): 501: Error, service not recognized

## [HISTORY SELECT]
### URL [GET] : http://localhost/history/id?=1
* This URL requests the “history” collection and queries for the “id” service with a user id of “1”. This service returns all history associated with a given user id
#### Example Input: N/A
#### Output: Successful
    * Header: 200: Ok
    * Body (app/json): Returns all history associated with the given user id
#### Output: Unsuccessful 
    * Header: 404: Page Not Found
    * Body (text/html): 404: No user history
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (text/html): 501: Error, service not recognized
