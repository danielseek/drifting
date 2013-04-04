 --natty CMS database schema
SET NAMES 'utf8'
--aritcle
CREATE TABLE `article_cs`
{
`id` int unsigned PRIMARY KEY AUTO INCREMENT,
`user_id` int unsigned comment 'reference to author, user->id',
    CONSTRAINT `article_user_fk` FOREIGN KEY (`user_id`) 
    REFERENCES `user` (`id`),
`category_id` int unsigned comment  'reference to category->id',
    CONSTRAINT `article_articlecategory_fk` FOREIGN KEY (`category_id`) 
    REFERENCES `articlecategory` (`id`)
`created` timestamp DEFAULT CURRENT_TIMESTAMP,

`hits` int unsigned

`created` timestamp DEFAULT CURRENT_TIMESTAMP,

`headline` varchar(255),
`introtext` mediumtext,
`fulltext` mediumtext
}
CREATE TABLE `articlecategory`
{
`id` int unsigned PRIMARY KEY AUTO INCREMENT,
`title` varchar(200),
}
--language
CREATE TABLE `language`
{
`code` varchar(6) PRIMARY KEY,
`title` varchar(50),
`collation` varchar(
`default` int int(1) unsigned
}

--user
CREATE TABLE `user`
{
`id` int unsigned PRIMARY KEY AUTO INCREMENT,
`login` varchar(100),
`passw` varchar(100)
}
CREATE TABLE `usergroup`
{
`id` int unsigned PRIMARY KEY AUTO INCREMENT,
`parent_id` int unsigned,
}
