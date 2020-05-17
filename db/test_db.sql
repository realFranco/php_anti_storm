-- Franco Gil
-- May 17th, 2020
-- Table test for the first conection postgres - php
-- create datatabase php_t
-- \c php_t

create table if not exists car(
    brand varchar (32) not null,
    model varchar (32) not null,
    year integer
);

-- seeding 
insert into car values ('ford', 'f150', 1997);
insert into car values ('ford', 'f250', 1997);
insert into car values ('ford', 'mustang', 1997);
insert into car values ('mclaren', 'f1', 1997);
insert into car values ('mclaren', 'senna', 1997);

-- select * from car;

-- drop table if exists car;
