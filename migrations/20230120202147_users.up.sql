create table users
(
    id         integer primary key,
    name       text,
    age        integer,
    location   text,
    hobbies    text,
    occupation text,
    goals      text,
    added_by   integer,
    created_at integer
);