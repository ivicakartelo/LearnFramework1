CREATE DATABASE blog1;
USE blog1;
CREATE TABLE menu (
  menu_id int AUTO_INCREMENT PRIMARY KEY,
  heading varchar(100),
  content text,
  published date,
  pic varchar(100) NULL,
  views_counter int
);
CREATE TABLE comments (
    comment_id int AUTO_INCREMENT PRIMARY KEY,
    menu_id int,
    CONSTRAINT menuid
    FOREIGN KEY (menu_id)
    REFERENCES menu(menu_id)
    ON DELETE CASCADE ON UPDATE CASCADE,
    nickname varchar(100) NOT NULL,
    content text NOT NULL,
    published date NOT NULL,
    approved bit DEFAULT 0
);
