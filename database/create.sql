CREATE DATABASE `BLOG`;

create table `users`
(
    `id` int primary key auto_increment,
    `firstName` varchar(50) not null,
    `email` varchar(255) not null unique,
    `password` varchar(255) not null,
);

create table `posts`
(
    `id` int primary key auto_increment,
    `title` varchar(255) not null,
    `content` text not null,
    `created_at` timestamp default current_timestamp,
    `user_id` int ,
    `image` varchar(255) not null,
    foreign key (`user_id`) references `users` (`id`)
);

create table `likes` 
(
    `id` int primary key auto_increment,
    `post_id` int,
    `user_id` int,
    foreign key (`post_id`) references `posts` (`id`),
    foreign key (`user_id`) references `users` (`id`)
);

create table `comments`
(
    `id` int primary key auto_increment,
    `comment` text not null,
    `created_at` timestamp default current_timestamp,
    `post_id` int,
    `user_id` int,
    foreign key (`post_id`) references `posts` (`id`),
    foreign key (`user_id`) references `users` (`id`)
);

create table `likesComment`
(
    `id` int primary key auto_increment,
    `comment_id` int,
    `user_id` int,
    foreign key (`comment_id`) references `comments` (`id`),
    foreign key (`user_id`) references `users` (`id`)
);


ALTER TABLE users
ADD COLUMN state VARCHAR(255) DEFAULT 'user';

ALTER TABLE `users`
    DROP `lastName`,
    DROP `age`;
