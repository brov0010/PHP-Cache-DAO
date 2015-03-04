#! /bin/bash

echo -n "Enter the domain for testing and press [ENTER]: "
read domain

curl -X POST -d "first_name=Test" -d "last_name=Tester" -d "email=test@test.com" -d "password=testing" -v "http://$domain/users/"
curl -v "http://$domain/users/1"
curl -X PUT -d "id=1" -d "first_name=Test" -d "last_name=Tester" -d "email=test@test.com" -v "http://$domain/users/"
curl -v "http://$domain/users/1"
curl -X DELETE -v "http://$domain/users/1"
