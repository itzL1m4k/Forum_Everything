CREATE DATABASE ITForum_L;

USE ITForum_L;

CREATE TABLE uzytkownicy (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  nickname VARCHAR(255),
  email VARCHAR(255),
  haslo VARCHAR(255),
  data_publikacji TIMESTAMP DEFAULT CURRENT_TIMESTAMP()
);
CREATE TABLE wpisy (
  id INT AUTO_INCREMENT PRIMARY KEY,
  autor_id INT,
  tytul VARCHAR(255),
  tresc TEXT,
  obrazek LONGBLOB,
  data_publikacji TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
  FOREIGN KEY (autor_id) REFERENCES uzytkownicy(user_id)
);
CREATE TABLE komentarze (
  id INT AUTO_INCREMENT PRIMARY KEY,
  autor_id INT,
  wpis_id INT,
  tresc TEXT,
  data_publikacji TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
  FOREIGN KEY (autor_id) REFERENCES uzytkownicy(user_id),
  FOREIGN KEY (wpis_id) REFERENCES wpisy(id)
);
