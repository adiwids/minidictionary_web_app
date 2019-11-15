CREATE TABLE `tikodcom_biodict`.`comments` (
  `id_comment` INTEGER  NOT NULL AUTO_INCREMENT,
  `visitor_name` VARCHAR(30)  NOT NULL,
  `visitor_email` VARCHAR(50)  NOT NULL,
  `visitor_site` VARCHAR(50) ,
  `comment` TEXT  NOT NULL,
  `comment_date` DATETIME  NOT NULL,
  `moderated` TINYINT  NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_comment`)
)
ENGINE = InnoDB;

