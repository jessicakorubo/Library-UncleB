create table if not exists `books` (
    `book_id` INT not null AUTO_INCREMENT PRIMARY KEY,
    `title` varchar(255) not null,
    `author` varchar(255) not null,
    `genre` varchar(100) not null,
    `edition` varchar(100),
    `date_published` date,
    `copies` int(10) not null,
    `status` varchar(100) not null
)ENGINE InnoDB DEFAULT CHARSET = utf8;

create table if not exists `members` (
    `member_id` int(11) not null,
    `name` varchar(100),
    `gender` varchar(2) not null,
    `registration_date` date not null,
    `email` varchar(100) not null,
    `phone_number` int,
    `borrowed_books` int,
    PRIMARY KEY (`member_id`)
)ENGINE InnoDB DEFAULT CHARSET = utf8;

create table if not exists `book_copies` (
    `copy_id` INT AUTO_INCREMENT,
    `book_id` INT NOT NULL,
    `ISBN` INT NOT NULL PRIMARY KEY,
    status ENUM('Available', 'Issued', 'Lost') NOT NULL,
    UNIQUE KEY unique_copy_name (`copy_id`),
    FOREIGN KEY (`book_id`) REFERENCES books(`book_id`)
)ENGINE InnoDB DEFAULT CHARSET = utf8;

create table if Nnot exists `issued-books` (
    `member_id` int(11) not null,
    `member_name` varchar(255) not null,
    `ISBN` INT NOT NULL PRIMARY KEY,
    `book_name` varchar(255) not null,
    `author` varchar(100) not null,
    `date_issued` date not null,
    `due_date` date not null,
    `status` varchar(50) not null,
    `copies` int(11) not null,
    `image` varchar(255) not null
    FOREIGN KEY (`ISBN`) REFERENCES book_copies(`ISBN`)
)ENGINE InnoDB DEFAULT CHARSET = utf8;

create table if not exists `admin` ( 
    `admin_id` int not null AUTO_INCREMENT, 
    `admin_username` varchar(100) NOT NULL, 
    `admin_password` varchar(100) NOT NULL,
    PRIMARY KEY (`admin_id`) 
)ENGINE InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `issued_books`
ADD FOREIGN KEY (`ISBN`)
REFERENCES `book_copies`(`ISBN`);



create table if not exists `returned_books` (
    `return_id` int not null AUTO_INCREMENT PRIMARY KEY,
    `ISBN` int,
    `date_issued` date not null,
    `date_returned` date not null,
    `member_id` int (11) not null,
    FOREIGN KEY (`ISBN`) REFERENCES book_copies(`ISBN`)
)ENGINE InnoDB DEFAULT CHARSET=utf8;