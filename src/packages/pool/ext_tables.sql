CREATE TABLE tx_pool_domain_model_game (
    player1 int(10) unsigned DEFAULT '0' NOT NULL,
    player2 int(10) unsigned DEFAULT '0' NOT NULL,
    winner int(10) unsigned DEFAULT '0' NOT NULL
);

CREATE TABLE tx_pool_domain_model_player (
    name varchar(255) DEFAULT '' NOT NULL,
    email varchar(255) DEFAULT '' NOT NULL
);
