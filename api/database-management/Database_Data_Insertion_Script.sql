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
("Shaddy Woods",
"12 Shady Rd. Oxford, MI 48371",
"111-111-1111");

INSERT INTO `mydb`.`course`
(`course_name`,
`address`,
`phone`)
VALUES
("Goodrich Golf Course",
"100 Golfing Rd. Goodrich, MI 48347",
"222-222-2222");

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
(1,
1,
3,
0,
0,
"00:30:00");

INSERT INTO `mydb`.`hole`
(`Course_course_id`,
`hole_number`,
`hole_par`,
`longitude`,
`latitude`,
`avg_pop`)
VALUES
(1,
2,
4,
0,
0,
"00:35:00");

INSERT INTO `mydb`.`hole`
(`Course_course_id`,
`hole_number`,
`hole_par`,
`longitude`,
`latitude`,
`avg_pop`)
VALUES
(1,
3,
3,
0,
0,
"00:32:00");

INSERT INTO `mydb`.`hole`
(`Course_course_id`,
`hole_number`,
`hole_par`,
`longitude`,
`latitude`,
`avg_pop`)
VALUES
(1,
4,
3,
0,
0,
"00:31:00");

INSERT INTO `mydb`.`hole`
(`Course_course_id`,
`hole_number`,
`hole_par`,
`longitude`,
`latitude`,
`avg_pop`)
VALUES
(1,
5,
5,
0,
0,
"00:40:00");

INSERT INTO `mydb`.`hole`
(`Course_course_id`,
`hole_number`,
`hole_par`,
`longitude`,
`latitude`,
`avg_pop`)
VALUES
(1,
6,
3,
0,
0,
"00:30:00");

INSERT INTO `mydb`.`hole`
(`Course_course_id`,
`hole_number`,
`hole_par`,
`longitude`,
`latitude`,
`avg_pop`)
VALUES
(1,
7,
3,
0,
0,
"00:28:00");

INSERT INTO `mydb`.`hole`
(`Course_course_id`,
`hole_number`,
`hole_par`,
`longitude`,
`latitude`,
`avg_pop`)
VALUES
(1,
8,
3,
0,
0,
"00:27:00");

INSERT INTO `mydb`.`hole`
(`Course_course_id`,
`hole_number`,
`hole_par`,
`longitude`,
`latitude`,
`avg_pop`)
VALUES
(1,
9,
3,
0,
0,
"00:23:00");

INSERT INTO `mydb`.`hole`
(`Course_course_id`,
`hole_number`,
`hole_par`,
`longitude`,
`latitude`,
`avg_pop`)
VALUES
(1,
10,
2,
0,
0,
"00:18:00");

INSERT INTO `mydb`.`hole`
(`Course_course_id`,
`hole_number`,
`hole_par`,
`longitude`,
`latitude`,
`avg_pop`)
VALUES
(1,
11,
2,
0,
0,
"00:19:00");

INSERT INTO `mydb`.`hole`
(`Course_course_id`,
`hole_number`,
`hole_par`,
`longitude`,
`latitude`,
`avg_pop`)
VALUES
(1,
12,
4,
0,
0,
"00:27:00");

INSERT INTO `mydb`.`hole`
(`Course_course_id`,
`hole_number`,
`hole_par`,
`longitude`,
`latitude`,
`avg_pop`)
VALUES
(1,
13,
3,
0,
0,
"00:20:00");

INSERT INTO `mydb`.`hole`
(`Course_course_id`,
`hole_number`,
`hole_par`,
`longitude`,
`latitude`,
`avg_pop`)
VALUES
(1,
14,
3,
0,
0,
"00:20:00");

INSERT INTO `mydb`.`hole`
(`Course_course_id`,
`hole_number`,
`hole_par`,
`longitude`,
`latitude`,
`avg_pop`)
VALUES
(1,
15,
2,
0,
0,
"00:16:00");

