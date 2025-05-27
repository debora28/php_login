create database if not exists php_auth;

create table if not exists php_auth.users (
    id int primary key auto_increment,
    name varchar(255),
    email varchar(255),
    password varchar(255),
    token varchar(255),
    createdAt datetime default CURRENT_TIMESTAMP(),
    updatedAt datetime default CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP
);

insert into php_auth.users (name, email, password, token, createdAt)
values(
        'Admin',
        'admin@gmail.com',
        '$2y$10$2YBZm7qb92AnokLtIYh6ye/L86Tw9HFuVfOmzztfQGYaaPCK/ioR2',
        '',
        CURRENT_TIMESTAMP()
    );