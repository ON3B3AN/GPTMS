# Courses Route/Endpoint

## [SELECT ALL]
### URI [GET] : http://localhost/course-management/courses
* This URI requests the "course-management" document and “courses” collection. This request must not include any data.
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
### URI [GET] : http://localhost/course-management/courses/1
* This URI requests the "course-management" document, “courses” collection, and "1" collection URI (represents course_id). This request must not include any data.
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
### URI [POST] : http://localhost/course-management/courses
* This URI requests the "course-management" document and “courses” collection. This request must include relevant data.
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
### URI [PUT] : http://localhost/course-management/courses/1
* This URI requests the "course-management" document, “course” collection, and "1" collection URI (represents course_id). This request must include relevant data.
#### Example Input: {"data":{"course_name":"Billy's Other Home","address":"105 Billy Other Home Lane","phone_number":"000-123-5000"}}
#### Output: Successful
    * Header: 200: Ok
    * Body (text/html): 200: Course updated successfully
#### Output: Successful
    * Header: 204: No content
    * Body: N/A
#### Output: Unsuccessful
    * Header: 404: Page Not Found
    * Body (text/html): 404: Error, course not updated
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (text/html): 501: Error, service not recognized

## [DELETE]
### URI [DELETE] : http://localhost/course-management/courses/1
* This URI requests the "course-management" document, “course” collection, and "1" collection URI (represents course_id). This request must not include any data.
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

## [DELETE]
### URI [DELETE] : http://localhost/course-management/courses/1
* This URI requests the "course-management" document, “course” collection, and "1" collection URI (represents course_id). This request must not include any data.
#### Example Input: {"data":{"tee1":"tee1","tee2":"tee2","tee3":"tee3","start_hole":"1","end_hole":"9"}}
#### Output: Successful
    * Header: 200: Ok
    * Body (text/html): 200: Course deleted successfully
#### Output: Unsuccessful
    * Header: 404: Page Not Found
    * Body (text/html): 404: Error, course not deleted
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (text/html): 501: Error, service not recognized
