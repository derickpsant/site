create database alimentobd;
use alimentobd;

CREATE TABLE votacao (
  id int not null AUTO_INCREMENT primary key,
  nome varchar(255) not null,
  periodo varchar(15) not null,
  opcao varchar(3) DEFAULT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
create table total_votos(
	id int not null primary key auto_increment,
	manha int not null default 0,
	tarde int not null default 0,
    noite int not null default 0
);
SHOW GRANTS FOR 'root'@'localhost';
GRANT ALL PRIVILEGES ON alimentobd.* TO 'root'@'localhost';
FLUSH PRIVILEGES;
DELIMITER //
CREATE EVENT LimparVotacoesDiariamente
ON SCHEDULE EVERY 1 DAY
STARTS CURRENT_TIMESTAMP
DO
BEGIN
    DELETE FROM votacao WHERE DATE_FORMAT(CURRENT_TIMESTAMP(), '%Y-%m-%d') != DATE_FORMAT(createdAt, '%Y-%m-%d');
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER atualizar_votos AFTER INSERT ON votacao
FOR EACH ROW
BEGIN
   IF NEW.periodo = 'manhã' THEN
           INSERT INTO total_votos (manha) VALUES (1) ON DUPLICATE KEY UPDATE manha = manha + 1;
    ELSEIF NEW.periodo = 'tarde' THEN
        INSERT INTO total_votos (tarde) VALUES (1) ON DUPLICATE KEY UPDATE tarde = tarde + 1;
    ELSE
        INSERT INTO total_votos (noite) VALUES (1) ON DUPLICATE KEY UPDATE noite = noite + 1;
    END IF;
END;
//
DELIMITER ;