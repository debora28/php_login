
create table php_auth.users (
id int primary key auto_increment,
name varchar(255),
email varchar(255),
password varchar(255),
token varchar(255),
createdAt datetime default CURRENT_TIMESTAMP(),
updatedAt datetime default CURRENT_TIMESTAMP()
)


insert into php_auth.users values(1, 'admin', 'admin@gmail.com', '$2y$10$2YBZm7qb92AnokLtIYh6ye/L86Tw9HFuVfOmzztfQGYaaPCK/ioR2', '', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP());
select * from php_auth.users;