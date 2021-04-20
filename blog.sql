create database BLOG charset utf8; 
use BLOG;
create table if not exists b_user( 
	--用户表
	id int primary key auto_increment, --主键
	u_username varchar(10) not null unique, --用户名，不可重复
	u_password char(32) not null, --密码，使用md5加密
	u_reg_time int unsigned not null, --注册时间戳
	u_is_admin tinyint not null default 0 --管理员身份，0表示普通用户，1表示管理员
)charset utf8;
insert into b_user values(null, 'admin', md5('admin'),unix_timestamp(),1); --管理员
insert into b_user values(null, 'user', md5('user'),unix_timestamp(),0); --普通用户

use BLOG;
create table if not exists b_category(
	--分类表
	id int primary key auto_increment, --逻辑主键
	c_name varchar(10) not null, --分类名
	c_sort int unsigned default 0, --排序
	c_parent_id int unsigned default 0, --上级分类id，顶级id为0
	unique key(c_name, c_parent_id) 
)charset utf8;
insert into b_category values(1, 'IT技术', 0, 0), (2, '电子商务', 0, 0), (3, '影视', 0, 0), 
	(4, 'PHP', 0, 1), (5, '面向对象', 0, 4), (6, 'MVC框架', 0, 4);

use BLOG;
create table if not exists b_article(
	--博文表
	id int primary key auto_increment, --逻辑主键
	a_title varchar(20) not null, --文章名
	a_content text not null, --文章内容
	c_id int not null, --分类id
	u_id int not null, --作者id
	a_author varchar(10) not null, --作者名
	a_time int unsigned not null, --发表时间
	a_status tinyint default 1 comment '1=草稿，2=公开，3=隐藏', --文章状态
	a_topped tinyint default 1 comment '1=不置顶，2=置顶', --是否置顶
	a_img varchar(50), --封面图
	a_img_thumb varchar(50), --缩略图名
	a_is_delete tinyint default 0 comment '0=正常，1=文章被删除' --文章存在状态
)charset utf8;

use BLOG;
create table if not exists b_comment(
	--评论表
	id int primary key auto_increment, --逻辑主键
	c_comment text not null, --评论内容	
	c_time int unsigned not null, --发表时间
	u_id int unsigned not null, --评论用户id
	a_id int unsigned not null --博文id
)charset utf8;