INSERT INTO `mydb`.`hole`
(`Course_course_id`,
`hole_number`,
`hole_par`,
`longitude`,
`latitude`,
`avg_pop`)
VALUES
(1,
16,
4,
0,
0,
"00:24:00");

INSERT INTO `mydb`.`hole`
(`Course_course_id`,
`hole_number`,
`hole_par`,
`longitude`,
`latitude`,
`avg_pop`)
VALUES
(1,
17,
4,
0,
0,
"00:26:00");

INSERT INTO `mydb`.`hole`
(`Course_course_id`,
`hole_number`,
`hole_par`,
`longitude`,
`latitude`,
`avg_pop`)
VALUES
(1,
18,
3,
0,
0,
"00:22:00");

-- Tee Insert -------------------------
-- 3 Total Tees -----------------------
INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(1,
320);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(1,
330);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(1,
340);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(2,
300);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(2,
310);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(2,
320);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(3,
400);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(3,
410);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(3,
420);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(4,
250);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(4,
260);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(4,
270);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(5,
230);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(5,
240);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(5,
250);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(6,
220);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(6,
230);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(6,
240);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(7,
210);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(7,
220);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(7,
230);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(8,
210);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(8,
220);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(8,
230);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(9,
200);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(9,
210);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(9,
220);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(10,
200);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(10,
210);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(10,
220);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(11,
200);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(11,
210);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(11,
220);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(12,
200);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(12,
210);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(12,
220);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(13,
200);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(13,
210);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(13,
220);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(14,
200);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(14,
210);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(14,
220);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(15,
200);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(15,
210);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(15,
220);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(16,
200);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(16,
210);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(16,
220);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(17,
200);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(17,
210);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(17,
220);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(18,
200);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(18,
210);

INSERT INTO `mydb`.`tee`
(`Hole_hole_id`,
`distance_to_pin`)
VALUES
(18,
220);

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
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(1,
1,
1,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(2,
1,
1,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(3,
1,
1,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(4,
1,
1,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(5,
1,
1,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(6,
1,
1,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(7,
1,
1,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(8,
1,
1,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(9,
1,
1,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(10,
1,
1,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(11,
1,
1,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(12,
1,
1,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(13,
1,
1,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(14,
1,
1,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(15,
1,
1,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(16,
1,
1,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(17,
1,
1,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(18,
1,
1,
1,
5,
0);
-- Player #2 ----------------------------
INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(1,
2,
2,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(2,
2,
2,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(3,
2,
2,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(4,
2,
2,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(5,
2,
2,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(6,
2,
2,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(7,
2,
2,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(8,
2,
2,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(9,
2,
2,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(10,
2,
2,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(11,
2,
2,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(12,
2,
2,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(13,
2,
2,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(14,
2,
2,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(15,
2,
2,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(16,
2,
2,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(17,
2,
2,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(18,
2,
2,
1,
5,
0);
-- Player #3 ----------------------------
INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(1,
3,
3,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(2,
3,
3,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(3,
3,
3,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(4,
3,
3,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(5,
3,
3,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(6,
3,
3,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(7,
3,
3,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(8,
3,
3,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(9,
3,
3,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(10,
3,
3,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(11,
3,
3,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(12,
3,
3,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(13,
3,
3,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(14,
3,
3,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(15,
3,
3,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(16,
3,
3,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(17,
3,
3,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(18,
3,
3,
1,
5,
0);
-- Player #4 ----------------------------
INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(1,
4,
4,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(2,
4,
4,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(3,
4,
4,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(4,
4,
4,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(5,
4,
4,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(6,
4,
4,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(7,
4,
4,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(8,
4,
4,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(9,
4,
4,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(10,
4,
4,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(11,
4,
4,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(12,
4,
4,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(13,
4,
4,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(14,
4,
4,
1,
6,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(15,
4,
4,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(16,
4,
4,
1,
5,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(17,
4,
4,
1,
7,
0);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Player_player_id`,
`Player_User_user_id`,
`Player_Party_party_id`,
`stroke`,
`total_score`)
VALUES
(18,
4,
4,
1,
5,
0);
