CREATE DATABASE restaurante;

use restaurante;

CREATE TABLE clientes (
    dni CHARACTER(20),
    nombre CHARACTER(50),
    apellidos CHARACTER(50),
    telefono int,
    num_reserva int,
    hora_reserva time,
    dia_reserva date,
    CONSTRAINT pk_alumnos PRIMARY KEY(dni)
);

CREATE TABLE usuarios (
    id int AUTO_INCREMENT,
    nombre CHARACTER(50),
    apellido CHARACTER(50),
    CONSTRAINT pk_usuarios PRIMARY KEY(id)
);

CREATE TABLE mesas (
    id int AUTO_INCREMENT,
    tamaño int,
    CONSTRAINT pk_mesas PRIMARY KEY(id)
);

CREATE TABLE cliente_mesa (
    id int AUTO_INCREMENT,
    idcliente CHARACTER(20),
    idmesa int,
    CONSTRAINT pk_cliente_mesa PRIMARY KEY(id),
    CONSTRAINT fk_clientes FOREIGN KEY(idcliente) REFERENCES clientes(dni),
    CONSTRAINT fk_mesas FOREIGN KEY(idmesa) REFERENCES mesas(id)
);