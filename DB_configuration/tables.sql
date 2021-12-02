create table IF NOT EXISTS  users (
username varchar(50) not null,
fname varchar(50),
lname varchar(50),
phone varchar(50),
address varchar (250),
email varchar(100),
zipcode varchar(10),
password char (40) not null,
temp_password char(40),
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
cvv int not null,
FOREIGN KEY (username) REFERENCES users(username) 
);


CREATE TABLE IF NOT EXISTS menu (
menu_item_id int not null auto_increment primary key,
menu_item_name varchar(222) NOT NULL,
description varchar(255),
tags varchar(255),
picture_path varchar(100),
price DECIMAL(10,2),
hiden varchar(100)
);
# NA for any normal menu item 
# HI for create your own pizza 

CREATE TABLE IF NOT EXISTS user_orders (
  user_order_id int(11) NOT NULL,
  username varchar(50) NOT NULL,
  menu_item_id int(11) NOT NULL,
  quantity int(11) NOT NULL,
  status char(1) DEFAULT 'O',
  order_date timestamp NOT NULL DEFAULT current_timestamp(),
  FOREIGN KEY (username) REFERENCES users(username),
  FOREIGN KEY (menu_item_id) REFERENCES menu(menu_item_id),
  PRIMARY KEY (user_order_id, menu_item_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


# O for ordered
# P in progress
# D out for delivery
# C for completed
# X canceled 


