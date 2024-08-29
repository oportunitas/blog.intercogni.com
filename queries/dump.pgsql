-- select table_name
--    from information_schema.tables
--    where table_schema = 'public';

select *
   from migrations
   
create table article (
   "id" serial primary key,
   "title" varchar(255) not null,
   "content" text not null,
   "created_at" timestamp default current_timestamp,
   "updated_at" timestamp default current_timestamp
);