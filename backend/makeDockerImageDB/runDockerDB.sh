#! /bin/bash

docker run --name GroupUpDB -p 3307:3306 -d docker.io/library/groupupdb
echo "Database container successfully started."
