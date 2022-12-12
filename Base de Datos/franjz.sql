DROP DATABASE IF EXISTS franjz;
CREATE DATABASE IF NOT EXISTS  franjz;
USE franjz;

-- Creamos las tablas epicas ;)


-- --------------------------------
-- TABLA TIPO DE USUARIOS
-- --------------------------------

CREATE TABLE usuario_tipo (
    usuario_tipo_id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    tipo VARCHAR(80) NOT NULL

) ENGINE = innoDB;

INSERT INTO usuario_tipo (usuario_tipo_id, tipo)
VALUES (1, 'Admin'),
       (2, 'Comun');

-- --------------------------------
-- TABLA AVATARS USUARIOS
-- --------------------------------

CREATE TABLE avatars (
    avatar_id        INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nombre_avatar    VARCHAR(80) NOT NULL,
    imagen           VARCHAR(80) NOT NULL


) ENGINE = innoDB;

INSERT INTO avatars
VALUES  (1, 'usuario', 'user.png'),
        (2, 'Boba Fett', 'boba.png'),
        (3, 'Baby Yoda', 'baby.png'),
        (4, 'Tony Stark', 'tony.png'),
        (5, 'Thanos', 'thanos.png'),
        (6, 'Rocket', 'rocket.png'),
        (7, 'Darth Vader', 'vader.png'),
        (8, 'General Grievous', 'grievous.png'),
        (9, 'Obi Wan Kenobi', 'obi.png'),
        (10, 'Yoda', 'yoda.png'),
        (11, 'Indiana Jones', 'indi.png'),
        (12, 'Gandalf', 'gandalf.png'),
        (13, 'Kratos', 'kratos.png');


-- --------------------------------
-- TABLA DE USUARIOS
-- --------------------------------

