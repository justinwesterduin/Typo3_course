CREATE TABLE be_users (
    nickname varchar(255) DEFAULT '' NOT NULL,
    email2 varchar(255) DEFAULT '' NOT NULL
);

CREATE TABLE tt_content (
    companyname varchar(255) DEFAULT '' NOT NULL,
    address varchar(255) DEFAULT '' NOT NULL,
    zipcode varchar(6) DEFAULT '' NOT NULL,
    cityname varchar(255) DEFAULT '' NOT NULL,
    email varchar(255) DEFAULT '' NOT NULL,
    phone varchar(25) DEFAULT '' NOT NULL,
    extrainfo mediumtext,
    socials varchar(255) DEFAULT '' NOT NULL
);

CREATE TABLE tx_mysitepackage_customcontact_socials (
    uid INT(11) NOT NULL auto_increment,
    pid INT(11) DEFAULT '0' NOT NULL,
    foreign_table VARCHAR(255) DEFAULT '' NOT NULL,
    foreign_uid INT(11) DEFAULT '0' NOT NULL,
    foreign_title VARCHAR(255) DEFAULT '' NOT NULL,
    socials_name VARCHAR(255) DEFAULT '' NOT NULL,
    socials_link VARCHAR(255) DEFAULT '' NOT NULL,
    PRIMARY KEY (uid),
    KEY parent (pid)
);
