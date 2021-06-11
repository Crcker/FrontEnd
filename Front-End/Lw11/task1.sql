CREATE DATABASE lw11;
USE lw11;

CREATE TABLE faculty
(
    id                INT AUTO_INCREMENT NOT NULL,
    faculty           VARCHAR(255)       NOT NULL,
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE `utf8mb4_unicode_ci`
  ENGINE = InnoDB;

CREATE TABLE gruppa
(
    id                INT AUTO_INCREMENT NOT NULL,
    `group`           VARCHAR(255)       NOT NULL,
    faculty_id        INT UNSIGNED       NOT NULL,
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE `utf8mb4_unicode_ci`
  ENGINE = InnoDB;

CREATE TABLE student
(
    id                INT AUTO_INCREMENT NOT NULL,
    first_name        VARCHAR(255)       NOT NULL,
    last_name         VARCHAR(255)       NOT NULL,
    age               INT UNSIGNED       NOT NULL,
    group_id          INT UNSIGNED       NOT NULL,
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE `utf8mb4_unicode_ci`
  ENGINE = InnoDB;

INSERT INTO faculty SET faculty = 'PS';
INSERT INTO faculty SET faculty = 'BI';
INSERT INTO faculty SET faculty = 'ISA';

INSERT INTO gruppa SET `group` = 'PS-11', faculty_id = 1;
INSERT INTO gruppa SET `group` = 'PS-12', faculty_id = 1;
INSERT INTO gruppa SET `group` = 'PS-13', faculty_id = 1;

INSERT INTO gruppa SET `group` = 'BI-11', faculty_id = 2;
INSERT INTO gruppa SET `group` = 'BI-12', faculty_id = 2;
INSERT INTO gruppa SET `group` = 'BI-13', faculty_id = 2;

INSERT INTO gruppa SET `group` = 'ISA-11', faculty_id = 3;
INSERT INTO gruppa SET `group` = 'ISA-12', faculty_id = 3;
INSERT INTO gruppa SET `group` = 'ISA-13', faculty_id = 3;

INSERT INTO student SET first_name = 'A',  last_name = 'a', age = 19, group_id = 1;
INSERT INTO student SET first_name = 'B',  last_name = 'b', age = 20, group_id = 2;
INSERT INTO student SET first_name = 'C',  last_name = 'c', age = 18, group_id = 3;
INSERT INTO student SET first_name = 'D',  last_name = 'd', age = 21, group_id = 4;
INSERT INTO student SET first_name = 'E',  last_name = 'e', age = 20, group_id = 5;

INSERT INTO student SET first_name = 'A',  last_name = 'a', age = 19, group_id = 6;
INSERT INTO student SET first_name = 'B',  last_name = 'b', age = 20, group_id = 7;
INSERT INTO student SET first_name = 'C',  last_name = 'c', age = 18, group_id = 8;
INSERT INTO student SET first_name = 'D',  last_name = 'd', age = 21, group_id = 9;
INSERT INTO student SET first_name = 'E',  last_name = 'e', age = 20, group_id = 1;

INSERT INTO student SET first_name = 'A',  last_name = 'a', age = 19, group_id = 2;
INSERT INTO student SET first_name = 'B',  last_name = 'b', age = 20, group_id = 3;
INSERT INTO student SET first_name = 'C',  last_name = 'c', age = 18, group_id = 4;
INSERT INTO student SET first_name = 'D',  last_name = 'd', age = 21, group_id = 5;
INSERT INTO student SET first_name = 'E',  last_name = 'e', age = 20, group_id = 6;

INSERT INTO student SET first_name = 'A',  last_name = 'a', age = 19, group_id = 7;
INSERT INTO student SET first_name = 'B',  last_name = 'b', age = 20, group_id = 8;
INSERT INTO student SET first_name = 'C',  last_name = 'c', age = 18, group_id = 9;
INSERT INTO student SET first_name = 'D',  last_name = 'd', age = 21, group_id = 1;
INSERT INTO student SET first_name = 'E',  last_name = 'e', age = 20, group_id = 2;

INSERT INTO student SET first_name = 'A',  last_name = 'a', age = 19, group_id = 3;
INSERT INTO student SET first_name = 'B',  last_name = 'b', age = 20, group_id = 4;
INSERT INTO student SET first_name = 'C',  last_name = 'c', age = 18, group_id = 5;
INSERT INTO student SET first_name = 'D',  last_name = 'd', age = 21, group_id = 6;
INSERT INTO student SET first_name = 'E',  last_name = 'e', age = 20, group_id = 7;

INSERT INTO student SET first_name = 'A',  last_name = 'a', age = 19, group_id = 8;
INSERT INTO student SET first_name = 'B',  last_name = 'b', age = 20, group_id = 9;
INSERT INTO student SET first_name = 'C',  last_name = 'c', age = 18, group_id = 1;
INSERT INTO student SET first_name = 'D',  last_name = 'd', age = 21, group_id = 2;
INSERT INTO student SET first_name = 'E',  last_name = 'e', age = 20, group_id = 3;

INSERT INTO student SET first_name = 'A',  last_name = 'a', age = 19, group_id = 4;
INSERT INTO student SET first_name = 'B',  last_name = 'b', age = 20, group_id = 5;
INSERT INTO student SET first_name = 'C',  last_name = 'c', age = 18, group_id = 6;
INSERT INTO student SET first_name = 'D',  last_name = 'd', age = 21, group_id = 7;
INSERT INTO student SET first_name = 'E',  last_name = 'e', age = 20, group_id = 8;

INSERT INTO student SET first_name = 'A',  last_name = 'a', age = 19, group_id = 9;
INSERT INTO student SET first_name = 'B',  last_name = 'b', age = 20, group_id = 1;
INSERT INTO student SET first_name = 'C',  last_name = 'c', age = 18, group_id = 2;
INSERT INTO student SET first_name = 'D',  last_name = 'd', age = 21, group_id = 3;
INSERT INTO student SET first_name = 'E',  last_name = 'e', age = 20, group_id = 4;

INSERT INTO student SET first_name = 'A',  last_name = 'a', age = 19, group_id = 5;
INSERT INTO student SET first_name = 'B',  last_name = 'b', age = 20, group_id = 6;
INSERT INTO student SET first_name = 'C',  last_name = 'c', age = 18, group_id = 7;
INSERT INTO student SET first_name = 'D',  last_name = 'd', age = 21, group_id = 8;
INSERT INTO student SET first_name = 'E',  last_name = 'e', age = 20, group_id = 9;

SELECT
    first_name,
    last_name
    age
FROM
    student
WHERE
    student.age = 20;

SELECT
    first_name,
    last_name
    age,
    `group`
FROM 
    student
    LEFT JOIN gruppa ON student.group_id = gruppa.id
WHERE
    group_id = 7;
    
SELECT
    first_name,
    last_name
    faculty
FROM 
    student
    LEFT JOIN gruppa ON student.group_id = gruppa.id 
    LEFT JOIN faculty ON gruppa.faculty_id = faculty.id   
WHERE
    faculty_id = 1;
    
SELECT
    first_name,
    last_name
    age,
    `group`,
    faculty
FROM
    student
    LEFT JOIN gruppa ON student.group_id = gruppa.id
    LEFT JOIN faculty ON gruppa.faculty_id = faculty.id
WHERE
    student.id = 40;