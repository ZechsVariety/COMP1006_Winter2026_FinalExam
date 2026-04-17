create table postsF (
    id int auto_increment primary key,

    title varchar(100),
    imagePath varchar(255)
);

create table usersF (
    id int auto_increment primary key,

    -- ommitted username because its not required
    email varchar(100) not null,
    password varchar(255) not null
);
