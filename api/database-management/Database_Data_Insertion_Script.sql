-- User Insert -------------------------
INSERT INTO `mydb`.`user`
(`first_name`,
`last_name`,
`email`,
`password`,
`phone`)
VALUES
("Travis",
"Thayer",
"email@gmail.com",
"1234",
"000-000-0000");

INSERT INTO `mydb`.`user`
(`first_name`,
`last_name`,
`email`,
`password`,
`phone`)
VALUES
("John",
"Smith",
"smith@gmail.com",
"1234",
"111-111-1111");

INSERT INTO `mydb`.`user`
(`first_name`,
`last_name`,
`email`,
`password`,
`phone`)
VALUES
("Bob",
"Barker",
"barker@gmail.com",
"1234",
"222-111-1111");

INSERT INTO `mydb`.`user`
(`first_name`,
`last_name`,
`email`,
`password`,
`phone`)
VALUES
("Tiger",
"Woods",
"woods@gmail.com",
"1234",
"333-111-1111");

-- Course Insert -------------------------
INSERT INTO `mydb`.`course`
(`course_name`,
`address`,
`phone`)
VALUES
('OU Katke-Cousins Golf Course', '492 Golf View Lane, Rochester, MI 48309', '2483646300'),
('OU R&S Sharf Golf Course', '492 Golf View Lane, Rochester, MI 48309', '2483646300'),
('Detroit Golf Club - North Course', '17911 Hamilton Road, Detroit, MI 48203', '3133454400'),
('Detroit Golf Club - South Course', '17911 Hamilton Road, Detroit, MI 48203', '3133454400');

-- Employee Insert (security level of 1 = admin; 0 = staff) -------------
INSERT INTO `mydb`.`employee`
(`User_user_id`,
`Course_course_id`,
`security_lvl`)
VALUES
(1,
1,
1);

INSERT INTO `mydb`.`employee`
(`User_user_id`,
`Course_course_id`,
`security_lvl`)
VALUES
(2,
2,
1);

