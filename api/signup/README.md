# Signup Route/Endpoint

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
