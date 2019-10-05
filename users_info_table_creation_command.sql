create table user_info(user_id int(11) UNIQUE, lastName varchar(100) not null, firstName varchar(100) not null, 
address varchar(200) not null, city varchar(100) not null, state char(2) not null, zip char(5) not null,
email varchar(150) not null, primary key(user_id), foreign key(user_id) references users(id));