#!/bin/bash
echo "mysql needs to be on PATH to do this;"

echo "set pwd to this script folder"
cd ${0%/*}

echo "-- creating db and user; will prompt for your root password"

mysql --user='root' -p --default-character-set=utf8 --show-warnings --execute="source create_database_and_user.sql"

echo "-- creating tables and inserting values as the newly created user"

mysql --user='mifranco' --password='Aideebe4esooDuqu' --database="mifranco" --default-character-set=utf8 --show-warnings --execute="source create_tables_and_insert.sql"