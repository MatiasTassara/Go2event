CREATE DATABASE Go2event_DB;
USE Go2event_DB;

CREATE TABLE categories(

	id_category int unsigned auto_increment,
	name_category varchar(50),
	active int unsigned,
	constraint pk_categories primary key (id_category)
	
);

CREATE TABLE events(

	id_event int unsigned auto_increment,
	name_event varchar(50),
	description varchar(1400),
	img_path varchar(200),
	id_category int unsigned,
	active int unsigned,
	constraint pk_events primary key (id_event),
	constraint fk_events_categories foreign key (id_category) references categories (id_category)
);

CREATE TABLE venues(

	id_venue int unsigned auto_increment,
	name_venue varchar(70),
	address varchar(50),
	city varchar(50),
	capacityLimit int unsigned,
	active int unsigned,
	constraint pk_venues primary key (id_venue)
	
);

CREATE TABLE seattypes(

	id_seattype int unsigned auto_increment,
	name_seattype varchar(50),
	description varchar (80),
	active int unsigned,
	constraint pk_seattypes primary key (id_seattype)
	
);
CREATE TABLE artists(

	id_artist int unsigned auto_increment,
	name_artist varchar(50),
	description varchar (400),
	active int unsigned,
	constraint pk_id_artist primary key (id_artist)
	
);

CREATE TABLE calendars(

	id_calendar int unsigned auto_increment,
	date_calendar datetime,
	img_path varchar(200),
	id_venue int unsigned,
	id_event int unsigned,
	active int unsigned,
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
	active int unsigned,
	constraint pk_seats primary key (id_seat),
	constraint fk_seats_calendars foreign key (id_calendar) references calendars (id_calendar),
	constraint fk_seats_seattypes foreign key (id_seattype) references seattypes (id_seattype)
);

CREATE TABLE roles(
	id_role  int unsigned auto_increment,
	name_role varchar (20),
	constraint pk_roles primary key (id_role)
);
INSERT INTO roles (name_role) values ('admin'), ('client'),('unsuscribed');

CREATE TABLE users(
	id_user int unsigned auto_increment,
	id_role int unsigned,
	email varchar(80),
	name varchar(50),
	surname varchar(50),
	pass varchar(200),
	constraint pk_users primary key (id_user),
	constraint unq_user unique (email),
	constraint fk_users_rol foreign key (id_role) references roles (id_role)
);

CREATE TABLE purchases(
	id_purchase int unsigned auto_increment,
	date_purchase datetime,
	id_user int unsigned,
	constraint pk_purchase primary key (id_purchase),
	constraint fk_purchase_user foreign key (id_user) references users(id_user)
	
);
CREATE TABLE purchase_items(
	id_purchase_item int unsigned auto_increment,
	quantity int unsigned,
	price float,
	id_purchase int unsigned,
	id_seat int unsigned,
	constraint pk_purchase_item primary key (id_purchase_item),
	constraint fk_purchase_item_purchase foreign key (id_purchase) references purchases (id_purchase),
	constraint fk_purchase_item_seat foreign key (id_seat) references seats (id_seat)

);
CREATE TABLE tickets(
	id_ticket int unsigned auto_increment,
	number_ticket bigint unsigned,
	qr varbinary(500),
	id_purchase_item int unsigned,
	constraint pk_tickets primary key (id_ticket),
	constraint fk_tickets_purchase_item foreign key (id_purchase_item) references purchase_items(id_purchase_item)

);

INSERT INTO users(id_role,email,name,surname,pass)
	VALUES 	(1,"admin@admin","Root","Casi Master of the Universe","$2y$10$LoXVkSa62nQTtvTnfQN9EudP25rpfPxWvhubr2lErJo7z70AdSQui"),
			(2,"cliente@cliente","Simple","Peasant","$2y$10$mrG95dhyFQchG7BhL7ya5u.7goe0W.YJU/etqmb3bZXVT6BWYrDTu");


SELECT 	p.date as PurchaseDate,
		e.date as EventDate
FROM

WHERE


SELECT s.*  FROM  seats s inner join calendars c on s.id_calendar = c.id_calendar
            where  c.date_calendar BETWEEN date "2018-10-01" AND date "2018-11-30" AND s.active = 1

SELECT
	td2.id_event,
	sum(td2.vendidas) as eventosVendidos
FROM 
	events e inner join 
						(SELECT 
							td.id_calendar, 
							td.vendidas,
							td.id_event	
						FROM 
								(SELECT
									sum(s.quant) - sum(s.remaining) as vendidas,
									c.date_calendar,
									c.id_calendar,
									c.active,
									c.id_event
								FROM 
									seats s INNER JOIN calendars c on s.id_calendar = c.id_calendar
								GROUP BY s.id_calendar) as td on e.id_event = td.id_event
						WHERE td.date_calendar >= now() AND td.active = 1 AND td.vendidas > 0
						GROUP BY td.id_event 
						) as td2
	GROUP BY td2.id_event
ORDER BY eventosVendidos DESC
LIMIT 6



SELECT
	e.id_event,
	e.name_event,
	sum(s.quant) - sum(s.remaining) as vendidas

FROM 
	events e 
	inner join calendars c on e.id_event = c.id_event
	inner join seats s on s.id_calendar = c.id_calendar
group by
	e.id_event
order by
	vendidas desc
limit 6




SELECT
	e.id_event
FROM 
	events e 
	inner join calendars c on e.id_event = c.id_event
	inner join seats s on s.id_calendar = c.id_calendar
group by
	e.id_event
order by
	sum(s.quant) - sum(s.remaining) desc
limit 6	
////////////////////////////////////////////
////////////////////////////////////////////
color para fondo     #f2f2ef





SELECT e.* 
FROM events e inner join calendars c on e.id_event = c.id_event 
inner join seats s on s.id_calendar = c.id_calendar 

group by e.id_event 
having (sum(s.quant) - sum(s.remaining)) > 0 
order by sum(s.quant) - sum(s.remaining) desc