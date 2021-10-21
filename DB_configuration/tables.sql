

create table IF NOT EXISTS  users (
username varchar(50) not null,
fname varchar(50),
lname varchar(50),
phone varchar(50),
address varchar (250),
email varchar(100),
password char (40) not null,
primary key (username)
);
CREATE TABLE IF NOT EXISTS admin_code (
  id int NOT NULL AUTO_INCREMENT,
  code char(8) NOT NULL unique,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS admin (
  adm_id int NOT NULL AUTO_INCREMENT,
  username varchar(30) NOT NULL,
  password varchar(40) NOT NULL,
  email varchar(40) NOT NULL,
  code char(8) NOT NULL,
  date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (adm_id),
  FOREIGN KEY (code) REFERENCES admin_code(code) 

) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS payment_info (

username varchar(50) not null,
card_name varchar(150) not null,
expiration_date varchar(10) not null,
card_number varchar(25) not null,
FOREIGN KEY (username) REFERENCES users(username) 
);

CREATE TABLE IF NOT EXISTS menu (
menu_id int not null auto_increment,
name varchar(100),
description varchar(255),
tags varchar(255),
picture_path varchar(100),
cost DECIMAL(10,2),
primary key(menu_id)
);


CREATE TABLE IF NOT EXISTS order_history (
order_id int not null auto_increment primary key,
order_date timestamp DEFAULT CURRENT_TIMESTAMP,
username varchar(50),
menu_id int,
status char(1) default 'O',
FOREIGN KEY (username) REFERENCES users(username),
FOREIGN KEY (menu_id) REFERENCES menu(menu_id) 
);
# O for ordered
# P in progress
# D out for delivery
# C for completed 
insert into menu values(null,'big pizza','testint pizza','pizza',null,18.50);
Select menu_id, name, description, tags, picture_path, cost from menu;