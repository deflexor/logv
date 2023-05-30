create database yklogviewertoo;
use logviewer;
source /db/database.sql;

create user hi identified by "hi";
grant all privileges on logviewer.* to hi@'%';