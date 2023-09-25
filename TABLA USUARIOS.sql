TABLA USUARIOS

CREATE TABLE usuarios (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  nombre_usuario varchar(45) NOT NULL,
  clave varchar(255) NOT NULL,
  nombre varchar(200) NOT NULL,
  apellido varchar(200) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY usuario (nombre_usuario)
) ENGINE=InnoDB;


TABLA TAREAS

CREATE TABLE tareas (
  id INT AUTO_INCREMENT,
  tarea VARCHAR(255),
  completado TINYINT,
  PRIMARY KEY (id)
);