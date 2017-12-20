create schema af;

drop database if exists alternafuel;
create database alternafuel;
\c alternafuel;

/* if user afadmin doesn't exist: sha256 for 'cupcakes99' */
create user afadmin;
alter user afadmin with password '809a721743350c0c49a7b444ad3aeaf1341fdd48d1bf510e08b008edab72dc70';

/* either way, give them proper ownership */
alter database alternafuel owner to afadmin;
grant all privileges on database alternafuel to afadmin;
grant all privileges on all tables in schema af TO afadmin;
grant usage on schema af to afadmin;
grant usage, select on all sequences in schema af TO afadmin;
alter schema af owner to afadmin;
 
CREATE TABLE af.User (
   id SERIAL PRIMARY KEY,
   fname VARCHAR(35),
   lname VARCHAR(35),
   username VARCHAR(35) NOT NULL,
   passwd VARCHAR(255) NOT NULL
);

CREATE TABLE af.Role (
  id SERIAL PRIMARY KEY,
  name VARCHAR(35),
  description VARCHAR(255)
);

CREATE TABLE af.User_Roles (
  user_id bigint REFERENCES af.User(id),
  role_id bigint references af.Role(id),
  PRIMARY KEY(user_id, role_id)
);

CREATE TABLE af.User_Stations (
  user_id bigint REFERENCES af.User(id),
  station_id bigint,
  is_hidden boolean,
  is_favorite boolean,
  PRIMARY KEY(user_id, station_id)
);