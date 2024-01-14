INSERT INTO QUESTION VALUES
    (1, "En quelle année a eu lieu la révolution française ?"),
    (2, "Quelle est la couleur la plus chaude ?"),
    (3, "Quelle est la couleur la plus froide ?"),
    (4, "Combien y a t'il d'habitants en France ? (à 5 millions près)"),
    (5, "Quand a commencé la Renaissance italienne ?"),
    (6, "Combien de gouttes d'eau faut-il pour remplir une baignoire standart ? (à 50 millions près)");


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
    (14, "XIV siècle"),
    (15, "XV siècle");


INSERT INTO REPONSE_POSSIBLE VALUES
    (1, 1),
    (1, 2, 1),
    (1, 3),

    (2, 4),
    (2, 5),
    (2, 6, 1),
    (2, 7),

    (3, 4),
    (3, 5, 1),
    (3, 6),
    (3, 7),

    (4, 9),
    (4, 10),
    (4, 11),

    (5, 13),
    (5, 14),
    (5, 15),

    (6, 8, 1),
    (6, 9),
    (6, 120);
