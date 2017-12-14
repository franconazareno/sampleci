# Sample PHP Code Igniter RestAPI
Sample App for PHP CodeIgniter

This sample project uses Chris Kacerguis [CodeIgniter Rest Server](https://github.com/chriskacerguis/codeigniter-restserver)

#### Requirements:
1. Apache (2.4.27)
2. MySQL (5.6.23)
3. PHP (5.6.30)
4. CodeIgniter (3.x)


#### AMP Setup:
Helpful links:

[Installing Apache, PHP, and MySQL](https://jason.pureconcepts.net/2016/09/install-apache-php-mysql-mac-os-x-sierra/)

[Setup Apache, MySQL and PHP using Homebrew](https://lukearmstrong.github.io/2016/12/setup-apache-mysql-php-homebrew-macos-sierra/)


#### CodeIgniter
[CodeIgnter Download](https://codeigniter.com/download)


#### MySQL Setup:
Create the schema, user and table

````
CREATE SCHEMA `testci` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
CREATE USER 'testci'@'localhost' IDENTIFIED BY 'testci!';
GRANT ALL PRIVILEGES ON *.* TO 'testci'@'localhost';
FLUSH PRIVILEGES;
CREATE TABLE `user` (
  `u_seq` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '���� Ű',
  `u_id` varchar(50) DEFAULT NULL COMMENT '���� �̸���',
  `u_name` varchar(30) DEFAULT NULL COMMENT '���� �̸�',
  `u_phone` varchar(20) DEFAULT NULL COMMENT '���� ��ȭ��ȣ',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '�����',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '�����ð�',
  PRIMARY KEY (`u_seq`),
  KEY `u_id-index` (`u_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='���� ���̺�';
````

