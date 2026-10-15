USE exercices;

CREATE TABLE cours (
id INT AUTO_INCREMENT PRIMARY KEY,
jour VARCHAR(20) NOT NULL,
heure INT NOT NULL,
matiere VARCHAR(50) NOT NULL
);

INSERT INTO cours (jour, heure, matiere) VALUES
('lundi', 8, 'Maths'), ('lundi', 10, 'PHP'),
('mardi', 8, 'Anglais'), ('mardi', 14, 'PHP'),
('mercredi', 10, 'Réseaux'),
('jeudi', 8, 'PHP'), ('jeudi', 14, 'Maths'),
('vendredi', 10, 'Anglais');