-- Hole Insert -------------------------
INSERT INTO `mydb`.`hole`
(`Course_course_id`,
`hole_number`,
`hole_par`,
`longitude`,
`latitude`,
`avg_pop`)
VALUES
(1, '1', '5', 0, 0, '00:00:00'),
(1, '2', '4', 0, 0, '00:00:00'),
(1, '3', '3', 0, 0, '00:00:00'),
(1, '4', '4', 0, 0, '00:00:00'),
(1, '5', '4', 0, 0, '00:00:00'),
(1, '6', '5', 0, 0, '00:00:00'),
(1, '7', '4', 0, 0, '00:00:00'),
(1, '8', '3', 0, 0, '00:00:00'),
(1, '9', '4', 0, 0, '00:00:00'),
(1, '10', '4', 0, 0, '00:00:00'),
(1, '11', '4', 0, 0, '00:00:00'),
(1, '12', '3', 0, 0, '00:00:00'),
(1, '13', '4', 0, 0, '00:00:00'),
(1, '14', '4', 0, 0, '00:00:00'),
(1, '15', '3', 0, 0, '00:00:00'),
(1, '16', '5', 0, 0, '00:00:00'),
(1, '17', '4', 0, 0, '00:00:00'),
(1, '18', '5', 0, 0, '00:00:00'),
(2, '1', '4', 0, 0, '00:00:00'),
(2, '2', '4', 0, 0, '00:00:00'),
(2, '3', '3', 0, 0, '00:00:00'),
(2, '4', '4', 0, 0, '00:00:00'),
(2, '5', '4', 0, 0, '00:00:00'),
(2, '6', '5', 0, 0, '00:00:00'),
(2, '7', '3', 0, 0, '00:00:00'),
(2, '8', '4', 0, 0, '00:00:00'),
(2, '9', '5', 0, 0, '00:00:00'),
(2, '10', '5', 0, 0, '00:00:00'),
(2, '11', '4', 0, 0, '00:00:00'),
(2, '12', '4', 0, 0, '00:00:00'),
(2, '13', '4', 0, 0, '00:00:00'),
(2, '14', '3', 0, 0, '00:00:00'),
(2, '15', '4', 0, 0, '00:00:00'),
(2, '16', '3', 0, 0, '00:00:00'),
(2, '17', '4', 0, 0, '00:00:00'),
(2, '18', '5', 0, 0, '00:00:00'),
(3, '1', '4', 0, 0, '00:00:00'),
(3, '2', '5', 0, 0, '00:00:00'),
(3, '3', '3', 0, 0, '00:00:00'),
(3, '4', '4', 0, 0, '00:00:00'),
(3, '5', '5', 0, 0, '00:00:00'),
(3, '6', '4', 0, 0, '00:00:00'),
(3, '7', '3', 0, 0, '00:00:00'),
(3, '8', '4', 0, 0, '00:00:00'),
(3, '9', '4', 0, 0, '00:00:00'),
(3, '10', '4', 0, 0, '00:00:00'),
(3, '11', '3', 0, 0, '00:00:00'),
(3, '12', '4', 0, 0, '00:00:00'),
(3, '13', '4', 0, 0, '00:00:00'),
(3, '14', '5', 0, 0, '00:00:00'),
(3, '15', '3', 0, 0, '00:00:00'),
(3, '16', '4', 0, 0, '00:00:00'),
(3, '17', '5', 0, 0, '00:00:00'),
(3, '18', '4', 0, 0, '00:00:00'),
(4, '1', '4', 0, 0, '00:00:00'),
(4, '2', '4', 0, 0, '00:00:00'),
(4, '3', '3', 0, 0, '00:00:00'),
(4, '4', '4', 0, 0, '00:00:00'),
(4, '5', '3', 0, 0, '00:00:00'),
(4, '6', '5', 0, 0, '00:00:00'),
(4, '7', '4', 0, 0, '00:00:00'),
(4, '8', '4', 0, 0, '00:00:00'),
(4, '9', '3', 0, 0, '00:00:00'),
(4, '10', '4', 0, 0, '00:00:00'),
(4, '11', '4', 0, 0, '00:00:00'),
(4, '12', '3', 0, 0, '00:00:00'),
(4, '13', '4', 0, 0, '00:00:00'),
(4, '14', '3', 0, 0, '00:00:00'),
(4, '15', '4', 0, 0, '00:00:00'),
(4, '16', '4', 0, 0, '00:00:00'),
(4, '17', '3', 0, 0, '00:00:00'),
(4, '18', '5', 0, 0, '00:00:00');

