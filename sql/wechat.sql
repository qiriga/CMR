

use cmr;


/*药物分类：id、名称*/
CREATE TABLE IF NOT EXISTS `cmr`.`medicine_sort` (
  `ms_id` VARCHAR(36) NOT NULL,
  `ms_name` NVARCHAR(100) NULL,
  PRIMARY KEY (`ms_id`))
ENGINE = InnoDB;



/*药物表：id、名称、别名、图片、来源、出处、生境部、原形态、功能主治、性味、复方*/
CREATE TABLE IF NOT EXISTS `cmr`.`medicine` (
  `medicine_id` VARCHAR(36) NOT NULL,
  `medicine_name` NVARCHAR(100) NOT NULL,
  `alias` NVARCHAR(100) NULL,
  `medicine_img` BLOB NULL,
  `medicine_source` NVARCHAR(500) NULL,
  `reference` NVARCHAR(100) NULL,
  `medicine_birthplace` NVARCHAR(100) NULL,
  `Original_form` NVARCHAR(2000) NULL,
  `medicine_function` NVARCHAR(500) NULL,
  `property_flavor` NVARCHAR(100) NULL,
  `fufang` NVARCHAR(100) NULL,
  `ms_id` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`medicine_id`),
  INDEX `ms_idx` (`ms_id` ASC),
  CONSTRAINT `fk_md_id`
    FOREIGN KEY (`ms_id`)
    REFERENCES `cmr`.`medicine_sort` (`ms_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


/*方剂分类表：ps_id、名称*/
CREATE TABLE IF NOT EXISTS `cmr`.`prescription_sort` (
  `ps_id` VARCHAR(36) NOT NULL,
  `ps_name` NVARCHAR(100) NULL,
  PRIMARY KEY (`ps_id`))
ENGINE = InnoDB;


/*方剂表：prescription_id、名称、组成、用法、功效、方解、方歌、注意事项、ps_id*/
CREATE TABLE IF NOT EXISTS `cmr`.`prescription` (
  `prescription_id` VARCHAR(36) NOT NULL,
  `prescription_name` NVARCHAR(100) NULL,
  `compose` NVARCHAR(100) NULL,
  `usage_method` NVARCHAR(100) NULL,
  `prescription_function` NVARCHAR(100) NULL,
  `fangjie` NVARCHAR(2000) NULL,
  `ps_id` VARCHAR(36) NOT NULL,
  `fangge` NVARCHAR(100) NULL,
  `prescription_notice` NVARCHAR(500) NULL,
  PRIMARY KEY (`prescription_id`),
  INDEX `ps_idx` (`ps_id` ASC),
  CONSTRAINT `fk_ps_id`
    FOREIGN KEY (`ps_id`)
    REFERENCES `cmr`.`prescription_sort` (`ps_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;



/*药物方剂表:mp_id。medicine_id、prescription_id*/
CREATE TABLE IF NOT EXISTS `cmr`.`medicine_prescription` (
  `medicine_id` VARCHAR(36) NOT NULL,
  `prescription_id` VARCHAR(36) NOT NULL,
  `mp_id` VARCHAR(36) NOT NULL,
  INDEX `prescription_idx` (`prescription_id` ASC),
  INDEX `medicine_idx` (`medicine_id` ASC),
  PRIMARY KEY (`mp_id`),
  CONSTRAINT `fk_medicine__id`
    FOREIGN KEY (`medicine_id`)
    REFERENCES `cmr`.`medicine` (`medicine_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_prescription_id`
    FOREIGN KEY (`prescription_id`)
    REFERENCES `cmr`.`prescription` (`prescription_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;



/*疾病分类表：dis_id、名称*/
CREATE TABLE IF NOT EXISTS `cmr`.`disease_sort` (
  `dis_id` VARCHAR(36) NOT NULL,
  `dis_name` NVARCHAR(100) NULL,
  PRIMARY KEY (`dis_id`))
ENGINE = InnoDB;


/*疾病表：disease_id、名称、症状、病因、传染性、临床表现、诊断方法、dis_id*/
CREATE TABLE IF NOT EXISTS `cmr`.`disease` (
  `disease_id` VARCHAR(36) NOT NULL,
  `disease_name` NVARCHAR(100) NULL,
  `disease_symptom` NVARCHAR(2000) NULL,
  `Pathogeny` NVARCHAR(2000) NULL,
  `infectiousness` CHAR(4) NULL,
  `clinical_manifestation` NVARCHAR(2000) NULL,
  `diagnostic_method` NVARCHAR(500) NULL,
  `dis_id` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`disease_id`),
  INDEX `dis_idx` (`dis_id` ASC),
  CONSTRAINT `fk_dis_id`
    FOREIGN KEY (`dis_id`)
    REFERENCES `cmr`.`disease_sort` (`dis_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


/*方剂疾病表：pd_id、prescription_id、disease_id*/
CREATE TABLE IF NOT EXISTS `cmr`.`prescription_disease` (
  `prescription1_id` VARCHAR(36) NOT NULL,
  `disease1_id` VARCHAR(36) NOT NULL,
  `pd_id` VARCHAR(36) NOT NULL,
  INDEX `disease1_idx` (`disease1_id` ASC),
  INDEX `prescription1_idx` (`prescription1_id` ASC),
  PRIMARY KEY (`pd_id`),
  CONSTRAINT `fk_prescription1_id`
    FOREIGN KEY (`prescription1_id`)
    REFERENCES `cmr`.`prescription` (`prescription_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_disease1_id`
    FOREIGN KEY (`disease1_id`)
    REFERENCES `cmr`.`disease` (`disease_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;




/*医生分类：ds_id、时期*/
CREATE TABLE IF NOT EXISTS `cmr`.`doctor_sort` (
  `ds_id` VARCHAR(36) NOT NULL,
  `ds_age` NVARCHAR(100) NULL,
  PRIMARY KEY (`ds_id`))
ENGINE = InnoDB;



/*医生表:doctor_id、姓名、性别、出生地、个人专长、主要成就、图片、ds_id*/
CREATE TABLE IF NOT EXISTS `cmr`.`doctor` (
  `doctor_id` VARCHAR(36) NOT NULL,
  `doctor_name` NVARCHAR(100) NULL,
  `doctor_sex` CHAR(4) NULL,
  `doctor_birthplace` NVARCHAR(100) NULL,
  `doctor_achievement` NVARCHAR(2000) NULL,
  `doctor_specialty` NVARCHAR(500) NULL,
  `ds_id` VARCHAR(36) NOT NULL,
  `doctorc_img` BLOB NULL,
  PRIMARY KEY (`doctor_id`),
  INDEX `ds_idx` (`ds_id` ASC),
  CONSTRAINT `fk_ds_id`
    FOREIGN KEY (`ds_id`)
    REFERENCES `cmr`.`doctor_sort` (`ds_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;



/*医生疾病表：dd_id、doctor_id、disease_id*/
CREATE TABLE IF NOT EXISTS `cmr`.`doctor_disease` (
  `doctor_id` VARCHAR(36) NOT NULL,
  `disease_id` VARCHAR(36) NOT NULL,
  `dd_id` VARCHAR(36) NOT NULL,
  INDEX `disease_idx` (`disease_id` ASC),
  INDEX `doctor_idx` (`doctor_id` ASC),
  PRIMARY KEY (`dd_id`),
  CONSTRAINT `fk_doctor_id`
    FOREIGN KEY (`doctor_id`)
    REFERENCES `cmr`.`doctor` (`doctor_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_disease_id`
    FOREIGN KEY (`disease_id`)
    REFERENCES `cmr`.`disease` (`disease_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;



/*医院：hospital_id、名称、成立时间、医院等级、科室设置、地址*/
CREATE TABLE IF NOT EXISTS `cmr`.`hospital` (
  `hospital_id` VARCHAR(36) NOT NULL,
  `hospital_name` NVARCHAR(100) NOT NULL,
  `establish_time` DATE NULL,
  `hospital_grade` CHAR(10) NULL,
  `department` NVARCHAR(2000) NULL,
  `hospital_adress` NVARCHAR(100) NULL,
  PRIMARY KEY (`hospital_id`))
ENGINE = InnoDB;



/*疾病医院表：dh_id、disease2_id、hospital_id*/
CREATE TABLE IF NOT EXISTS `cmr`.`disease_hospital` (
  `disease2_id` VARCHAR(36) NOT NULL,
  `hospital_id` VARCHAR(36) NOT NULL,
  `dh_id` VARCHAR(36) NOT NULL,
  INDEX `hospital_idx` (`hospital_id` ASC),
  INDEX `disease2_idx` (`disease2_id` ASC),
  PRIMARY KEY (`dh_id`),
  CONSTRAINT `fk_disease2_id`
    FOREIGN KEY (`disease2_id`)
    REFERENCES `cmr`.`disease` (`disease_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_hospital_id`
    FOREIGN KEY (`hospital_id`)
    REFERENCES `cmr`.`hospital` (`hospital_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;



/*中医养生：health_id、名称*/
CREATE TABLE IF NOT EXISTS `cmr`.`health` (
  `health_id` VARCHAR(36) NOT NULL,
  `health_name` NVARCHAR(100) NULL,
  PRIMARY KEY (`health_id`))
ENGINE = InnoDB;


/*药膳分类（：mds_id、名称*/
CREATE TABLE IF NOT EXISTS `cmr`.`md_sort` (
  `mds_id` VARCHAR(36) NOT NULL,
  `mds_name` NVARCHAR(100) NOT NULL,
  PRIMARY KEY (`mds_id`))
ENGINE = InnoDB;


/*药膳：diet_id、名称、导语、图片、材料、做法、功效、注意*/
CREATE TABLE IF NOT EXISTS `cmr`.`diet` (
  `diet_id` VARCHAR(36) NOT NULL,
  `diet_name` NVARCHAR(100) NOT NULL,
  `diet_material` NVARCHAR(500) NULL,
  `diet_method` NVARCHAR(2000) NULL,
  `mds_id` VARCHAR(36) NOT NULL,
  `diet_introduction` NVARCHAR(2000) NULL,
  `diet_img` BLOB NULL,
  `diet_function` NVARCHAR(500) NULL,
  `diet_notice` NVARCHAR(2000) NULL,
  `health_id` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`diet_id`),
  INDEX `mds_idx` (`mds_id` ASC),
  INDEX `health_idx` (`health_id` ASC),
  CONSTRAINT `fk_mds_id`
    FOREIGN KEY (`mds_id`)
    REFERENCES `cmr`.`md_sort` (`mds_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_health_id`
    FOREIGN KEY (`health_id`)
    REFERENCES `cmr`.`health` (`health_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;





/*药茶：tea_id、名称、操作方法、功能、禁忌、ht_id*/
CREATE TABLE IF NOT EXISTS `cmr`.`tea` (
  `tea_id` INT NOT NULL,
  `tea_name` NVARCHAR(100) NULL,
  `tea_method` NVARCHAR(2000) NULL,
  `tea_fuction` NVARCHAR(500) NULL,
  `tea_taboo` NVARCHAR(100) NULL,
  `ht_id` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`tea_id`),
  INDEX `fk_ht_idx` (`ht_id` ASC),
  CONSTRAINT `fk_ht_id`
    FOREIGN KEY (`ht_id`)
    REFERENCES `cmr`.`health` (`health_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;



/*药浴分类：bs_id、名称*/
CREATE TABLE IF NOT EXISTS `cmr`.`bath_sort` (
  `bs_id` VARCHAR(36) NOT NULL,
  `bs_name` NVARCHAR(100) NULL,
  PRIMARY KEY (`bs_id`))
ENGINE = InnoDB;



/*药浴（bath）：bath_id、名称、材料和用量、方法、作用、注意事项、hb_id、bs_id*/
CREATE TABLE IF NOT EXISTS `cmr`.`bath` (
  `bath_id` VARCHAR(36) NOT NULL,
  `bath_name` NVARCHAR(100) NULL,
  `material_usage` NVARCHAR(500) NULL,
  `bath_method` NVARCHAR(500) NULL,
  `bath_fuction` NVARCHAR(100) NULL,
  `hb_id` VARCHAR(36) NOT NULL,
  `bs_id` VARCHAR(36) NOT NULL,
  `bath_notice` NVARCHAR(500) NULL,
  PRIMARY KEY (`bath_id`),
  INDEX `hb_idx` (`hb_id` ASC),
  INDEX `bs_idx` (`bs_id` ASC),
  CONSTRAINT `fk_hb_id`
    FOREIGN KEY (`hb_id`)
    REFERENCES `cmr`.`health` (`health_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_hs_id`
    FOREIGN KEY (`bs_id`)
    REFERENCES `cmr`.`bath_sort` (`bs_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;




/*书籍：book_id、名称、作者、概要、背景*/
CREATE TABLE IF NOT EXISTS `cmr`.`book` (
  `book_id` VARCHAR(36) NOT NULL,
  `book_name` NVARCHAR(100) NULL,
  `book_author` NVARCHAR(100) NULL,
  `summary` NVARCHAR(2000) NULL,
  `background` BLOB NULL,
  PRIMARY KEY (`book_id`))
ENGINE = InnoDB;



/*章节：chapter_id、名称、数目、book_id*/
CREATE TABLE IF NOT EXISTS `cmr`.`book_chapter` (
  `chapter_id` VARCHAR(36) NOT NULL,
  `chapter_name` NVARCHAR(100) NOT NULL,
  `book_id` VARCHAR(36) NOT NULL,
  `chapter_number` CHAR(4) NULL,
  PRIMARY KEY (`chapter_id`),
  INDEX `book_idx` (`book_id` ASC),
  CONSTRAINT `fk_book_id`
    FOREIGN KEY (`book_id`)
    REFERENCES `cmr`.`book` (`book_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;



/*文章：article_id、名称、内容、chapter_id*/
CREATE TABLE IF NOT EXISTS `cmr`.`book_article` (
  `article_id` VARCHAR(36) NOT NULL,
  `article_name` NVARCHAR(100) NOT NULL,
  `article_content` LONGTEXT NULL,
  `chapter_id` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`article_id`),
  INDEX `chapter_idx` (`chapter_id` ASC),
  CONSTRAINT `fk_chapter_id`
    FOREIGN KEY (`chapter_id`)
    REFERENCES `cmr`.`book_chapter` (`chapter_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB












