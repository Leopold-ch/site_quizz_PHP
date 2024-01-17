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
    (6, 12, 0);
