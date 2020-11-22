# Course Management: Routes/Endpoints

## [SELECT ALL COURSES]
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

## [SELECT COURSE]
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

## [INSERT COURSE]
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

## [UPDATE COURSE]
### URI [PUT] : http://localhost/course-management/courses/1
* This URI requests the "course-management" document, “course” collection, and "1" collection URI (represents course_id). This request must include relevant data.
#### Example Input: {"data":{"course_name":"Billy's Other Home","address":"105 Billy Other Home Lane","phone_number":"000-123-5000"}}
#### Output: Successful
    * Header: 200: Ok
    * Body (text/html): 200: Course updated successfully
#### Output: Successful (no changes were made)
    * Header: 204: No content
    * Body: N/A
#### Output: Unsuccessful
    * Header: 404: Page Not Found
    * Body (text/html): 404: Error, course not updated
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (text/html): 501: Error, service not recognized

## [DELETE COURSE]
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

## [SELECT HOLES]
### URI [GET] : http://localhost/course-management/courses/1/holes
* This URI requests the "course-management" document, “course” collection, "1" collection URI (represents course_id), and "holes" store. This request must not include any data.
#### Example Input: N/A
#### Output: Successful
    * Header: 200: Ok
    * Body (app/json): Returns all holes
#### Output: Unsuccessful
    * Header: 404: Page Not Found
    * Body (text/html): 404: Error, no holes found
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (text/html): 501: Error, service not recognized

## [SELECT TEES]
### URI [GET] : http://localhost/course-management/courses/1/tees
* This URI requests the "course-management" document, “courses” collection, "1" collection URI (represents course_id), "tees" store. This request must not include any data.
#### Example Input: N/A
#### Output: Successful
    * Header: 200: Ok
    * Body (app/json): Returns all tees
#### Output: Unsuccessful
    * Header: 404: Page Not Found
    * Body (text/html): 404: Error, no tees found
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (text/html): 501: Error, service not recognized

## [SELECT COURSE RECORDS]
### URI [GET] : http://localhost/course-management/courses/1/records
* This URI requests the "course-management" document, “courses” collection, "1" collection URI (represents course_id), "records" store. This request must not include any data.
#### Example Input: N/A
#### Output: Successful
    * Header: 200: Ok
    * Body (app/json): Returns all course records (course, holes, tees)
#### Output: Unsuccessful
    * Header: 404: Page Not Found
    * Body (text/html): 404: Error, no course records with id=1 found
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (text/html): 501: Error, service not recognized
