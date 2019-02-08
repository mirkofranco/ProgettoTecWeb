CREATE USER IF NOT EXISTS 'mifranco'@'localhost' IDENTIFIED BY 'Aideebe4esooDuqu';

CREATE DATABASE IF NOT EXISTS mifranco;
ALTER DATABASE mifranco CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

GRANT ALL PRIVILEGES ON mifranco.* TO 'mifranco'@'localhost';
FLUSH PRIVILEGES;