-- Tee Insert -------------------------
-- Course 1 -----------------------
INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`,
`tee_name`)
VALUES
(1, 475, "Tournament"),
(1, 464, "Grizzlies"),
(1, 464, "Bear"),
(1, 423, "Champion"),
(1, 386, "Competition"),
(2, 519, "Tournament"),
(2, 431, "Grizzlies"),
(2, 376, "Bear"),
(2, 376, "Champion"),
(2, 318, "Competition"),
(3, 184, "Tournament"),
(3, 168, "Grizzlies"),
(3, 168, "Bear"),
(3, 161, "Champion"),
(3, 154, "Competition"),
(4, 350, "Tournament"),
(4, 337, "Grizzlies"),
(4, 337, "Bear"),
(4, 330, "Champion"),
(4, 267, "Competition"),
(5, 398, "Tournament"),
(5, 372, "Grizzlies"),
(5, 357, "Bear"),
(5, 357, "Champion"),
(5, 290, "Competition"),
(6, 551, "Tournament"),
(6, 485, "Grizzlies"),
(6, 485, "Bear"),
(6, 470, "Champion"),
(6, 409, "Competition"),
(7, 456, "Tournament"),
(7, 395, "Grizzlies"),
(7, 363, "Bear"),
(7, 363, "Champion"),
(7, 300, "Competition"),
(8, 203, "Tournament"),
(8, 189, "Grizzlies"),
(8, 189, "Bear"),
(8, 119, "Champion"),
(8, 112, "Competition"),
(9, 439, "Tournament"),
(9, 401, "Grizzlies"),
(9, 373, "Bear"),
(9, 373, "Champion"),
(9, 344, "Competition"),
(10, 426, "Tournament"),
(10, 416, "Grizzlies"),
(10, 377, "Bear"),
(10, 377, "Champion"),
(10, 321, "Competition"),
(11, 414, "Tournament"),
(11, 399, "Grizzlies"),
(11, 399, "Bear"),
(11, 340, "Champion"),
(11, 320, "Competition"),
(12, 202, "Tournament"),
(12, 143, "Grizzlies"),
(12, 143, "Bear"),
(12, 110, "Champion"),
(12, 76, "Competition"),
(13, 460, "Tournament"),
(13, 400, "Grizzlies"),
(13, 393, "Bear"),
(13, 393, "Champion"),
(13, 372, "Competition"),
(14, 372, "Tournament"),
(14, 356, "Grizzlies"),
(14, 356, "Bear"),
(14, 318, "Champion"),
(14, 291, "Competition"),
(15, 215, "Tournament"),
(15, 186, "Grizzlies"),
(15, 167, "Bear"),
(15, 167, "Champion"),
(15, 155, "Competition"),
(16, 562, "Tournament"),
(16, 513, "Grizzlies"),
(16, 513, "Bear"),
(16, 471, "Champion"),
(16, 418, "Competition"),
(17, 374, "Tournament"),
(17, 352, "Grizzlies"),
(17, 352, "Bear"),
(17, 340, "Champion"),
(17, 269, "Competition"),
(18, 625, "Tournament"),
(18, 557, "Grizzlies"),
(18, 494, "Bear"),
(18, 494, "Champion"),
(18, 425, "Competition");

-- Course 2 -----------------------
INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`,
`tee_name`)
VALUES
(19, 462, "Tournament"),
(19, 435, "Grizzlies"),
(19, 377, "Bear"),
(19, 377, "Champion"),
(19, 338, "Competition"),
(20, 409, "Tournament"),
(20, 383, "Grizzlies"),
(20, 383, "Bear"),
(20, 372, "Champion"),
(20, 264, "Competition"),
(21, 202, "Tournament"),
(21, 195, "Grizzlies"),
(21, 175, "Bear"),
(21, 175, "Champion"),
(21, 110, "Competition"),
(22, 427, "Tournament"),
(22, 410, "Grizzlies"),
(22, 383, "Bear"),
(22, 383, "Champion"),
(22, 302, "Competition"),
(23, 439, "Tournament"),
(23, 408, "Grizzlies"),
(23, 376, "Bear"),
(23, 376, "Champion"),
(23, 323, "Competition"),
(24, 563, "Tournament"),
(24, 540, "Grizzlies"),
(24, 540, "Bear"),
(24, 519, "Champion"),
(24, 467, "Competition"),
(25, 154, "Tournament"),
(25, 148, "Grizzlies"),
(25, 148, "Bear"),
(25, 108, "Champion"),
(25, 93, "Competition"),
(26, 448, "Tournament"),
(26, 418, "Grizzlies"),
(26, 394, "Bear"),
(26, 394, "Champion"),
(26, 354, "Competition"),
(27, 549, "Tournament"),
(27, 521, "Grizzlies"),
(27, 451, "Bear"),
(27, 451, "Champion"),
(27, 365, "Competition"),
(28, 535, "Tournament"),
(28, 519, "Grizzlies"),
(28, 519, "Bear"),
(28, 475, "Champion"),
(28, 443, "Competition"),
(29, 443, "Tournament"),
(29, 417, "Grizzlies"),
(29, 373, "Bear"),
(29, 373, "Champion"),
(29, 322, "Competition"),
(30, 308, "Tournament"),
(30, 280, "Grizzlies"),
(30, 247, "Bear"),
(30, 247, "Champion"),
(30, 226, "Competition"),
(31, 371, "Tournament"),
(31, 349, "Grizzlies"),
(31, 349, "Bear"),
(31, 316, "Champion"),
(31, 246, "Competition"),
(32, 182, "Tournament"),
(32, 172, "Grizzlies"),
(32, 143, "Bear"),
(32, 143, "Champion"),
(32, 134, "Competition"),
(33, 407, "Tournament"),
(33, 379, "Grizzlies"),
(33, 379, "Bear"),
(33, 323, "Champion"),
(33, 308, "Competition"),
(34, 201, "Tournament"),
(34, 181, "Grizzlies"),
(34, 178, "Bear"),
(34, 178, "Champion"),
(34, 142, "Competition"),
(35, 431, "Tournament"),
(35, 400, "Grizzlies"),
(35, 400, "Bear"),
(35, 374, "Champion"),
(35, 334, "Competition"),
(36, 572, "Tournament"),
(36, 546, "Grizzlies"),
(36, 521, "Bear"),
(36, 521, "Champion"),
(36, 384, "Competition");

