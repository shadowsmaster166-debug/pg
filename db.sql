CREATE TYPE user_role AS ENUM ('admin', 'user');

create table users(
id serial primary key ,
name varchar(255) not null,
email varchar(255) unique not null,
password varchar(250) not null,
role user_role default 'user'
);

create table buku(
id serial primary key,
title varchar(255) not null,
author varchar(255) not null,
isbn varchar(100),
quantity int default 1
);

CREATE TYPE status_role AS ENUM ('borrowed','returned');

create table transaksi(
id serial primary key,
users_id int,
buku_id int,
issue_date date not null,
return_date date,
status status_role default 'borrowed',

constraint fk_users
foreign key(users_id)
references users(id)
on delete cascade,

constraint fk_buku
foreign key(buku_id)
references buku(id)
on delete cascade
);