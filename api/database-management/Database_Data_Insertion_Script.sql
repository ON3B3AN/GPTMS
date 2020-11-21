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
`avg_pop`,
`hint`)
VALUES
(1, '1', '5', 0, 0, '00:00:00', 'This short par 5 can be reached with two full shots. Keep the drive to the right center of the fairway to open up the green, which is guarded by bunkers left and right. A short iron approach shot will hold this green well while bouncing to the left at impact.'),
(1, '2', '4', 0, 0, '00:00:00', 'The drive should be played to the right-center of the fairway, using the right fairway bunker as a target line. This will set up the best approach to the green by avoiding the front-left bunker. The approach shot landing on or near the right side of this green will bounce and roll severely to the left.'),
(1, '3', '3', 0, 0, '00:00:00', 'This par 3 has a green that is very wide and shallow and has a multitude of undulations that must be surveyed carefully. The uphill shot requires at least one extra club to carry the front bunker.'),
(1, '4', '4', 0, 0, '00:00:00', 'This, the shortest par 4 on the course, requires an accurate tee shot. Play to the left-center of the fairway to avoid the bunker on the right, which is not visible from the tee. The second shot is downhill to a small green well-bunkered right and left. Look for subtle contours when reading the putt.'),
(1, '5', '4', 0, 0, '00:00:00', 'The tee shot on this par 4 must be played to the left-center of the fairway to avoid the woods guarding the dogleg right. Avoid swinging too hard from the elevated tee and aim along a target line at the fairway bunker on the left. The elevated green is guarded in front by two deep bunkers and to the right and behind the green by a water hazard. Avoid being long or to the right on your approach.'),
(1, '6', '5', 0, 0, '00:00:00', 'The drive on this par 5 should be to the right-center of the fairway to set up a clear second shot around the slight dogleg left. Water hazards in the middle of the fairway and a sand bunker to the right of the green add challenge to the second shot. The approach shot is to a long elevated green.'),
(1, '7', '4', 0, 0, '00:00:00', 'This long par 4 is played best with a drive to the left-center of the fairway. The second shot is to an elevated green with woods surrounding the green. The green also slopes away on approach, allowing the ball to roll more than usual. Look for subtle slopes when reading the putt.'),
(1, '8', '3', 0, 0, '00:00:00', 'This is the longest and most difficult of the courses par 3 holes, calling for a very accurate tee shot. The green is very narrow and extremely deep. Depending on flagstick location, club selection may vary by up to three length choices. Sand bunkers circling the green make this a most challenging hole.'),
(1, '9', '4', 0, 0, '00:00:00', 'A classic par 4 finishing hole. The tee shot must be placed in the center or right-center of the fairway to allow for a clear second shot through the opening of the sycamore trees lining the left side of the fairway. The second shot is slightly uphill to a well-bunkered and gently rolling green. A ball landing on the left side of the green will bounce and roll to the right.'),
(1, '10', '4', 0, 0, '00:00:00', 'A well-placed tee shot to the right-center of the fairway will open up the second shot to this cloverleaf green. Be sure to select enough club to carry the front sand bunker, which is 10 yards deep from the front edge of the green. Also, be aware that an approach shot a little long and over the green is safe.'),
(1, '11', '4', 0, 0, '00:00:00', 'A straight tee shot in the fairway leaves a short iron approach to this narrow green that slopes from front to back. The approach shot needs to be below the flagstick.'),
(1, '12', '3', 0, 0, '00:00:00', 'This par 3 requires careful club selection due to the large green fronted by water. A high right-to-left tee shot usually will produce the best results because of the surrounding terrain, shape of the green and wind conditions that usually prevail.'),
(1, '13', '4', 0, 0, '00:00:00', 'Select a club for a 190- to 215-yard tee shot to place the ball in the fairway in position to hit through the dogleg right opening to the green. The second shot is slightly uphill. Allow for this in your club selection. Also, the approach shot is usually into a deceptive breeze, so you might consider adding more club.'),
(1, '14', '4', 0, 0, '00:00:00', 'The objective is to avoid a blind second shot, so your tee shot on this par 4 must be kept to the left of the fairway bunker. The green slopes away from the fairway, which causes the approach shot to roll through the green slightly more than normal. Be careful reading the break.'),
(1, '15', '3', 0, 0, '00:00:00', 'This par 3 hole has a narrow green that is so deep your club selection may vary by as much as three clubs, depending on the flagstick placement. A high shot to the right side of the green often produces the best results, as the ball will bounce and roll left. Beware of the deep swale to the left of the green.'),
(1, '16', '5', 0, 0, '00:00:00', 'This par 5 requires a straight tee shot and a second shot to the uphill slope at the dogleg. If the second shot does not reach the corner of the dogleg, a challenging blind third shot will remain. The third shot must be played carefully to avoid the slopes to the right and behind the green.'),
(1, '17', '4', 0, 0, '00:00:00', 'This par 4 has an unusual feature: an island fairway. Open with a straight tee shot of less than 210 yards to avoid the fairway bunker and water hazard beyond it. The second shot is slightly uphill and a half club longer than it may appear. Avoid the greenside bunkers.'),
(1, '18', '5', 0, 0, '00:00:00', 'The longest par 5 on the course plays even longer than its yardage because it is uphill. Two long and straight wood shots are needed to get into position for a medium to short iron third shot. Play to the right-center of the fairway on the second shot to avoid the deep ravine in the left rough. The elevated green slopes away from the fairway, so allow for more roll than normal on the approach shot after it lands on the green.'),
(2, '1', '4', 0, 0, '00:00:00', 'Golfers may aggressively play their tee shot over the short left fairway bunker to shorten this long par 4 opening hole. The green has a small section in the middle that will draw overly aggressive shots into the chipping area behind the green.'),
(2, '2', '4', 0, 0, '00:00:00', 'The player is challenged from the tee to hit a straight shot between the two majestic oaks framing the landing area. The green slopes away from the line of play and is surrounded on three sides by tight fairway grass and a steep rough area on the fourth.'),
(2, '3', '3', 0, 0, '00:00:00', 'Playing downhill and framed by native grass, club selection is crucial on this par 3. The large green is deep enough to accommodate the mid- to long-iron shot. Failing to hit this green, the best chance to score is to hit it straight and leave your ball in the deceptively large approach.'),
(2, '4', '4', 0, 0, '00:00:00', 'A well-placed tee shot will land left and long of the short right-hand fairway bunker. This will position your ball at the best angle into one of the smaller greens on the course. This hole plays considerably more uphill than it appears.'),
(2, '5', '4', 0, 0, '00:00:00', 'Tee shots up the right side of the fairway will propel the ball ahead and feed it into the center of this wide landing area. The key to scoring well on this hole is to place your approach shot on the same level as the pin location.'),
(2, '6', '5', 0, 0, '00:00:00', 'Careful planning and proper execution are crucial to scoring on this dramatic hole.'),
(2, '7', '3', 0, 0, '00:00:00', 'The tee shot plays uphill into a crowned green. A creative short game is a must on this hole. Leave yourself on the low side of the pin placement to score well.'),
(2, '8', '4', 0, 0, '00:00:00', 'This par 4 is best played over the far left edge of the right fairway bunker. Run your approach shot in from left to right, allowing the ground to feed the shot to the hole.'),
(2, '9', '5', 0, 0, '00:00:00', 'Playing uphill the entire way, this par 5 is a true three-shot hole. From the tee, take aim at the center of the three bunkers defining the play area. The challenge on this hole is trusting your yardage, selecting the right club and positioning your ball around the small slick green.'),
(2, '10', '5', 0, 0, '00:00:00', 'Playing downhill, the tee shot will get extra kick and roll if played over the native grass knoll at the start of the fairway. Weigh the risk-reward options for your approach to score on this reachable par 5.'),
(2, '11', '4', 0, 0, '00:00:00', 'Tee shots aimed at the oak tree on the left side of the fairway and hit with a slight fade will position your ball in the center of this long par 4. Those players not confident in their ability to reach this green in two should leave their approach out to the left of the green for the best angle in for their third.'),
(2, '12', '4', 0, 0, '00:00:00', 'The signature "S" bunker on this short par 4 determines the golfers approach to playing this hole. Playing directly over the "S" bunker will provide extra bounce and roll off the right to left slope and leave you with a short wedge that must carry the fronting green side bunker.'),
(2, '13', '4', 0, 0, '00:00:00', 'Aim for the large fairway bunker found on the far side of the fairway to position your ball for the approach. Left and long of this green will bring your ball back toward the putting surface.'),
(2, '14', '3', 0, 0, '00:00:00', 'Confidence in your yardage and club selection is necessary for this par 3. Beware, the bunker is separated from the green and with the elevation change, players may under club.'),
(2, '15', '4', 0, 0, '00:00:00', 'A birdie opportunity is presented on this downhill par 4. The green is slightly crowned, so get your ball to the correct side and leave it below the hole for your best chance to score.'),
(2, '16', '3', 0, 0, '00:00:00', 'Draw the ball from right to left to make best use of this diagonally positioned green.'),
(2, '17', '4', 0, 0, '00:00:00', 'Aim your tee shot at the distant fairway bunker and turn it over from right to left to launch your ball down this wide fairway. Presented with one of the smaller greens, the player must attack the hole through the air or on the ground.'),
(2, '18', '5', 0, 0, '00:00:00', 'Split the two fairway bunkers from the elevated tees and you will be on your way to a good score. The small green breaks in several directions and is better suited for a wedge than a fairway wood, but well-played shots will be rewarded.'),
(3, '1', '4', 0, 0, '00:00:00', 'Our opening hole on the north course generally plays into the prevailing wind. Three strategically placed fairway bunkers make teeshot placement a premium allowing the player a short iron into a well guarded and undulating green.'),
(3, '2', '5', 0, 0, '00:00:00', 'Long hitters will have a go at it in hopes of reaching this green in two on this long, narrow par five. Players not able to reach the greenin two will need to avoid a left hand side cross bunker inside 100 yards. An accurate approach shot to the small, contoured green isrequired in hopes of securing a birdie'),
(3, '3', '3', 0, 0, '00:00:00', 'This uphill holes plays slightly longer than the yardage. A back hole location can produce difficult putting conditions as a spine runsthrough that area of the green.'),
(3, '4', '4', 0, 0, '00:00:00', 'Accuracy off of the tee will once again be at a premium. For a clear approach to the two tiered green, the player will need to keep tothe left side of the fairway. A player making a birdie here will pick up a stroke on their opponent'),
(3, '5', '5', 0, 0, '00:00:00', 'Again, being accurate off of the tee will determine how the player will attack this hole. Those that find the fairway may have theopportunity to reach this par five in two. Those that dont will have to negotiate a challenging lay up as a large tree on the left hand sideof the fairway and fairway bunkers short right of the green dictate strategy.'),
(3, '6', '4', 0, 0, '00:00:00', 'Driver may not be the play off of the tee for everyone. Several fairway bunkers and out of bound left may produce a layup tee ball shortof any trouble. The second short normally play about a half of club more as the green is slightly uphill.'),
(3, '7', '3', 0, 0, '00:00:00', 'This beautiful, slightly downhill par three will play about a half of club shorter than the yardage. The difficult, undulating green will putputting at a premium. A birdie here will be a bonus for any player'),
(3, '8', '4', 0, 0, '00:00:00', 'The two left side fairway bunkers tighten up the driving area a bit, but there is plenty of room to the right. A good drive will leave players with a mid to short iron into the green for their second shot'),
(3, '9', '4', 0, 0, '00:00:00', 'Accuracy off of the tee is a premium here. Out of bounds left and bunkers and pine trees right call for a straight drive that will leave theplayers a long to mid iron into the green. In Ross fashion, the green allows for balls to be bounced on to the putting surface'),
(3, '10', '4', 0, 0, '00:00:00', 'A solid drive will set the player up with a mid iron approach on this dogleg left hole. Trees left and several fairway bunkers will again place a premium on proper placement of the tee shot.'),
(3, '11', '3', 0, 0, '00:00:00', 'Birdies are hard to come by on the longest of the four par three holes on the north. Guarded by two bunkers, this green looks relativelysimple from the tee. However, closer inspection will reveal a front bowl and several places to hide the hole location'),
(3, '12', '4', 0, 0, '00:00:00', 'Par is a good score on this long and difficult par four. A tee shot that avoids the trees left and a fairway bunker in the driving zone onthe right side will set the player up with a long to mid iron into the elevated green. A false front, on the left side of the green complex,will cause a approach shot coming up short to roll away.'),
(3, '13', '4', 0, 0, '00:00:00', 'This dogleg right par four requires a precise tee shot to avoid the trees left and fairway bunkers on the right. A wayward tee shot could result in having to play a great recovery shot to reach the green in regulation. Many players take the driver out of their hands choosing instead to lay up and play into the green with a short iron.'),
(3, '14', '5', 0, 0, '00:00:00', 'Big hitters normally have a go at this green in two but the player needs to beware of the large penalty area short of the green. A layupshot can be challenging as the player will need to avoid a cross bunker on the right and the penalty are on the left. Once on the green, putting wont come easy on this large and undulating surface'),
(3, '15', '3', 0, 0, '00:00:00', 'Dont be short on this classic Ross designed par three that can play longer that it looks. Many shots have plugged under the front lipwhile trying to squeeze the tee shot into a front hole location. Players will normally be hitting mid to short irons into this small green that has bunkers short, left, and right'),
(3, '16', '4', 0, 0, '00:00:00', 'With bunkers on both sides of the driving zone, a tee shot short of these hazards will serve the player well leaving a mid iron approachto the green. One of the more under-rated putting surfaces on the course, it can frustrate those with makeable putts'),
(3, '17', '5', 0, 0, '00:00:00', 'Bunker placement throughout this hole requires sound strategy on the longest of the four par fives on the North. A generous opening into the green will allow balls to be run onto this undulating putting surface'),
(3, '18', '4', 0, 0, '00:00:00', 'This great par four finishing hole has a diagonal penalty area that will dictate strategy from tee to green. With fairway bunkers left andright, a tee shot in the fairway will be most important, leaving long to mid iron into the green. However, once on the green the fun hasjust begun. Players will be faced with possibly the most difficult putting surface on the course.'),
(4, '1', '4', 0, 0, '00:00:00', 'A solid drive that avoids the two fairway bunkers will leave a mid to short iron shot into this green that slopes drastically from back tofront. An over-aggressive putt from the back of the green could lead to some frustration on this putting surface'),
(4, '2', '4', 0, 0, '00:00:00', 'The first of several strong par fours on the South course. Avoiding out of bounds right and a severe fairway bunker left will allow theplayer a better opportunity to hit the elevated putting surface in regulation. Getting to the green is only half the challenge of this hole.Putting on the severely sloped surface is difficult'),
(4, '3', '3', 0, 0, '00:00:00', 'The first of the South courses six par three holes. A mid to short iron approach on this straight forward hole normally plays down wind.'),
(4, '4', '4', 0, 0, '00:00:00', 'A left hand cross bunker on this dog leg left hole challenges the player. They must either lay up short or try and carry it. Aggressive teeshots can lead to birdie opportunities'),
(4, '5', '3', 0, 0, '00:00:00', 'A spine runs through this green from back to front making putting and recovery shots difficult. Bunkers short, right, and leftonly add tothe character of this hole'),
(4, '6', '5', 0, 0, '00:00:00', 'This reachable par five generally plays into the prevailing wind. Out of bounds left and several well placed bunkers throughout the holemay cause the player consternation.'),
(4, '7', '4', 0, 0, '00:00:00', 'Fairway bunkers right force the tee shot left on this medium length par four. A very large oak tree protects the left front side of this bowlshaped green.'),
(4, '8', '4', 0, 0, '00:00:00', 'Avoiding the fairway bunkers right and left will leave the player a mid to short iron into a green that falls off to the left. In classic Donald Ross fashion, a ball can be rolled onto the green.'),
(4, '9', '3', 0, 0, '00:00:00', 'Avoiding the fairway bunkers right and left will leave the player a mid to short iron into a green that falls off to the left. In classic Donald Ross fashion, a ball can be rolled onto the green.'),
(4, '10', '4', 0, 0, '00:00:00', 'A solid drive from an elevated tee will set the player up with a mid iron approach on this hole. Two mounds on the putting surface maymake putting an adventure.'),
(4, '11', '4', 0, 0, '00:00:00', 'A perfect carry over the fairway cross bunker promises a short shot to the green, but a slight miss left or right makes par a difficult score. The well bunkered green slopes from back to front testing downhill putting skills.'),
(4, '12', '3', 0, 0, '00:00:00', 'The penalty area to the left causes many shots to be pushed into the bunker right of the flattest green on the South.  Stretching to 179 yards, a brisk northerly wind can put a long iron or fairway wood into a players hand.'),
(4, '13', '4', 0, 0, '00:00:00', 'Another of our outstanding par four holes on the South.  Trees line the fairway, with a right hand bunker at the premium landing area.  The subtly contoured green makes a two putt no sure thing.'),
(4, '14', '3', 0, 0, '00:00:00', 'This slightly uphill par three plays to forgiving bowl shaped green and accounts for more holes-in-one that any other hole at the Club.'),
(4, '15', '4', 0, 0, '00:00:00', 'This may be the Clubs most underrated hole.  Looking innocent from the tee, this green has difficult hole locations on the right and left sides of this small green.  Shoot for the middle and have a reasonable chance at par. '),
(4, '16', '4', 0, 0, '00:00:00', 'The last of the Souths outstanding par four holes, this slight dogleg right requires an actuate tee shot to avoided fairway bunkers right and left.  Approach shot can be run up onto this small putting surface.'),
(4, '17', '3', 0, 0, '00:00:00', 'Normally playing longer than its yardage, shifting winds can add to this hole being more difficult than it looks.  Balls missing left face a steep drop off making getting up and down a challenge.'),
(4, '18', '5', 0, 0, '00:00:00', 'One of the few holes where the golfer normally has the wind at their back. Tee shots need to get to the corner of the dog leg right in order to have a open second shot.  Longer hitters can reach the green in two but players laying up will need to avoid several strategically place fairway bunkers well short of the green.  The most severely sloped green on the South further complicates matters for the player.');

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
