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


