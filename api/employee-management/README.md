# Employee Management: Routes/Endpoints

## [SELECT ALL EMPLOYEES]
### URI [GET] : http://localhost/employee-management/employees
* This URI requests the "employee-management" document and “employees” collection. This request must not include any data.
#### Example Input: N/A
#### Output: Successful
    * Header: 200: Ok
    * Body (app/json): {Returns all employees}
#### Output: Unsuccessful
    * Header: 404: Page Not Found
    * Body (app/json): {"message":"404: No employees found"}
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (app/json): {"message":"501: Error, service not recognized"}

## [SELECT EMPLOYEE]
### URI [GET] : http://localhost/employee-management/employees/1
* This URI requests the "employee-management" document, “employees” collection, and "1" collection URI (represents employee id). This request must not include any data.
#### Example Input: N/A
#### Output: Successful
    * Header: 200: Ok
    * Body (app/json): {Returns employee}
#### Output: Unsuccessful
    * Header: 404: Page Not Found
    * Body (app/json): {"message":"404: No employee with id=1 found"}
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (app/json): {"message":"501: Error, service not recognized"}

## [INSERT EMPLOYEE]
### URI [POST] : http://localhost/employee-management/employees
* This URI requests the "employee-management" document and “employee” collection. This request must include relevant data.
#### Example Input: {"data":{"User_user_id":"3","Course_course_id":"1","security_lvl":"0"}}
#### Output: Successful
    * Header: 201: Created
    * Body (app/json): {"message":"201: Employee added successfully"}
#### Output: Unsuccessful
    * Header: 404: Page Not Found
    * Body (app/json): {"message":"404: Error, employee not added"}
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (app/json): {"message":"501: Error, service not recognized"}

## [UPDATE EMPLOYEE]
### URI [PUT] : http://localhost/employee-management/employees/1
* This URI requests the "employee-management" document, “employees” collection, and "1" collection URI (represents employee id). This request must include relevant data.
#### Example Input: {"data":{"Course_course_id":"1","security_lvl":"0"}}
#### Output: Successful
    * Header: 200: Ok
    * Body (app/json): {"message":"200: Employee updated successfully"}
#### Output: Successful (no changes were made)
    * Header: 204: No content
    * Body (app/json): {"message":"204: No changes made"}
#### Output: Unsuccessful
    * Header: 404: Page Not Found
    * Body (app/json): {"message":"404: Error, employee not updated"}
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (app/json): {"message":"501: Error, service not recognized"}

## [DELETE EMPLOYEE]
### URI [DELETE] : http://localhost/employee-management/employee/1
* This URI requests the "employee-management" document, “employees” collection, and "1" collection URI (represents employee id). This request must not include any data.
#### Example Input: N/A
#### Output: Successful
    * Header: 200: Ok
    * Body (app/json): {"message":"200: Employee deleted successfully"}
#### Output: Unsuccessful
    * Header: 404: Page Not Found
    * Body (app/json): {"message":"404: Error, employee not deleted"}
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (app/json): {"message":"501: Error, service not recognized"}

## [SELECT EMPLOYEE BY COURSE]
### URI [GET] : http://localhost/employee-management/employees?course_id=1
* This URI requests the "employee-management" document, “employees” collection, "course_id" filter, and "1" filterVal. This request must not include any data.
#### Example Input: N/A
#### Output: Successful
    * Header: 200: Ok
    * Body (app/json): {Returns all employees by course id}
#### Output: Unsuccessful
    * Header: 404: Page Not Found
    * Body (app/json): {"message":"404: Error, no employees found"}
#### Output: Server Error
    * Header: 501: Not Implemented
    * Body (app/json): {"message":"501: Error, service not recognized"}
