CREATE DATABASE Go2event_DB;
USE Go2event_DB;

CREATE TABLE categories(

	id_category int unsigned auto_increment,
	name_category varchar(50),
	constraint pk_categories primary key (id_category)
	
);

CREATE TABLE events(

	id_event int unsigned auto_increment,
	name_event varchar(50),
	description varchar(300),
	img_path varchar(200),
	id_category int unsigned,
	constraint pk_events primary key (id_event),
	constraint fk_events_categories foreign key (id_category) references categories (id_category)
);

CREATE TABLE venues(

	id_venue int unsigned auto_increment,
	name_venue varchar(70),
	address varchar(50),
	city varchar(50),
	capacityLimit int unsigned,
	constraint pk_venues primary key (id_venue)
	
);

CREATE TABLE seattypes(

	id_seattype int unsigned auto_increment,
	name_seattype varchar(50),
	description varchar (80),
	constraint pk_seattypes primary key (id_seattype)
	
);
CREATE TABLE artists(

	id_artist int unsigned auto_increment,
	name_artist varchar(50),
	description varchar (80),
	constraint pk_id_artist primary key (id_artist)
	
);

CREATE TABLE calendars(

	id_calendar int unsigned auto_increment,
	date_calendar datetime,
	img_path varchar(200),
	id_venue int unsigned,
	id_event int unsigned,
	constraint pk_calendars primary key (id_calendar),
	constraint fk_calendars_venues foreign key (id_venue) references venues (id_venue),
	constraint fk_calendars_events foreign key (id_event) references events (id_event)
);

CREATE TABLE artists_x_calendar(

	id_artist int unsigned,
	id_calendar int unsigned,
	constraint pk_artists_x_calendar primary key (id_artist, id_calendar),
	constraint fk_artists_x_calendar_artists foreign key (id_artist) references artists (id_artist),
	constraint fk_artists_x_calendar_calendar foreign key (id_calendar) references calendars (id_calendar)
);

CREATE TABLE seats(

	id_seat int unsigned auto_increment,
	quant int unsigned,
	price float,
	remaining int unsigned,
	id_seattype int unsigned,
	id_calendar int unsigned,
	constraint pk_seats primary key (id_seat),
	constraint fk_seats_calendars foreign key (id_calendar) references calendars (id_calendar),
	constraint fk_seats_seattypes foreign key (id_seattype) references seattypes (id_seattype)
);

CREATE TABLE clients(
	id_client int unsigned auto_increment,
	email varchar(80),
	name varchar(50),
	surname varchar(50),
	pass varchar(200),
	is_admin boolean,
	constraint pk_clients primary key (id_client),
	constraint unq_clients unique (email)
);

CREATE TABLE purchases(
	id_purchase int unsigned auto_increment,
	date_purchase datetime,
	id_client int unsigned,
	constraint pk_purchase primary key (id_purchase),
	constraint fk_purchase_client foreign key (id_client) references clients(id_client)
	
);
CREATE TABLE purchase_items(
	id_purchase_item int unsigned auto_increment,
	quantity int unsigned,
	price float,
	id_purchase int unsigned,
	constraint pk_purchase_item primary key (id_purchase_item),
	constraint fk_purchase_item_purchase foreign key (id_purchase) references purchases (id_purchase)

);
CREATE TABLE tickets(
	id_ticket int unsigned auto_increment,
	number_ticket bigint unsigned,
	qr varchar(200),
	id_purchase_item int unsigned,
	constraint pk_tickets primary key (id_ticket),
	constraint fk_tickets_purchase_item foreign key (id_purchase_item) references purchase_items(id_purchase_item)

);

CREATE TABLE admins(
	id_admin int unsigned auto_increment,
	email varchar(80),
	name varchar(50),
	surname varchar(50),
	pass varchar(200),
	is_admin boolean,
	constraint pk_admins primary key (id_admin),
	constraint unq_admins unique (email)
);

DROP PROCEDURE IF EXISTS isAdmin;
DELIMITER $$
CREATE PROCEDURE isAdmin(in hashedPass varchar(200), OUT isAdmin boolean)
BEGIN
	SELECT
		c.is_admin INTO isAdmin
	FROM
		clients c
	WHERE
		c.pass = hashedPass;
END $$
DELIMITER ;


SELECT
		c.is_admin
	FROM
		clients c
	WHERE
		c.pass = "$2y$10$LoXVkSa62nQTtvTnfQN9EudP25rpfPxWvhubr2lErJo7z70AdSQui";

SELECT
		c.is_admin
	FROM
		clients c
	WHERE
		c.pass = "$2y$10$mrG95dhyFQchG7BhL7ya5u.7goe0W.YJU/etqmb3bZXVT6BWYrDTu";