-- Course 3 -----------------------
INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`,
`tee_name`)
VALUES
(37, 343, "Gold"),
(37, 329, "Black"),
(37, 314, "Blue"),
(37, 294, "White"),
(38, 557, "Gold"),
(38, 542, "Black"),
(38, 532, "Blue"),
(38, 496, "White"),
(39, 167, "Gold"),
(39, 137, "Black"),
(39, 123, "Blue"),
(39, 109, "White"),
(40, 435, "Gold"),
(40, 403, "Black"),
(40, 374, "Blue"),
(40, 301, "White"),
(41, 514, "Gold"),
(41, 494, "Black"),
(41, 475, "Blue"),
(41, 434, "White"),
(42, 372, "Gold"),
(42, 351, "Black"),
(42, 326, "Blue"),
(42, 291, "White"),
(43, 207, "Gold"),
(43, 197, "Black"),
(43, 171, "Blue"),
(43, 157, "White"),
(44, 397, "Gold"),
(44, 380, "Black"),
(44, 362, "Blue"),
(44, 333, "White"),
(45, 453, "Gold"),
(45, 431, "Black"),
(45, 408, "Blue"),
(45, 379, "White"),
(46, 425, "Gold"),
(46, 404, "Black"),
(46, 385, "Blue"),
(46, 347, "White"),
(47, 233, "Gold"),
(47, 201, "Black"),
(47, 170, "Blue"),
(47, 139, "White"),
(48, 459, "Gold"),
(48, 423, "Black"),
(48, 407, "Blue"),
(48, 374, "White"),
(49, 393, "Gold"),
(49, 375, "Black"),
(49, 356, "Blue"),
(49, 332, "White"),
(50, 498, "Gold"),
(50, 486, "Black"),
(50, 475, "Blue"),
(50, 444, "White"),
(51, 160, "Gold"),
(51, 146, "Black"),
(51, 133, "Blue"),
(51, 109, "White"),
(52, 403, "Gold"),
(52, 383, "Black"),
(52, 364, "Blue"),
(52, 339, "White"),
(53, 577, "Gold"),
(53, 546, "Black"),
(53, 489, "Blue"),
(53, 477, "White"),
(54, 420, "Gold"),
(54, 396, "Black"),
(54, 382, "Blue"),
(54, 345, "White");

-- Course 4 -----------------------
INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`,
`tee_name`)
VALUES
(55, 387, "Gold"),
(55, 372, "Black"),
(55, 362, "Blue"),
(55, 345, "White"),
(56, 440, "Gold"),
(56, 416, "Black"),
(56, 383, "Blue"),
(56, 326, "White"),
(57, 157, "Gold"),
(57, 141, "Black"),
(57, 128, "Blue"),
(57, 105, "White"),
(58, 347, "Gold"),
(58, 327, "Black"),
(58, 314, "Blue"),
(58, 284, "White"),
(59, 196, "Gold"),
(59, 170, "Black"),
(59, 154, "Blue"),
(59, 128, "White"),
(60, 523, "Gold"),
(60, 499, "Black"),
(60, 487, "Blue"),
(60, 429, "White"),
(61, 386, "Gold"),
(61, 370, "Black"),
(61, 333, "Blue"),
(61, 323, "White"),
(62, 382, "Gold"),
(62, 358, "Black"),
(62, 326, "Blue"),
(62, 316, "White"),
(63, 148, "Gold"),
(63, 138, "Black"),
(63, 120, "Blue"),
(63, 109, "White"),
(64, 429, "Gold"),
(64, 410, "Black"),
(64, 399, "Blue"),
(64, 335, "White"),
(65, 359, "Gold"),
(65, 344, "Black"),
(65, 326, "Blue"),
(65, 292, "White"),
(66, 179, "Gold"),
(66, 164, "Black"),
(66, 154, "Blue"),
(66, 131, "White"),
(67, 435, "Gold"),
(67, 411, "Black"),
(67, 360, "Blue"),
(67, 318, "White"),
(68, 189, "Gold"),
(68, 172, "Black"),
(68, 158, "Blue"),
(68, 120, "White"),
(69, 404, "Gold"),
(69, 389, "Black"),
(69, 376, "Blue"),
(69, 321, "White"),
(70, 446, "Gold"),
(70, 427, "Black"),
(70, 416, "Blue"),
(70, 362, "White"),
(71, 160, "Gold"),
(71, 137, "Black"),
(71, 123, "Blue"),
(71, 92, "White"),
(72, 531, "Gold"),
(72, 505, "Black"),
(72, 491, "Blue"),
(72, 442, "White");


