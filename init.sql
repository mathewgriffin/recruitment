SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `customers`
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `address` varchar(255) NULL,
  `twitter_alias` varchar(255) NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `bookings`
-- ----------------------------
DROP TABLE IF EXISTS `bookings`;
CREATE TABLE `bookings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `reference` varchar(15) NOT NULL,
  `date` DATETIME NOT NULL,
  PRIMARY KEY  (`id`),
  INDEX (`customer_id`),
  CONSTRAINT
    `booking_customer_fk`
    FOREIGN KEY (`customer_id`)
    REFERENCES `customers`(`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

INSERT INTO `customers` (id, first_name, last_name, address) VALUES
(1, 'Jim', 'Edwards', '23 Where I live, Liverpool, L1 3TF'),
(2, 'Dave', 'Maher', '24 My House, Manchester, M1 3TF'),
(3, 'Susan', 'Lewis', '25 Skelmer Road, London, LN1 3TF'),
(4, 'Lorraine', 'Taylor', '26 Palm Avenue, Newcastle, N1 3TF');

INSERT INTO `bookings` (customer_id, reference, date) VALUES
(1, 'JE122', '2017-01-01'),
(1, 'JE125', '2017-03-02'),
(4, 'LT478', '2017-02-15'),
(4, 'LT791', '2017-04-01');
