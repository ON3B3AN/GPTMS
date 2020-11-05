# Level 2: REST API
- Makes use of HTTP verbs and headers for interactions with resources
- Services return appropriate HTTP response statuses for errors based on the error type

### URI Path Naming Options
#### Notice: {collectionURI} and {storeURI} can represent either a controller name or unique identifier (numeric value).
#### Without Query Filtering
    * http://localhost/document/collection/{collectionURI}/store/{storeURI}
    * http://localhost/document/collection/{collectionController}/store/{storeController}
    * http://localhost/document/collection/{collectionURI}/store/{storeController}
    * http://localhost/document/collection/{collectionController}/store/{storeURI}

#### With Query Filtering
    * http://localhost/document/collection?filter=val/{collectionURI}/store/{storeURI}
    * http://localhost/document/collection?filter=val/{collectionController}/store/{storeController}
    * http://localhost/document/collection?filter=val/{collectionURI}/store/{storeController}
    * http://localhost/document/collection?filter=val/{collectionController}/store/{storeURI}

### URI Path Naming Examples
#### Without Query Filtering
    * I.E.; http://localhost/user-management/users
    * I.E.; http://localhost/user-management/users/2
    * I.E.; http://localhost/user-management/users/2/history
    * I.E.; http://localhost/user-management/users/2/history/1

#### With Query Filtering
    * I.E.; http://localhost/user-management/users?state=MI
    * I.E.; http://localhost/user-management/users?state=MI/2
    * I.E.; http://localhost/user-management/users?state=MI/2/history
    * I.E.; http://localhost/user-management/users?state=MI/2/history/1