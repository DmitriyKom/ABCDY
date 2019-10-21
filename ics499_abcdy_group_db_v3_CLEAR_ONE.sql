CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(15) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `enabled` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
);

CREATE TABLE `user_info` (
  `user_id` int(11) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` char(2) NOT NULL,
  `zip` char(5) NOT NULL,
  `email` varchar(150) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`),
  CONSTRAINT `user_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
);

INSERT INTO `users` VALUES (6,'Gus','$2y$10$YahQ8ZTseQz.e5LqurAUyOHZBxZp6vOUXnCISO8wDVykKD09p/llG','HR','2019-09-15 14:42:49',''),(7,'Mike','$2y$10$oTBPR1f0EiUV1E/k8XbwIuCgKCB/CsDyPqlIvYzGt8Tt4sTzY5kJ.','Trainee','2019-09-15 14:44:50',''),(8,'Jim','$2y$10$A3DgJZqI3ZyTCyaUqoIWquj6zK8yBeKXwCWu3oKC0G1JQZawKwG4m','Manager','2019-09-18 17:52:52',''),(9,'Pam','$2y$10$igk4QL2CCtb2bOpt0/ELXeX4/LpQn6k6o.4Sp8KfoV0JZBQC0xE1y','HR','2019-09-18 19:01:58',''),(96,'test_HR','$2y$10$alrR3SB9ljJb8NeRuncb6uE/A1N4QfX7PzlnSdzZH5pzVNmgD8WQK','HR','2019-10-05 18:03:21',''),(97,'test_Manager','$2y$10$CpOu1goK.qZXotikZUC.9.8Fk1FC.r.5om5XYVN/HL3gQPy5EXB0G','Manager','2019-10-05 18:03:51',''),(98,'test_Trainee','$2y$10$T4ZW.2GgRP3SI/EMZ9UnrOWFmD9V6HX/0cT7EBPaNsVgdsGXTCduy','Trainee','2019-10-05 18:04:43',''),(99,'test_Manager2','$2y$10$6IuMjZK2owJYVZZ/mLtmVuI.mLdvYdL9Yia1jPOC3QYQNXaiM7BpG','Manager','2019-10-09 15:13:05','');

INSERT INTO `user_info` VALUES (96,'Last_Name_test_HR','First_Name_test_HR','Address test_HR','City test_HR','mn','12345','test_HR@test_HR.com'),(97,'Last_Name_test_Manager','First_Name_test_Manager','Address test_Manager','City test_HR','mn','12345','test_Manager@test_Manager.com'),(98,'Last_Name_test_Trainee','First_Name_test_Trainee','Address test_Trainee','City test_HR','mn','55345','test_Trainee@test_Trainee.com'),(99,'test_Manager2','test_Manager2','Address test_Manager2','City test_Manager2','MN','12345','test_Manager2@test_Manager2.com');






