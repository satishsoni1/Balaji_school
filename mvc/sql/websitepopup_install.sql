-- Website popup module: table, Admin permissions, menu entry and a starter
-- "Admissions open" popup. Safe to run more than once.

CREATE TABLE IF NOT EXISTS `websitepopup` (
  `websitepopupID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `badge` varchar(60) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `button_text` varchar(60) DEFAULT NULL,
  `button_link` varchar(500) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `frequency` varchar(20) NOT NULL DEFAULT 'daily',
  `show_on` varchar(20) NOT NULL DEFAULT 'home',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `create_date` datetime DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `create_userID` int(11) DEFAULT NULL,
  `create_usertypeID` int(11) DEFAULT NULL,
  PRIMARY KEY (`websitepopupID`),
  KEY `status_dates` (`status`, `start_date`, `end_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `permissions` (`description`, `name`, `active`)
SELECT 'Website Popup', 'websitepopup', 'yes' FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `permissions` WHERE `name` = 'websitepopup');
INSERT INTO `permissions` (`description`, `name`, `active`)
SELECT 'Website Popup Add', 'websitepopup_add', 'yes' FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `permissions` WHERE `name` = 'websitepopup_add');
INSERT INTO `permissions` (`description`, `name`, `active`)
SELECT 'Website Popup Edit', 'websitepopup_edit', 'yes' FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `permissions` WHERE `name` = 'websitepopup_edit');
INSERT INTO `permissions` (`description`, `name`, `active`)
SELECT 'Website Popup Delete', 'websitepopup_delete', 'yes' FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `permissions` WHERE `name` = 'websitepopup_delete');

-- Admin role (usertypeID 1) gets all four.
INSERT INTO `permission_relationships` (`permission_id`, `usertype_id`)
SELECT p.`permissionID`, 1 FROM `permissions` p
WHERE p.`name` IN ('websitepopup', 'websitepopup_add', 'websitepopup_edit', 'websitepopup_delete')
  AND NOT EXISTS (SELECT 1 FROM `permission_relationships` r WHERE r.`permission_id` = p.`permissionID` AND r.`usertype_id` = 1);

-- Menu item under "Frontend" (menuID 95).
INSERT INTO `menu` (`menuName`, `link`, `icon`, `pullRight`, `status`, `parentID`, `priority`)
SELECT 'websitepopup', 'websitepopup', 'fa-clone', '', 1, 95, 900 FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM `menu` WHERE `link` = 'websitepopup');

-- Starter popup (only when the table is empty).
INSERT INTO `websitepopup` (`title`, `badge`, `message`, `image`, `button_text`, `button_link`, `start_date`, `end_date`, `frequency`, `show_on`, `status`, `create_date`, `modify_date`, `create_userID`, `create_usertypeID`)
SELECT 'Admissions open — Nursery to 10th', 'Admissions open',
'Give your child a full English medium education at Shri Balaji English Primary & Secondary School, Wadegaon.\n\n• Spacious building with 30 rooms and a large playground\n• Free computer lab and digital classroom\n• Trained, well educated and experienced teachers\n• Admission as per the RTE Act (25%)\n\nVisit the school office or call +91 96040 44131.',
'popup-admissions.jpg', 'Enquire now', 'contact-us.php', CURDATE(), NULL, 'daily', 'home', 1, NOW(), NOW(), 1, 1
FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM `websitepopup`);
