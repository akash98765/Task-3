# Task-3
PHP
create database users;
create table userlog(id  int(3) unsigned not null primary key auto_increment,username varchar(25) not null,password varchar(25) not null,email varchar(50) not null);
create table userin(url varchar(30) not null primary key,user varchar(20) not null,type varchar(20) not null,visible varchar(20) not null,language varchar(20)
not null,createdate datetime,expirydate datetime,paste varchar(3000) not null);
