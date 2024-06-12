POST
curl -X POST -H "Content-Type: application/json" -d '{\"name\":\"David\", \"email\":\"david@gmail.com\"}' http://localhost:8000/api/users
PUT
curl -X PUT -H "Content-Type: application/json" -d '{\"name\":\"David2\", \"email\":\"david2@gmail.com\"}' http://localhost:8000/api/users/3
DELETE
curl -X DELETE http://localhost:8000/api/users/3
GET/number
curl -X GET http://localhost:8000/api/users/4
GET
curl -X GET http://localhost:8000/api/users
