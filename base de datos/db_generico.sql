CREATE DATABASE db_generico

CREATE TABLE rol(id_rol INT NOT null PRIMARY KEY AUTO_INCREMENT,rol varchar(20)not null);

CREATE TABLE usuario(id_usuario int not null PRIMARY KEY AUTO_INCREMENT,
usuario varchar(30) not null,contraseña varchar(30)not null,estado int not null,
id_rol int not null,FOREIGN KEY(id_rol) REFERENCES rol(id_rol));


-----------------insertando roles---------------------------------
INSERT into rol VALUES(0,'administrador');
INSERT into rol VALUES(0,'empleado');
-------------------insertando usuario y crontraseña--------------
INSERT INTO usuario VALUES(0,'admin','123',1,1);
INSERT INTO usuario VALUES(0,'user','1234',1,2);