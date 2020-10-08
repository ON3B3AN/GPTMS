# History Route/Endpoint

[SELECT ALL]
URL [GET] : http://localhost/history/
•	This URL requests the “history” collection but does not query a service, therefore a default service is called
Example Input: N/A; refers to user id set via session cookie on login
Output (app/json): Successful
Returns all history associated with a user id via session cookies set on successful login
Output: Unsuccessful
	Header: 404: Page Not Found
	Body: 404: No user history
Output: Server Error
	Header: 501: Not Implemented
	Body: 501: Error, service not recognized

[SELECT]
URL [GET] : http://localhost/history/id?=1
•	This URL requests the “history” collection and queries for the “id” service with a user id of “1”. This service returns all history associated with a given user id
Example Input: N/A
Output (app/json): Successful
Returns all history associated with the given user id
Output: Unsuccessful 
	Header: 404: Page Not Found
	Body: 404: No user history
Output: Server Error
	Header: 501: Not Implemented
	Body: 501: Error, service not recognized
