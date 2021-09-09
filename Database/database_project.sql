/*Tabela da empresa*/
create table company (
	id int auto_increment not null,/*Chave primária*/
	name varchar(100) not null,/*Nome da empresa*/
	cnpj varchar(14) not null,/*CNPJ da empresa*/
	primary key (id)/*Indicação chave primária*/
);

/*Tabela dos funcionários*/
create table user_register (
	id int auto_increment not null,/*Chave primária*/
	username varchar(20) not null,/*Login do funcionário*/
	password varchar(24) not null,/*Senha do funcionário*/
	name varchar(32) not null,/*Nome do funcionário*/
	cpf varchar (11) not null,/*CPF do funcionário*/
	id_company int, /*Chave estrangeira da empresa*/
	primary key (id), /*Indicação chave primária*/
	foreign key (id_company) references company(id)/*Chave estrangeira da empresa*/
);

/*Tabela do fornecedor*/
create table supplier (
	id int auto_increment not null, /*Chave primária*/
	name varchar(32) not null,/*Nome do fornecedor*/
	cnpj varchar(14) not null,/*CNPJ do fornecedor*/
	primary key (id)/*Indicação chave primária*/
);

/*Tabela da movimentação*/
create table movement (
	id int auto_increment not null,/*Chave primária*/
	id_user_register int, /*Chave estraneira do funcionário*/
	id_supplier int, /*Chave estrangeira do fornecedor*/
	`date` date not null, /*Data da movimentação*/
	amout int not null,/*Quantidade da movimentaçãp*/
	`type` tinyint not null check (`type` in (1,2,3)),/*Tipo da movimentação*/
	value decimal(10,2) not null,/*Valor da movimentaçao*/
	id_product int, /*Chave estrangeira do produto*/
	primary key (id), /*Indicação chave prinária*/
	foreign key (id_product) references product(id), /*Indicação da chave estrangeira do produto*/
	foreign key (id_user_register) references user_register(id),/*Indicação da chave estrangeira do funcionário*/
	foreign key (id_supplier) references supplier(id)/*Indicação da chave estrangeira do fornecedor*/
);

/*Tabela do produto*/
create table product (
	id int auto_increment not null,/*Chave primária*/
	name varchar(32) not null,/*Nome do produto*/
	ncm varchar(8) not null,/*NCM do produto*/
	amount int not null,/*Quantidade do produto*/
	metric varchar(12) not null,/*Unidade métrica do produto*/
	average_cost decimal(10,2) not null,/*Custo médio do produto*/
	primary key (id)/*Indicação da chave primária*/
);


