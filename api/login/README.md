# Login Route/Endpoint

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
