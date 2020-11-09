# Level 2: REST API
- Makes use of HTTP verbs and headers for interactions with resources
- Services return appropriate HTTP response statuses for errors based on the error type

### REST Resource URI Case Templates
    * Case 4 -> http://localhost/GPTMS/api/document/collection
    * Case 4 -> http://localhost/GPTMS/api/document/collection?filter={filterVal}
    * Case 5 -> http://localhost/GPTMS/api/document/collection/{collectionURI}
    * Case 5 -> http://localhost/GPTMS/api/document/collection/controller
    * Case 6 -> http://localhost/GPTMS/api/document/collection/{collectionURI}/store
    * Case 7 -> http://localhost/GPTMS/api/document/collection/{collectionURI}/store/{storeURI}
    * Case 7 -> http://localhost/GPTMS/api/document/collection/{collectionURI}/store/controller
### URI Resource Indexing
    * URL length [3] -> Document
    * URL length [4] -> Collection w/ OR w/o Query Component
    * URL length [5] -> Collection URI OR Controller
    * URL length [6] -> Store
    * URL length [7] -> Store URI OR Controller