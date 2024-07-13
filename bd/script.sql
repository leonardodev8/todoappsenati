CREATE DATABASE todolist
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

use todolist;

create table usuarios(
	idusuario		int auto_increment not null,
    nombre			varchar(50) not null,
    apellido		varchar(50) not null,
    usuario			varchar(20) not null,
    clave			varchar(20) not null,
    activo			char(1) not null,  -- 0 -> Usuario es dado de baja, 1 -> Usuario esta activo
    constraint pk_idusuario primary key(idusuario),
    constraint uk_usuario unique(usuario)
);

select * from usuarios;

insert into usuarios (nombre, apellido, usuario, clave, activo)
values ("Leonardo","Buleje","leonardo","1234",1);

create table todos(
	idtodo			int auto_increment not null,
    descripcion		varchar(200) not null,
    fechacrea		datetime not null,
    estado			char(1) not null,      -- P = Pendiente, F = Finalizado, E = Eliminado
	idusuario		int not null,
    constraint pk_idtodo primary key(idtodo),
    constraint fk_idusuario_tod foreign key(idusuario) references usuarios(idusuario)
);

select * from todos;

insert into todos (descripcion, fechacrea, estado, idusuario)
values ("Conectar mi proyecto Todolist a mi BD usando PDO", now(), "P", 1);

DELIMITER $$
CREATE PROCEDURE login_usuario
(
	IN _usuario VARCHAR(20),
    IN _clave VARCHAR(20)
)
BEGIN
	SELECT * FROM usuarios
    WHERE usuario = _usuario AND clave = _clave AND activo = 1;
END
$$

call login_usuario("leonardo","1234");

DELIMITER $$
CREATE PROCEDURE listar_todolist()
BEGIN
	SELECT tod.idtodo, tod.descripcion, tod.fechacrea, tod.estado, 
	usu.idusuario, usu.nombre, usu.apellido, usu.usuario
	FROM todos tod
	INNER JOIN usuarios usu ON usu.idusuario = tod.idusuario
	WHERE tod.estado != 'E'
	ORDER BY tod.estado DESC, tod.fechacrea DESC;
END
$$

call listar_todolist();

DELIMITER $$
CREATE PROCEDURE registrar_todolist
(
	IN _descripcion VARCHAR(200),
    IN _idusuario INT
)
BEGIN
	INSERT INTO todos (descripcion, fechacrea, estado, idusuario)
	VALUES (_descripcion, now(), "P", _idusuario);
END
$$

call registrar_todolist("Crear entidades y modelos para la tabla usuario y todos",1);

DELIMITER $$
CREATE PROCEDURE finalizar_todolist
(
	IN _idtodo INT
)
BEGIN
	UPDATE todos SET
		estado = "F"
	WHERE idtodo = _idtodo;
END
$$

call finalizar_todolist(1);

DELIMITER $$
CREATE PROCEDURE eliminar_todolist
(
	IN _idtodo INT
)
BEGIN
	UPDATE todos SET
		estado = "E"
	WHERE idtodo = _idtodo;
END
$$





