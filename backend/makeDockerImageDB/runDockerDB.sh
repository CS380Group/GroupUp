#! /bin/bash

docker run --name GroupUpDB -p 3306:3306 -d docker.io/library/groupupdb
echo "Database container successfully started."
