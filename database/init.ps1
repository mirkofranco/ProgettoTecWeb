chcp 866

echo "-- creating database and inserting values"

mysql --user='root' --show-warnings --execute="source D:/_Programming/TW_progetto/ProgettoTecWeb/database/create_database_and_user.sql"

mysql --user='mifranco' --password='Aideebe4esooDuqu' --database="mifranco" --show-warnings --default-character-set=utf8 --execute="source D:/_Programming/TW_progetto/ProgettoTecWeb/database/create_tables_and_insert.sql"