-- Party Insert -------------------------
INSERT INTO `mydb`.`party`
(`Course_course_id`,
`date`,
`start_time`,
`end_time`,
`size`,
`longitude`,
`latitude`,
`golf_cart`)
VALUES
(1,
"2020-01-01",
"14:00:00",
"16:00:00",
4,
0,
0,
1);

-- Player Insert -------------------------
INSERT INTO `mydb`.`player`
(`User_user_id`,
`Party_party_id`,
`handicap`)
VALUES
(1,
1,
20);

INSERT INTO `mydb`.`player`
(`User_user_id`,
`Party_party_id`,
`handicap`)
VALUES
(2,
1,
0);

INSERT INTO `mydb`.`player`
(`User_user_id`,
`Party_party_id`,
`handicap`)
VALUES
(3,
1,
10);

INSERT INTO `mydb`.`player`
(`User_user_id`,
`Party_party_id`,
`handicap`)
VALUES
(4,
1,
5);

-- Score Insert -------------------------
-- Player #1 -------------------------
INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(1,
1,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(2,
1,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(3,
1,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(4,
1,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(5,
1,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(6,
1,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(7,
1,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(8,
1,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(9,
1,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(10,
1,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(11,
1,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(12,
1,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(13,
1,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(14,
1,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(15,
1,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(16,
1,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(17,
1,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(18,
1,
1,
5,
0);
-- Player #2 ----------------------------
INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(1,
2,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(2,
2,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(3,
2,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(4,
2,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(5,
2,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(6,
2,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(7,
2,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(8,
2,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(9,
2,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(10,
2,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(11,
2,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(12,
2,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(13,
2,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(14,
2,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(15,
2,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(16,
2,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(17,
2,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(18,
2,
1,
5,
0);
-- Player #3 ----------------------------
INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(1,
3,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(2,
3,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(3,
3,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(4,
3,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(5,
3,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(6,
3,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(7,
3,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(8,
3,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(9,
3,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(10,
3,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(11,
3,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(12,
3,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(13,
3,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(14,
3,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(15,
3,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(16,
3,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(17,
3,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(18,
3,
1,
5,
0);
-- Player #4 ----------------------------
INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(1,
4,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(2,
4,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(3,
4,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(4,
4,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(5,
4,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(6,
4,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(7,
4,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(8,
4,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(9,
4,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(10,
4,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(11,
4,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(12,
4,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(13,
4,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(14,
4,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(15,
4,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(16,
4,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(17,
4,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(18,
4,
1,
5,
0);
