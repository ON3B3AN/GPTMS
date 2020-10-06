
INSERT INTO `mydb`.`user`
(`first_name`,
`last_name`,
`email`,
`password`,
`phone`,
`employee`)
VALUES
('Dustin',
'Bramos',
'bramosd@yahoo.com',
'a',
5555555555,
0);

INSERT INTO `mydb`.`course`
(`course_name`,
`address`,
`phone_number`)
VALUES
('Test Course',
'Test address',
5555555555);

INSERT INTO `mydb`.`party`
(`size`,
`party_stime`,
`party_etime`)
VALUES
(1,
'2020-10-5 10:00:00',
'2020-10-5 11:00:00');

INSERT INTO `mydb`.`golf_game`
(`date`,
`Course_course_id`,
`Party_party_id`)
VALUES
('2020-10-5',
1,
1);

INSERT INTO `mydb`.`player`
(`player_id`,
`Party_party_id`,
`Party_course_id`,
`User_user_id`,
`handicap`)
VALUES
(1,
1,
1,
1,
0);

INSERT INTO `mydb`.`role`
(`User_user_id`,
`title`)
VALUES
(1,
'test role');

INSERT INTO `mydb`.`hole`
(`course_id`,
`hole_number`,
`hole_par`,
`hole_distance`)
VALUES
(1,
1,
3,
150);

INSERT INTO `mydb`.`hole`
(`course_id`,
`hole_number`,
`hole_par`,
`hole_distance`)
VALUES
(1,
2,
4,
250);

INSERT INTO `mydb`.`hole`
(`course_id`,
`hole_number`,
`hole_par`,
`hole_distance`)
VALUES
(1,
3,
5,
350);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Hole_course_id`,
`stroke`)
VALUES
(1,
1,
3);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Hole_course_id`,
`stroke`)
VALUES
(2,
1,
4);

INSERT INTO `mydb`.`score`
(`Hole_hole_id`,
`Hole_course_id`,
`stroke`)
VALUES
(3,
1,
5);

INSERT INTO `mydb`.`history`
(`user_id`,
`Party_party_id`,
`Score_score_id`,
`Score_Hole_hole_id`,
`Score_Hole_course_id`)
VALUES
(1,
1,
1,
1,
1);

INSERT INTO `mydb`.`history`
(`user_id`,
`Party_party_id`,
`Score_score_id`,
`Score_Hole_hole_id`,
`Score_Hole_course_id`)
VALUES
(1,
1,
2,
2,
1);

INSERT INTO `mydb`.`history`
(`user_id`,
`Party_party_id`,
`Score_score_id`,
`Score_Hole_hole_id`,
`Score_Hole_course_id`)
VALUES
(1,
1,
3,
3,
1);