
CREATE TABLE film (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(200) NOT NULL,
    date_sortie DATE,
    genre ENUM(
        'Action',
        'Aventure',
        'Comédie',
        'Drame',
        'Science-fiction',
        'Fantastique',
        'Horreur',
        'Thriller',
        'Policier',
        'Romance',
        'Animation',
        'Documentaire'
    ) NOT NULL,
    auteur VARCHAR(200)
);


CREATE TABLE diffusion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    film_id INT NOT NULL,
    date_diffusion DATE NOT NULL,

    CONSTRAINT fk_diffusion_film
        FOREIGN KEY (film_id)
        REFERENCES film(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);
