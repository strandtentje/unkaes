In datamodel.sql is omschreven hoe de database eruit ziet, in SQL welteverstaan.

Deze file kun je in mysql drukken als volgt:

cat datamodel.sql | mysql -uunkaes -punkaes unkaes

Uiteraard moet hiervoor de db unkaes bestaan

Die maak je door als root in te loggen op mysql 

Dan klop je in:

CREATE USER unkaes@localhost IDENTIFIED BY 'unkaes';
CREATE DATABASE unkaes;
GRANT ALL ON unkaes.* TO unkaes@localhost;


