# Users Route/Endpoint

## [LOGIN]
### URL [POST] : http://localhost/users/login
* This URL requests the "users" collection and the "login" service. This request must include relevant data.
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

## [LOGOUT]
### URL [GET] : http://localhost/users/logout
* This URL requests the “users” collection and the “logout” service. This request must not include any data.
#### Example Input: N/A
#### Output: N/A

## [SIGNUP]
### URL [POST] : http://localhost/users/signup
* This URL requests the “users” collection and the “signup” service.  This request must include relevant data.
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
### URL [GET] : http://localhost/users/1/history
* This URL requests the “users” collection and the "history" service including a service parameter of "1" (which represents a user_id). This request must not include any data.
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
