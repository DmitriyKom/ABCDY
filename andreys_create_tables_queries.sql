

create table user_info(user_id int(11) UNIQUE, lastName varchar(100) not null, firstName varchar(100) not null, 
address varchar(200) not null, city varchar(100) not null, state char(2) not null, zip char(5) not null,
email varchar(150) not null, primary key(user_id), foreign key(user_id) references users(id));

/* Testing data */
 insert into user_info(user_id, lastName, firstName, address, city, state, zip, email)
 values (7, 'Jordan', "Mike", "123 Main st, apt N44", "Minneapolis", "MN", "12345", "hahA@haa.com");
 insert into user_info(user_id, lastName, firstName, address, city, state, zip, email)
 values (6, 'Klinton', "Gus", "999 Orange St", "St.Paul", "MN", "54321", "asdfadfw@cool.com");
 insert into user_info(user_id, lastName, firstName, address, city, state, zip, email)
 values (8, 'Branton', "Jim", "1284 Second St.SW", "Apple Valley", "MN", "54451", "hello.isme@bestemail.com");
 insert into user_info(user_id, lastName, firstName, address, city, state, zip, email)
 values (9, 'Jefferson', "Pam", "76 Sunny Ave. Apt#88", "Mapewood", "MN", "54111", "afaf.asfaf@dddeexx.com");
 
 show databases;
 use ics499_abcdy_group;
 show tables;
 drop table user_info;
 drop table users;
 describe user_info;
 select * from users;
 select * from user_info;