INSERT INTO QUESTION VALUES
    (1, "En quelle année a eu lieu la révolution française ?"),
    (2, "Quelle est la couleur la plus chaude ?"),
    (3, "Quelle est la couleur la plus froide ?"),
    (4, "Combien y a t'il d'habitants en France ? (à 5 millions près)"),
    (5, "Quand a commencé la Renaissance italienne ?"),
    (6, "Combien de gouttes d'eau faut-il pour remplir une baignoire standart ? (à 50 millions près)"),
    (7, "Quand a été fondée l'université d'Orléans ?"),
    (8, "Combien de Schtroumpf différent existe-t-il ?"),
    (9, "A combien de mètres s'élève la plus haute tour du monde de Kapla jamais faite ?"),
    (10, "Parmi ces personnages, lesquels ont été inventés par Nintendo ?"),
    (11, "Parmi ces personnages, lesquels sont apparus après 1995 ?"),
    (12, "Dans quel(s) film(s) Harrisson Ford apparaît-il ?");


INSERT INTO REPONSE VALUES
    (1, "1785"),
    (2, "1789"),
    (3, "1790"),
    (4, "Rose"),
    (5, "Bleu"),
    (6, "Rouge"),
    (7, "Vert"),
    (8, "10 millions"),
    (9, "60 millions"), 
    (10, "70 millions"),
    (11, "75 millions"),
    (12, "120 millions"),
    (13, "XIIIe siècle"),
    (14, "XIVe siècle"),
    (15, "XVe siècle"),
    (16, "XXe siècle"),
    (17, "100"),
    (18, "102"),
    (19, "25"),
    (20, "Mario"),
    (21, "Sonic"),
    (22, "Zelda"),
    (23, "Kirby"),
    (24, "Harry Potter"),
    (25, "Ezio Auditore"),
    (26, "Zabriskie Point"),
    (27, "Titanic"),
    (28, "Star Wars"),
    (29, "American Nightmare"),
    (30, "Indiana Jones");



INSERT INTO REPONSE_POSSIBLE VALUES
    (1, 1, 0),
    (1, 2, 1),
    (1, 3, 0),

    (2, 4, 0),
    (2, 5, 0),
    (2, 6, 1),
    (2, 7, 0),

    (3, 4, 0),
    (3, 5, 1),
    (3, 6, 0),
    (3, 7, 0),

    (4, 9, 0),
    (4, 10, 1),
    (4, 11, 0),

    (5, 13, 0),
    (5, 14, 1),
    (5, 15, 0),

    (6, 8, 1),
    (6, 9, 0),
    (6, 12, 0),
    
    (7, 13, 0),
    (7, 14, 1),
    (7, 16, 0),

    (8, 17, 0),
    (8, 18, 1),
    (8, 8, 0),

    (9, 19, 1),
    (9, 17, 0),
    (9, 18, 0),

    (10, 20, 1),
    (10, 21, 0),
    (10, 22, 1),
    (10, 23, 1),
    (10, 24, 0),
    (10, 25, 0),

    (11, 20, 0),
    (11, 21, 0),
    (11, 22, 0),
    (11, 23, 0),
    (11, 24, 1),
    (11, 25, 1),

    (12, 26, 1),
    (12, 27, 0),
    (12, 28, 1),
    (12, 29, 0),
    (12, 30, 1);
