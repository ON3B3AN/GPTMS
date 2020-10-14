# Courses Route/Endpoint

## [SELECT ALL]
### URL [GET] : http://localhost/courses/
* This URL requests the “course” collection but does not query a particular service, therefore a default service is called, which is select all.
#### Example Input: N/A
#### Output: Successful
    * Header: 200: Ok
    * Body (app/json): Returns all courses
#### Output: Unsuccessful
    * Header: 404: Page Not Found
    * Body (text/html): 404: No courses found
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (text/html): 501: Error, service not recognized

## [SELECT]
### URL [GET] : http://localhost/courses/1
* This URL requests the “course” collection and calls the “select” service with a value of “1”, therefore a course with a course id of 1 is returned.
#### Example Input: N/A
#### Output: Successful
    * Header: 200: Ok
    * Body (app/json): Returns course
#### Output: Unsuccessful
    * Header: 404: Page Not Found
    * Body (text/html): 404: No course with id=1 found
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (text/html): 501: Error, service not recognized

## [INSERT]
### URL [POST] : http://localhost/courses/insert
* This URL requests the “course” collection and calls the “insert” service that doesn’t accept a value.
#### Example Input: {"data":{"course_name":"Billy's Home","address":"105 Billy Home Lane","phone_number":"000-123-7030"}}
#### Output: Successful
    * Header: 201: Created
    * Body (text/html): 201: Course added successfully
#### Output: Unsuccessful
    * Header: 404: Page Not Found
    * Body (text/html): 404: Error, course not added
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (text/html): 501: Error, service not recognized

## [UPDATE]
### URL [PUT] : http://localhost/courses/1
* This URL requests the “course” collection and calls the “update” service with a value of “1”.; therefore a course with the id of 1 is updated if successful.
#### Example Input: {"data":{"course_name":"Billy's Other Home","address":"105 Billy Other Home Lane","phone_number":"000-123-5000"}}
#### Output: Successful
    * Header: 200: Ok
    * Body (text/html): 200: Course updated successfully
#### Output: Unsuccessful
    * Header: 204: No content
    * Body (text/html): 204: No changes were made
#### Output: Unsuccessful
    * Header: 404: Page Not Found
    * Body (text/html): 404: Error, course not updated
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (text/html): 501: Error, service not recognized

## [DELETE]
### URL [DELETE] : http://localhost/courses/1
* This URL requests the “course” collection and calls the “delete” service with a value of “1”; therefore a course with the id of 1 is deleted if successful.
#### Example Input: N/A
#### Output: Successful
    * Header: 200: Ok
    * Body (text/html): 200: Course deleted successfully
#### Output: Unsuccessful
    * Header: 404: Page Not Found
    * Body (text/html): 404: Error, course not deleted
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (text/html): 501: Error, service not recognized
