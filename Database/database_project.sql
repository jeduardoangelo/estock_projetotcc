create table company (
	id int auto_increment not null,
	name varchar(100) not null,
	cnpj varchar(14) not null,
	primary key (id)
);

create table user_register (
	id int auto_increment not null,
	username varchar(20) not null,
	password varchar(24) not null,
	name varchar(32) not null,
	cpf varchar (11) not null,
	id_company int,
	primary key (id),
	foreign key (id_company) references company(id)
);

create table product (
	id int auto_increment not null,
	name varchar(32) not null,
	ncm varchar(8) not null,
	amount int not null,
	metric varchar(12) not null,
	average_cost decimal(10,2) not null,
	primary key (id)
);

create table supplier (
	id int auto_increment not null,
	name varchar(32) not null,
	cnpj varchar(14) not null,
	primary key (id)
);

create table movement (
	id int auto_increment not null,
	`date` date not null,
	amout int not null,
	`type` tinyint not null check (`type` in (1,2,3)),
	value decimal(10,2) not null,
	id_product int,
	primary key (id),
	foreign key (id_product) references company(id)
);