CREATE TABLE usuarios (
    usuario_id       INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nombre           VARCHAR(80) NOT NULL,
    apellido         VARCHAR(80) NOT NULL,
    email            VARCHAR(100) NOT NULL UNIQUE,
    usuario          VARCHAR(60) NOT NULL UNIQUE,
    password         VARCHAR(255) NOT NULL,
    usuario_tipo_id_fk INT UNSIGNED NOT NULL,
    avatar_id_fk       INT UNSIGNED NOT NULL,


    FOREIGN KEY (usuario_tipo_id_fk) REFERENCES usuario_tipo (usuario_tipo_id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (avatar_id_fk) REFERENCES avatars (avatar_id) ON DELETE RESTRICT ON UPDATE CASCADE


) ENGINE = innoDB;

INSERT INTO usuarios
VALUES (1, 'Agustín', 'Zoric', 'francisco.zoric@davinci.com.ar', 'Franj_Z', '$2y$10$5yW1aY2jXnF6Uyg/as83ZOYDPojRhTjyhmJ9nPxf84ZRRywwczHgy', 1, 11),
       (2, 'Jony', 'Jorge', 'jonathan.jorge@davinci.com.ar', 'Jony', '$2y$10$5yW1aY2jXnF6Uyg/as83ZOYDPojRhTjyhmJ9nPxf84ZRRywwczHgy', 2, 1),
       (3, 'Santiago', 'Gallino', 'santiago.gallino@davinci.com.ar', 'Gallino', '$2y$10$5yW1aY2jXnF6Uyg/as83ZOYDPojRhTjyhmJ9nPxf84ZRRywwczHgy', 1, 7);

-- --------------------
-- TABLA SAGAS
-- --------------------

CREATE TABLE IF NOT EXISTS sagas (
                        sagas_id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY, 
                        saga VARCHAR (80) NOT NULL, 
                        descripcion_saga TEXT (300) NOT NULL,
                        background TEXT (300) NOT NULL,
                        logo VARCHAR (255) NOT NULL,
                        banner TEXT (300) NOT NULL
) ENGINE = innoDB;


INSERT INTO sagas 
    (sagas_id, saga, descripcion_saga, background, logo, banner)

    VALUES 
    ( '1','Star Wars', 'La trama descrita en las nueve películas que componen la serie principal de Star Wars relata las vivencias de la familia Skywalker,​«hace mucho tiempo en una galaxia muy muy lejana»,cuyos miembros comparten la peculiaridad de ser sensibles a «La Fuerza», lo cual les permite desarrollar habilidades como la telequinesis, la clarividencia y el control mental, entre otras.', 'sw.jpg', 'franjS.png', 'sw2.jpg'),
    
    ('2','Marvel', 'El Universo cinematográfico de Marvel (Marvel Cinematic Universe) es una franquicia de medios y un universo compartido, centrada en una serie de películas de superhéroes producidas independientemente por Marvel Studios y basadas en los personajes que aparecen en las publicaciones de Marvel Comics.', 'vengers.jpg', 'franjA.png', 'vengers2.jpg'),

    ('3','Jurassic Park', 'Jurassic Park es una película de ciencia ficción y aventuras dirigida por el cineasta estadounidense Steven Spielberg y estrenada en 1993. Su trama está basada en el libro homónimo de Michael Crichton y relata las vivencias de un grupo de personas en un parque de diversiones con dinosaurios clonados, creado por un filántropo multimillonario y un equipo de científicos genetistas. Durante una visita de evaluación antes de su apertura al público en general, los dinosaurios escapan y ponen en riesgo la vida de quienes se encuentran en el parque.', 'jp.jpg', 'franjJ.png', 'jp2.jpg'),

    ('4','The Hobbit', 'El argumento de El hobbit se sitúa en el año 2941 de la Tercera Edad del Sol, antes de lo sucedido en "El señor de los anillos",​ y narra la historia del hobbit Bilbo Bolsón, que junto con el mago Gandalf y un grupo de enanos, vive una aventura en busca del tesoro custodiado por el dragón Smaug en la Montaña Solitaria.', 'TheHobbit.jpg', 'franjH.png' , 'TheHobbit2.jpg'),

    ('5','Stranger Things', 'Cuando un niño desaparece, sus amigos, la familia y la policía se ven envueltos en una serie de eventos misteriosos al tratar de encontrarlo. Su ausencia coincide con el avistamiento de una criatura terrorífica y la aparición de una extraña niña.', 'sw.jpg', 'franjG.png', 'sw2.jpg'),

    ('6','Indiana Jones', 'Es un arqueólogo y profesor universitario que emprende viajes con la finalidad de buscar objetos de importante valor histórico para la humanidad. Generalmente, en cada una de sus aventuras se enfrenta con rivales que compiten por conseguir el mismo objeto para posteriormente utilizarlo con fines siniestros. Algunos de estos objetos son el Arca de la Alianza, el Santo Grial y la calavera de cristal.', 'Jones.jpg', 'franjIj.png', 'Jones2.jpg'),

    ('7','God of War', 'Se basa en las aventuras de un semidiós espartano, Kratos, quien se enfrenta a diversos personajes de la mitología griega y nórdica, tanto héroes (Heracles, Teseo, Perseo, etc.); especies mitológicas (gorgonas, arpías, o minotauros); dioses griegos (Ares, Poseidón, Zeus, entre otros), titanes (como Cronos) y dioses primordiales (como Gaia). Aunque el guerrero espartano acostumbra enemistad con la mayoría de los dioses, recibe ayuda de muchos de ellos en algún momento de cada entrega, en especial de Atenea.', 'gow.jpg', 'franjGow.png', 'gow2.jpg'),

     ('8','Marvel', 'Un aventurero espacial se convierte en la presa de unos cazadores de tesoros después de robar el orbe de un villano traicionero. Cuando descubre su poder, debe hallar la forma de unir a unos rivales para salvar al universo.', 'guardians.jpg', 'franjG.png', 'guardians2.jpg');


-- --------------------
-- TABLA DIFICULTAD
-- --------------------

CREATE TABLE IF NOT EXISTS dificultad (
                                        dificultad_id INT UNSIGNED AUTO_INCREMENT UNIQUE NOT NULL PRIMARY KEY,
                                        dificultad VARCHAR (45) NOT NULL 
) ENGINE = innoDB;

INSERT INTO dificultad 
VALUES (1, 'Facil'),
       (2, 'Moderado'),
       (3, 'Dificil');


-- --------------------
-- TABLA PROYECTOS
-- --------------------
CREATE TABLE IF NOT EXISTS proyectos (
                                      proyectos_id INT UNSIGNED AUTO_INCREMENT UNIQUE NOT NULL PRIMARY KEY,
                                      nombre VARCHAR (80) NOT NULL,
                                      descripcion TEXT (700) NOT NULL,
                                      pasos TEXT (700) NOT NULL,
                                      portada VARCHAR (255) NOT NULL,
                                      direccion VARCHAR (255) NOT NULL,
                                      fecha DATE NOT NULL,
                                      precio FLOAT (5,2) NOT NULL,
                                      productoImg VARCHAR (255) NOT NULL,
                                      sagas_id_fk INT UNSIGNED NOT NULL,
                                      dificultad_id_fk INT UNSIGNED NOT NULL,


                                      FOREIGN KEY (sagas_id_fk) 
                                      REFERENCES sagas (sagas_id) 
                                      ON DELETE CASCADE 
                                      ON UPDATE CASCADE,

                                      FOREIGN KEY (dificultad_id_fk) 
                                      REFERENCES dificultad (dificultad_id) 
                                      ON DELETE CASCADE 
                                      ON UPDATE CASCADE
) ENGINE = innoDB;

INSERT INTO proyectos 
    
    (proyectos_id, nombre, descripcion, pasos, portada, direccion, fecha, precio, productoImg, sagas_id_fk, dificultad_id_fk)

    VALUES 
    ('1', 'Ídolo dorado', 'Esta escultura aparece en el film "Indiana Jones y el arca perdida", es originario de la región Guaraní y representa a la diosa de la fertilidad', 'Primero procederemos a atornillas la tabla de madera hacia la base, después ponemos arcilla sobre la tabla y empezamos a moldear. Luego de conseguir la escultura moldeada a nuestro gusto procederemos a realizar el molde cubriendo la escultura con yeso y con el aluminio cortaremos “cuadraditos” del mismo para utilizarlo como separadores. Al despegar el molde procedemos a llenarlo con cemento, esperamos unas horas y ya tenemos nuestro “ídolo dorado” de Indiana Jones.', 'idolodorado.jpg', 'https://www.youtube.com/embed/Z5qMjKmuUuo', '2020-02-17', 99.99,'idolo.png', '6', '2'),
    
    ('2', 'Escudo del Capitán américa', 'El legendario escudo del Capitán América, este escudo está hecho del metal más fuerte en toda la tierra el "Vibranium". El Capi lo porto en todas sus misiones como héroe, hasta le dio batalla al mismísimo Thanos', 'Primero procederemos a pintar el disco cónico con una pintura anti oxidante, luego de eso macaremos con la cinta de enmascarar las franjas del escudo, por lo cierto cada una mide 8cm de ancho, pintamos en plateado, rojo y azul el escudo. Con el escudo pintado seguiremos con la estrella del mismo, vamos a cortar en chapa cada punta de la estrella que en total van a ser cinco, luego la pegamos con pegamento de dos componentes. Con los pasos anteriores ya tenemos el frente de nuestro escudo terminado, por lo tanto solo nos queda cortar el cinturón a la medida de nuestro brazo y colócaselo al escudo. Así ya tenemos terminado nuestro escudo del Capitán América.', 'cap.jpg', 'https://www.youtube.com/embed/zr1mzWC0fSo', '2019-04-29', 199.99, 'cap.png', '2', '2'),

    ('3', 'BB-8 de Rey Skywalker', 'BB-8 es el personaje droide más icónico de la nueva trilogía de Star Wars, acompaña a Rey en su aventura en equilibrar la fuerza.', 'Primero empezaremos con pintar nuestra pelota de Telgopor de blanco, luego de esto utilizando las plantillas hacer alrededor de toda la pelota las marcas que tiene BB-8, luego de esto lo pintamos de naranja y le damos unos detalles en negro y ¡Listo!', 'bb8.jpg', 'https://www.youtube.com/embed/DpokogoZprk', '2019-12-19', 10.99, 'bb8.png', '1', '1'),
    
    ('4', 'El martillo Mjolnir', 'El poderoso Martillo Mjolnir, empuñado por el poderoso Thor, es llamado "El arma de un rey". Con este poderoso martillo Thor derribo a millones de enemigos demostrando que su poder no tiene igual.', 'Para empezar lo que haremos será pintar la impresión con aerosol plateado, luego lijaremos las imperfecciones. Después de esto le damos una última mano de pintura y para finalizar le colocaremos el cuero marrón en el pomo del martillo.', 'mjolnir1.jpg', 'https://www.youtube.com/embed/xFbtm4tXZT0', '2019-12-19', 90.99, 'mjolnir.png', '2', '1'),

    ('5', 'Hacha de Kratos', 'La Hacha del Leviathan fue creada con el fin de derrotar a Thor, por lo tanto es portada por el dios de la guerra Kratos el cual va hacer lo imposible para proteger a su familia.', 'Para empezar, procederemos a tallar nuestro mango con las plantillas dejadas en la descripción del video, luego al tener nuestro mango tallado, lo siguiente que haremos va a ser poner la venda alrededor de la parte inferior de este. Ya con eso tenemos nuestro mango terminado; Más tarde lo que haremos va a ser cortar el acero guiándonos con las plantillas, luego de esto lo lijamos, y por último tallamos el acero y lo pintamos con plateado para que no se oxide futuramente.', 'Axe.jpg', 'https://www.youtube.com/embed/RJO80nQ_1KQ', '2020-10-20', 199.99, 'axe.png', '7', '3'),

     ('6', 'Escudo de Roble', 'El Mítico escudo portado por Thorin, el Rey de los enanos de Erebor. Con este pudo vencer al orco pálido "Azog el profanador".', 'Para empezar primero procederemos a socavar el tronco hasta llegar ahuecarlo al tamaño que nos entre mejor en el antebrazo, luego de esto procedemos a sacar la corteza. Con la corteza sacada del tronco procedemos a realizar todos los detalles y marcas que tiene el escudo en si. Al realizar todos los detalles pintamos el escudo con pinturas de gama marrones, grises y negras. Después de pintarlo solo queda ponerle las dos sogas atornilladas a nuestro gusto y ¡listo!.', 'thorin.jpg', 'https://www.youtube.com/embed/kwb8bSFJx4g', '2020-03-31', 230.99, 'oak.png', '4', '3'),


   ('7', 'Garra de Velocirraptor', 'Este es el segundo dinosaurio más emblemático de la franquicia después del Tyrannosaurus rex. Debuta cerca del final de la primer pelicula luego de que Alan Grant, Lex y Tim llegan al centro de visitantes despues de escapar por poco a la estampida de Gallimimus y el ataque del Tyrannosaurus. Estos nos dan una batalla épica contra el Tyranosaurus Rex', 'Primero procederemos a moldear la masilla epoxi en la plantilla que se dejó en la descripción del video, luego de esto unimos ambas partes con pegamento y las lijamos. Por segundo lugar agarraremos el marco y lo llenaremos de pegamento y arena para darle un toque más realista. Para finalizar pintamos la garra de negro y las colocamos en el marco con pegamento.', 'raptor.jpg', 'https://www.youtube.com/embed/i4gyzm6VWI8', '2017-08-01', 5.99, 'raptor.png', '3', '1'),

   ('8', 'Orbe "Gema del infinito"', 'El Orbe contiene una de las seis gemas del infinito, la gema del poder, Este hace su aparición en la película Guardianes de la galaxia', 'Para realizar nuestro Orbe empezaremos por dibujar todas las formas a calar próximamente con nuestro soldador, al tener todo marcado comenzaremos a tallarlo. luego nos quedaría cortear la pelota por la mitad y pintarla completamente de negro. ¡Luego de esto les damos unos detalles en plateado y ya está!', 'orbe.jpg', 'https://www.youtube.com/embed/zVoeRfTZPIM', '2017-06-28', 9.99, 'orbe.png', '8', '1');

-- --------------------
-- TABLA MATERIALES
-- --------------------

CREATE TABLE IF NOT EXISTS materiales (
                                        materiales_id INT UNSIGNED AUTO_INCREMENT UNIQUE NOT NULL PRIMARY KEY,
                                        nombre VARCHAR (100)

) ENGINE = innoDB;

INSERT INTO materiales 
VALUES (1, 'Arcilla'),
       (2, 'Yeso'),
       (3, 'Pintura en Aerosol'),
       (4, 'Acero'),
       (5, 'Cuero'),
       (6, 'Pintura Antioxidante'),
       (7, 'Madera'),
       (8, 'Tornillos'),
       (9, 'Planchuela de hierro'),
       (10, 'Tergopol'),
       (11, 'Pintura acrilica'),
       (12, 'Planchuela 9ml'),
       (13, 'Imanes'),
       (14, 'Lija'),
       (15, 'Impresion 3D'),
       (16, 'Plasticola'),
       (17, 'Jabon'),
       (18, 'Porcelana Fría'),
       (19, 'Masilla Epoxy'),
       (20, 'Cinta de papel'),
       (21, 'Soga');



-- --------------------
-- TABLA HERRAMIENTAS
-- --------------------

CREATE TABLE IF NOT EXISTS herramientas (
                                        herramientas_id INT UNSIGNED AUTO_INCREMENT UNIQUE NOT NULL PRIMARY KEY,
                                        nombre VARCHAR (100)

) ENGINE = innoDB;

INSERT INTO herramientas 
VALUES (1, 'Estecas'),
       (2, 'Tijeras'),
       (3, 'Amoladora'),
       (4, 'Soldadora'),
       (5, 'Cerrucho'),
       (6, 'Atornilladora'),
       (7, 'Torno'),
       (8, 'Sierra'),
       (9, 'Pegamento'),
       (10, 'Pinceles');
       
-- ---------------------------------------
-- TABLA MATERIALES PROYECTOS
-- ---------------------------------------

CREATE TABLE IF NOT EXISTS proyectos_materiales (
                                        proyectos_materiales_id INT UNSIGNED AUTO_INCREMENT UNIQUE NOT NULL PRIMARY KEY,
                                        proyectos_id_fk INT UNSIGNED NOT NULL,
                                        materiales_id_fk INT UNSIGNED NOT NULL,


                                        FOREIGN KEY (proyectos_id_fk) 
                                        REFERENCES proyectos (proyectos_id) 
                                        ON DELETE CASCADE 
                                        ON UPDATE CASCADE,

                                        FOREIGN KEY (materiales_id_fk) 
                                        REFERENCES materiales (materiales_id) 
                                        ON DELETE CASCADE 
                                        ON UPDATE CASCADE

) ENGINE = innoDB;

INSERT INTO proyectos_materiales 
VALUES (1, 1, 1),
       (2, 1, 2),
       (3, 1, 3),
       (4, 2, 3),
       (5, 2, 4),
       (6, 2, 5),
       (7, 2, 6),
       (8, 3, 10),
       (9, 3, 11),
       (10, 4, 3),
       (11, 4, 5),
       (12, 4, 14),
       (13, 4, 15),
       (14, 5, 4),
       (15, 5, 5),
       (16, 5, 7),
       (17, 5, 8),
       (18, 6, 7),
       (19, 6, 8),
       (20, 6, 9),
       (21, 6, 21),
       (22, 7, 11),
       (23, 7, 14),
       (24, 7, 18),
       (25, 7, 19),
       (26, 8, 10),
       (27, 8, 11),
       (28, 8, 13);

-- ---------------------------------------
-- TABLA HERRAMIENTAS PROYECTOS
-- ---------------------------------------

CREATE TABLE IF NOT EXISTS proyectos_herramientas (
                                        proyectos_herramientas_id INT UNSIGNED AUTO_INCREMENT UNIQUE NOT NULL PRIMARY KEY,
                                        proyectos_id_fk INT UNSIGNED NOT NULL,
                                        herramientas_id_fk INT UNSIGNED NOT NULL,


                                        FOREIGN KEY (proyectos_id_fk) 
                                        REFERENCES proyectos (proyectos_id) 
                                        ON DELETE CASCADE 
                                        ON UPDATE CASCADE,

                                        FOREIGN KEY (herramientas_id_fk) 
                                        REFERENCES herramientas (herramientas_id) 
                                        ON DELETE CASCADE 
                                        ON UPDATE CASCADE

) ENGINE = innoDB;

INSERT INTO proyectos_herramientas 
VALUES (1, 1, 1),
       (2, 2, 2),
       (3, 2, 3),
       (4, 2, 6),
       (5, 3, 2),
       (6, 3, 9),
       (7, 3, 10),
       (8, 4, 9),
       (9, 4, 10),
       (10, 5, 2),
       (11, 5, 3),
       (12, 5, 6),
       (13, 5, 7),
       (14, 5, 9),
       (15, 5, 10),
       (16, 6, 2),
       (17, 6, 3),
       (18, 6, 5),
       (19, 6, 6),
       (20, 6, 8),
       (21, 6, 9),
       (22, 7, 7),
       (23, 7, 9),
       (24, 7, 10),
       (25, 8, 4),
       (26, 8, 8),
       (27, 8, 9),
       (28, 8, 10);
       