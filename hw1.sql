USE hw1;

CREATE TABLE if NOT EXISTS users (
    id integer primary key auto_increment,
    username varchar(16) not null unique,
    password varchar(255) not null,
    email varchar(255) not null unique,
    name varchar(255) not null,
    surname varchar(255) not null
) Engine = INNODB;

CREATE TABLE IF NOT EXISTS carrello (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    prodotto_id INT NOT NULL,
    nome VARCHAR(255),
    prezzo DECIMAL(10,2),
    
    
    img VARCHAR(255),
    quantità INT,
    FOREIGN KEY (user_id) REFERENCES users(id)
)Engine = INNODB;


CREATE TABLE IF NOT EXISTS prodotti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    prezzo DECIMAL(10,2) NOT NULL,
    immagine VARCHAR(255) NOT NULL
);
INSERT INTO prodotti (nome, prezzo, immagine) VALUES
('iPhone 15 Pro', 1299.00, 'iphone16.jpg'),
('MacBook Air M2', 1499.00, 'mac.jpg'),
('iPad Pro 11"', 1099.00, 'images/ipadpro11.png'),
('Apple Watch Series 9', 499.00, 'watch.jpg'),
('AirPods Pro', 299.00, 'images/airpodspro.png'),
('Apple TV 4K', 199.00, 'images/appletv4k.png');
