# User Management Routes/Endpoints

## [LOG IN]
### URI [POST] : http://localhost/user-management/users/login
* This URI requests the "user-management" document, "users" collection, and the "login" controller. This request must include relevant data.
#### Example Input (app/json): {"data":{"email":"tthayer@oakland.edu","password":"1234"}}
#### Output: Successful
    * Header: 200: Ok
    * Body (app/json): Returns all user data and/or employee data associated with email and password
#### Output: Unsuccessful
    * Header: 401 Unauthorized 
    * Body (text/html): 401: Login failed
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (text/html): 501: Error, service not recognized

## [LOG OUT]
### URI [DELETE] : http://localhost/user-management/users/logout
* This URI requests the "user-management" document, “users” collection, and the “logout” controller. This request must not include any data.
#### Example Input: N/A
#### Output: N/A

## [SIGN UP]
### URI [POST] : http://localhost/user-management/users
* This URI requests the "user-management" document and the “users” collection.  This request must include relevant data.
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

## [SELECT ALL USER HISTORY]
### URI [GET] : http://localhost/user-management/users/1/history
* This URI requests the "user-management" document, “users” collection, "1" collection URI (represents user_id), and the "history" store. This request must not include any data.
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

## [SELECT ALL USERS]
### URI [GET] : http://localhost/user-management/users
* This URI requests the "user-management" document and the “users” collection. This request must not include any data.
#### Example Input: N/A
#### Output: Successful
    * Header: 200: Ok
    * Body (app/json): Returns all users
#### Output: Unsuccessful 
    * Header: 404: Page Not Found
    * Body (text/html): 404: No users found
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (text/html): 501: Error, service not recognized

## [UPDATE USER]
### URI [PUT] : http://localhost/user-management/users/1
* This URI requests the "user-management" document, “users” collection, "1" collection URI (represents user_id). This request must include relevant data.
#### Example Input: {"data":{"first_name":"Joe","last_name":"Blow","email":"jkk@gmail.com","password":"1234","check_password":"1234","phone":"000-000-0000"}}
#### Output: Successful
    * Header: 200: Ok
    * Body (text/html): 200: Profile updated successfully
#### Output: Successful (no changes were made)
    * Header: 204: No content
    * Body: N/A
#### Output: Unsuccessful 
    * Header: 404: Page Not Found
    * Body (text/html): 404: Error, passwords didn't match
#### Output: Unsuccessful 
    * Header: 404: Page Not Found
    * Body (text/html): 404: Error, profile not updated
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (text/html): 501: Error, service not recognized

## [DELETE USER]
### URI [DELETE] : http://localhost/user-management/users/1
* This URI requests the "user-management" document, “users” collection, "1" collection URI (represents user_id). This request must not include any data.
#### Example Input: N/A
#### Output: Successful
    * Header: 200: Ok
    * Body (text/html): 200: Profile deleted successfully
#### Output: Unsuccessful 
    * Header: 404: Page Not Found
    * Body (text/html): 404: Error, profile not deleted
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (text/html): 501: Error, service not recognized