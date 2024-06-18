CREATE TABLE tx_tea_domain_model_tea (
    id varchar(255) DEFAULT '' NOT NULL,
    title varchar(255) DEFAULT '' NOT NULL,
    description text,
    brand int(10) unsigned DEFAULT '0' NOT NULL,
    image int(1) unsigned DEFAULT '0' NOT NULL
);

CREATE TABLE tx_tea_domain_model_brand (
    title varchar(255) DEFAULT '' NOT NULL
);
