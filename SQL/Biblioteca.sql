create database Biblioteca;
use Biblioteca;

create table Usuarios(
                         numeroSocio int primary key auto_increment,
                         DNI varchar(9) not null unique,
                         nombre varchar(100),
                         apellidos varchar(100),
                         direccion varchar(100),
                         email varchar(100),
                         telefono int(9),
                         contraseña varchar(100),
                         rol varchar(20) default 'lector'
);

create table Libros(
                       ISBN bigint primary key unique not null,
                       titulo varchar(255) not null,
                       autor varchar(255) not null,
                       editorial varchar(255) not null,
                       fechaPublicacion date,
                       estado varchar(255)
);

create table Stock(
                      idLibro int primary key auto_increment,
                      ISBN bigint not null,
                      estado varchar(255),
                      cantidad int not null,
                      foreign key (ISBN)references Libros(ISBN)
);

create table Prestamos(
                          idPrestamo int auto_increment primary key,
                          socio int not null,
                          idLibro int not null,
                          inicio date,
                          devolucion date,
                          estado varchar(255),
                          foreign key (socio) references Usuarios(numeroSocio),
                          foreign key (idLibro) references Stock(idLibro)
);

create table Devoluciones(
                             idDevolucion int auto_increment primary key,
                             socio int not null,
                             ISBN bigint not null,
                             fecha date,
                             estado varchar(255),
                             foreign key (socio) references Usuarios(numeroSocio),
                             foreign key (ISBN) references Libros(ISBN)
);

INSERT INTO Libros (ISBN, titulo, autor, editorial, fechaPublicacion, estado) VALUES
                                                                                  (9781234567890, 'El Quijote', 'Miguel de Cervantes', 'Editorial Cervantes', '1605-01-16', 'Disponible'),
                                                                                  (9782345678901, 'Cien Años de Soledad', 'Gabriel García Márquez', 'Editorial Sudamericana', '1967-06-05', 'Disponible'),
                                                                                  (9783456789012, 'Donde los árboles cantan', 'Laura Gallego', 'Editorial SM', '2011-10-14', 'Disponible'),
                                                                                  (9784567890123, '1984', 'George Orwell', 'Secker & Warburg', '1949-06-08', 'Disponible'),
                                                                                  (9785678901234, 'El Hobbit', 'J.R.R. Tolkien', 'Allen & Unwin', '1937-09-21', 'Disponible');

INSERT INTO Stock (ISBN, estado, cantidad) VALUES
                                               (9781234567890, 'Nuevo', 5),
                                               (9782345678901, 'Nuevo', 3),
                                               (9783456789012, 'Nuevo', 4),
                                               (9784567890123, 'Nuevo', 6),
                                               (9785678901234, 'Nuevo', 2);

INSERT INTO Usuarios (DNI, nombre, apellidos, direccion, email, telefono, contraseña, rol)
VALUES
    ('11223344L', 'Bibliotecario', 'Admin', 'Calle ancha', 'bibliotecario@biblioteca.com', '648597542', 'Biblioteca123', 'bibliotecario');
update usuarios set rol = 'bibliotecario' where numeroSocio = 1;