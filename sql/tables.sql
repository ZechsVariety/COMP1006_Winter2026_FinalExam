create table postsF (
    id int auto_increment primary key,

    title varchar(100),
    imagePath varchar(255)
);

create table usersF (
    id int auto_increment primary key,

    username varchar(50) not null,
    email varchar(100) not null,
    password varchar(255) not null
);
