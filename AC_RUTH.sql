CREATE DATABASE IF NOT EXISTS gestor_tiempo;
USE gestor_tiempo;

CREATE TABLE IF NOT EXISTS tareas (
id_tarea INT NOT NULL auto_increment PRIMARY KEY,
titulo varchar(150) NOT NULL,
descripcion varchar(500),
estado enum('urgente', 'pendiente', 'en proceso', 'finalizado'),
fecha timestamp DEFAULT CURRENT_TIMESTAMP,
fecha_inicio DATE,
fecha_finalizacion DATE  
);
SELECT estado, COUNT(id_tarea) AS total
FROM tareas
GROUP BY estado;

SELECT * FROM tareas; 

alter table tareas
add column id_usuario int NOT NULL DEFAULT 1;

CREATE TABLE usuarios (
id_usuario int NOT NULL auto_increment primary key,
usuario VARCHAR(50) not null,
nombre VARCHAR(50) not null,
apellidos VARCHAR(50) not null,
email varchar(100),
telefono varchar(13),
password varchar(255) NOT NULL
);
SELECT * FROM usuarios; 

INSERT INTO tareas (titulo, descripcion, estado, fecha_inicio, fecha_finalizacion) VALUES ('Evaluación Contínua PHP', 'He de realizar un gestor de tareas con PHP y su bbdd vinculada', 'pendiente', '2025-05-07', '2025-05-13');