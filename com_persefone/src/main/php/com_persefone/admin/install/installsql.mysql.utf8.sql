CREATE TABLE IF NOT EXISTS `#__pers_usuarios_perfil` ( 
	`id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT, 
	`id_usuario` int not null,
	`id_contact` varchar(255),
	`id_lead` varchar(255),
	`id_target` varchar(255),
	`id_usuario_criador` int not null,
	`id_usuario_alterador` int null,
	`data_criacao` int not null,
	`data_alteracao` datetime null,
	`tip_sinc_crm` enum('E','A') DEFAULT 'E',
	`data_ultima_atualizao_crm` datetime null,
	
	FOREIGN KEY (`id_usuario`) REFERENCES #__users(id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;
	
	
CREATE TABLE IF NOT EXISTS `#__pers_paginas_acessadas` ( 
	`id` int primery key auto_increment
	`id_sessa`	varchar(20) not null
	`pagina` varchar(255) not null
	`data` datetime not null
	`titulo` varchar(255)
	`id_contat` int
	`id_target_list_newsletters`
) ENGINE = InnoDB DEFAULT CHARSET=utf8;
	
	
CREATE TABLE IF NOT EXISTS `#__pers_contato` ( 
	`id int primery key auto_increment
	`id_contact varchar(255)
	`id_account varchar(255)
	`id_historia varchar(255)
	`status char(2)
	`id_area int not null
	`mensagem text not null
) ENGINE = InnoDB DEFAULT CHARSET=utf8;
	
	
CREATE TABLE IF NOT EXISTS `#__pers_targetlist_newsletters` ( 
	`id int primery key auto_increment
	`data datetime not null
	`e-mail vachar(255)
	`nome varchar (100)
	`sobrenome varchar (100)
	`telephone varchar(100)
	`id_target varchar(255) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET=utf8;
	
	
CREATE TABLE IF NOT EXISTS `#__pers_assuntos_newsletterscrm` ( 
	`id_targetlist_crm varchar(255) PRIMAEY KEY
	`titul	`vachar(255)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;
	
	
CREATE TABLE IF NOT EXISTS `#__pers_areas` ( 
	`id int primery key auto_increment
	`nome varchar(50) not null
	`descrica	`text
) ENGINE = InnoDB DEFAULT CHARSET=utf8;
	
	
CREATE TABLE IF NOT EXISTS `#__pers_assuntos_newsletters` ( 
	`id int primery key auto_increment
	`id_targetlist
	`titulo` varchar(255)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;
	
	
CREATE TABLE IF NOT EXISTS `#__pers_area_perfil` ( 
	`Id_area int not null
	`Id_perfil int
	`Id_usuario_crm varchar(255)
	`suporte char(1)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;