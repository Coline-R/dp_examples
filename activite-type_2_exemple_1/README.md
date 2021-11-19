# TP

## Script SQL

### Création de la base de données

Pour créer la base de données :

```
CREATE DATABASE formation_tp;
```

### Création de table - Expériences

Pour créer la table experiences :

```
CREATE TABLE experiences(
    id INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(255),
    date DATE,
    description TEXT
);
```

### Création de table - Contact

Pour créer la table contact :

```
CREATE TABLE contact(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255),
    sujet VARCHAR(255),
    email VARCHAR(255),
    message TEXT
);
```

### Insertion de données - Table experiences

Exemple de requête pour insérer des données dans la table experiences :

```
INSERT INTO experiences (titre, date, description)
VALUES
('Experience 1','2008-05-12', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Deserunt laudantium laboriosam totam doloremque. Earum odit, rem quisquam debitis expedita at ducimus nemo perferendis assumenda! Laudantium perferendis enim voluptates dolores mollitia labore!'),
('Experience 2','2009-07-17', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Deserunt laudantium laboriosam totam doloremque. Earum odit, rem quisquam debitis expedita at ducimus nemo perferendis assumenda! Laudantium perferendis enim voluptates dolores mollitia labore!'),
('Experience 3','2005-12-11', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Deserunt laudantium laboriosam totam doloremque. Earum odit, rem quisquam debitis expedita at ducimus nemo perferendis assumenda! Laudantium perferendis enim voluptates dolores mollitia labore!'),
('Experience 4','2012-01-23', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Deserunt laudantium laboriosam totam doloremque. Earum odit, rem quisquam debitis expedita at ducimus nemo perferendis assumenda! Laudantium perferendis enim voluptates dolores mollitia labore!');

```