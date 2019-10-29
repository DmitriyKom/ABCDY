DROP DATABASE IF EXISTS Demo;

Create DATABASE Demo;
--
-- Table structure for table `users`
--

CREATE TABLE users (
  user_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  username varchar(50) NOT NULL UNIQUE KEY,
  password varchar(255) NOT NULL,
  role varchar(15) DEFAULT NULL,
  last_login datetime DEFAULT current_timestamp(),
  created_dt datetime DEFAULT current_timestamp(),
  enabled int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO users (user_id, username, password, role, last_login,created_dt, enabled) VALUES
(1, 'Gus', '$2y$10$YahQ8ZTseQz.e5LqurAUyOHZBxZp6vOUXnCISO8wDVykKD09p/llG', 'HR', '2019-09-15 14:42:49','2019-09-15 14:42:49',1),
(2, 'Mike', '$2y$10$oTBPR1f0EiUV1E/k8XbwIuCgKCB/CsDyPqlIvYzGt8Tt4sTzY5kJ.', 'Trainee', '2019-09-15 14:44:50','2019-09-15 14:42:49',1),
(3, 'Jim', '$2y$10$A3DgJZqI3ZyTCyaUqoIWquj6zK8yBeKXwCWu3oKC0G1JQZawKwG4m', 'Manager', '2019-09-18 17:52:52','2019-09-15 14:42:49',1),
(4, 'Pam', '$2y$10$igk4QL2CCtb2bOpt0/ELXeX4/LpQn6k6o.4Sp8KfoV0JZBQC0xE1y', 'HR', '2019-09-18 19:01:58','2019-09-15 14:42:49',1);

CREATE TABLE user_info (
    user_id int NOT NULL PRIMARY KEY,
    last_name varchar(50) NOT NULL,
    first_name varchar(50) NOT NULL,
    address varchar(15) NOT NULL,
    city varchar(50) NOT NULL,
    state varchar(50) NOT NULL,
    zip varchar(50) NOT NULL,
    email varchar(50) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id)

);
CREATE TABLE training (
    training_id int PRIMARY KEY AUTO_INCREMENT,
    user_id int NOT NULL,
    training_title varchar(255) NOT NULL,
    create_dt  datetime DEFAULT current_timestamp(),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
CREATE TABLE training_document(
    training_doc_id int PRIMARY KEY AUTO_INCREMENT,
    training_id int NOT NULL,
    training_doc_title varchar(255) NOT NULL,
    create_dt datetime DEFAULT current_timestamp(),
    FOREIGN KEY (training_id) REFERENCES training(training_id)
);
CREATE TABLE training_document_value (
    training_val_id int PRIMARY KEY AUTO_INCREMENT,
    training_doc_id int NOT NULL,
    training_value varchar(255) NOT NULL,
    create_dt datetime DEFAULT current_timestamp(),
    FOREIGN KEY (training_doc_id) REFERENCES training_document(training_doc_id)
);
CREATE TABLE training_link (
training_link_id int PRIMARY KEY AUTO_INCREMENT,
training_doc_id int NOT NULL,
training_link varchar(255) NOT NULL,
create_dt datetime DEFAULT current_timestamp(),
FOREIGN KEY (training_doc_id) REFERENCES training_document(training_doc_id)
);
CREATE TABLE test (
test_id int PRIMARY KEY AUTO_INCREMENT,
training_doc_id int NOT NULL,
training_link varchar(255) NOT NULL,
create_dt datetime DEFAULT current_timestamp(),
FOREIGN KEY (training_doc_id) REFERENCES training_document(training_doc_id)
);
CREATE TABLE training_assigned (
    training_assigned_id int PRIMARY KEY AUTO_INCREMENT,
    training_id int NOT NULL,
    test_id int NOT NULL,
    user_id int NOT NULL,
    assigned_user_id int NOT NULL,
    assigned_dt datetime DEFAULT current_timestamp(),
    completed_dt datetime DEFAULT current_timestamp(),
    FOREIGN KEY (training_id) REFERENCES training(training_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (assigned_user_id) REFERENCES users(user_id),
    FOREIGN KEY (test_id) REFERENCES test(test_id)
);
CREATE TABLE test_question (
    question_id int PRIMARY KEY AUTO_INCREMENT,
    test_id int NOT NULL,
    question VARCHAR(255),
    FOREIGN KEY (test_id) REFERENCES test(test_id)
);
CREATE TABLE test_answer (
    answer_id int PRIMARY KEY AUTO_INCREMENT,
    test_id int NOT NULL,
    answer VARCHAR(255),
    FOREIGN KEY (test_id) REFERENCES test(test_id)
);
CREATE TABLE test_scores (
    score_id int PRIMARY KEY AUTO_INCREMENT,
    test_id int NOT NULL,
    question_id int,
    answer_id int,
    emp_answer int,
    correct  int,
    FOREIGN KEY (test_id) REFERENCES test(test_id),
    FOREIGN KEY (question_id) REFERENCES test_question(question_id),
    FOREIGN KEY (answer_id) REFERENCES test_answer(answer_id)
);
