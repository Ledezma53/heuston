CREATE TABLE producto(
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    fecha_caducidad DATE NOT NULL,
    imagen VARCHAR(255) NOT NULL,
    categoria VARCHAR(100),
    stock INT
); 