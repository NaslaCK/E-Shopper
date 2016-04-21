-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2016 at 07:02 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `e_shopper`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `csp_delete_category`(in id int)
begin
declare done int default 0;
declare continue handler for sqlexception,sqlwarning set done=1;

start transaction;
delete from tbl_category where pk_int_cat_id=id;
delete from tbl_sub_category where fk_int_cat_id=id;
if done=0 then
COMMIT;
else
ROLLBACK;
end if;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `csp_delete_product`(in id int)
begin
delete from tbl_product where pk_int_product_id=id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `csp_delete_sub_category`(in id int)
begin
delete from tbl_sub_category where pk_int_sub_id=id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `csp_insert_category`(in vchr_cat_name varchar(20))
begin
insert into tbl_category(vchr_cat_name) values (vchr_cat_name);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `csp_insert_product`(IN `vchr_product_name` VARCHAR(20), IN `int_price` INT(11), IN `vchr_desc` VARCHAR(100), IN `int_quantity` INT(11), IN `fk_int_sub_id` INT(11), IN `selling_price` INT(11), IN `pro_image` VARCHAR(20), IN `side_view` VARCHAR(20))
begin
declare a int default 0;
declare b int default 0;

start transaction;
insert into tbl_product(vchr_product_name,int_price,vchr_desc,fk_int_sub_id,int_selling_price,vchr_product_image,vchr_product_side_view) values (vchr_product_name,int_price,vchr_desc,fk_int_sub_id,selling_price,pro_image,side_view);
set a=last_insert_id();
insert into tbl_stock(fk_int_product_id,int_quantity) values (a,int_quantity);
set b=last_insert_id();
if(a>0 && b>0) then
commit;
else
rollback;
end if;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `csp_insert_purchase`(IN `fk_int_product_id` INT(11), IN `quantity` INT(11), IN `int_total_amount` INT(11), IN `fk_int_login_id` INT(11))
begin
declare done int default 0;
declare amt int;
declare dat_date date default CURDATE();
declare exit handler for sqlexception,sqlwarning set done=1;

start transaction;
set dat_date=CURDATE();
set amt=int_total_amount*quantity;
insert into tbl_purchase(fk_int_product_id,int_quantity,int_total_amount,dat_date,fk_int_login_id) values (fk_int_product_id,quantity,amt,dat_date,fk_int_login_id);

update tbl_stock  set int_quantity=int_quantity-quantity where fk_int_product_id=fk_int_product_id;
if done=0 then
commit;
else 
rollback;
end if;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `csp_insert_sub_category`(in vchr_sub_name varchar(20),in fk_int_cat_id int)
begin
insert into tbl_sub_category(vchr_sub_name,fk_int_cat_id) values (vchr_sub_name,fk_int_cat_id);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `csp_reg_log`(in fnm varchar(20),in lnm varchar(20),in email varchar(20),in password varchar(20))
begin
declare done int default 0;
declare a int default 0;
declare dat date;
declare status varchar(20) default 'Active';
declare continue handler for sqlexception,sqlwarning set done=1;

start transaction;
insert into tbl_login(vchr_email,vchr_password,fk_int_user_role_id) values (email,password,2);
set a=last_insert_id();
set dat=CURDATE();
insert into tbl_registration(vchr_fname,vchr_lname,fk_int_login_id,dat_date,vchr_status) 
values(fnm,lnm,a,dat,status);
if done=0 then
COMMIT;
else
ROLLBACK;
end if;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `csp_suspend_customer`(in id int)
begin
update tbl_registration set vchr_status='Inactive' where pk_int_reg_id=id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `csp_update_category`(id int,name varchar(20))
begin
update tbl_category set vchr_cat_name=name where pk_int_cat_id=id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `csp_update_product`(IN `id` INT(11), IN `name` VARCHAR(20), IN `price` INT(11), IN `descr` VARCHAR(50), IN `quantity` INT(11))
begin
declare done int default 0;
declare exit handler for sqlexception,sqlwarning set done=1;

START TRANSACTION;
update tbl_product set vchr_product_name=name,int_price=price,vchr_desc=descr
where pk_int_product_id=id;
update tbl_stock set int_quantity=quantity where fk_int_product_id=id;
if done=0 then
COMMIT;
else
ROLLBACK;
end if;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `csp_update_sub_category`(id int,name varchar(20))
begin
update tbl_sub_category set vchr_sub_name=name where pk_int_sub_id=id;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `pk_int_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `vchr_cat_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`pk_int_cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`pk_int_cat_id`, `vchr_cat_name`) VALUES
(1, 'Shoes'),
(2, 'Bags'),
(3, 'SunGlasses'),
(4, 'Backpack');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE IF NOT EXISTS `tbl_login` (
  `pk_int_login_id` int(11) NOT NULL AUTO_INCREMENT,
  `vchr_email` varchar(20) DEFAULT NULL,
  `vchr_password` varchar(20) DEFAULT NULL,
  `fk_int_user_role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`pk_int_login_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`pk_int_login_id`, `vchr_email`, `vchr_password`, `fk_int_user_role_id`) VALUES
(1, 'naslack@gmail.com', 'admin', 1),
(2, 'neha@gmail.com', 'neha', 2),
(3, 'asr@gmail.com', 'arnav', 2),
(4, 'kkg@gmail.com', 'khushi', 2),
(5, 'sj@yahoo.com', 'rs', 2),
(6, 'aswathy@gmail.com', 'aswathy', 2),
(7, 'shashi@gmail.com', 'shashi', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE IF NOT EXISTS `tbl_product` (
  `pk_int_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `vchr_product_name` varchar(20) DEFAULT NULL,
  `int_price` int(11) DEFAULT NULL,
  `vchr_desc` varchar(100) DEFAULT NULL,
  `fk_int_sub_id` int(11) DEFAULT NULL,
  `int_selling_price` int(11) DEFAULT NULL,
  `vchr_product_image` varchar(20) DEFAULT NULL,
  `vchr_product_side_view` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`pk_int_product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`pk_int_product_id`, `vchr_product_name`, `int_price`, `vchr_desc`, `fk_int_sub_id`, `int_selling_price`, `vchr_product_image`, `vchr_product_side_view`) VALUES
(1, 'Club Master', 10400, 'Design in black frames with a crystal green glass.', 2, 10000, 'rbclubmaster.jpg', 'abc.jpg'),
(2, 'Versace VE2120', 10000, 'Sunglasses on a rare gold coloured frame.', 3, 9800, 'versaceVE2120.jpg', 'abc.jpg'),
(3, 'Versace VE2140', 13600, 'Cutting-edge shield style features a frontal decor of Versace''s iconic laser-engraved Greek Key with', 3, 13000, 'versaceVE2140.jpg', 'abc.jpg'),
(4, 'Oakley 313', 6500, 'Sports glasses.', 4, 6000, 'oakley313.jpg', 'abc.jpg'),
(5, 'Prada PR10OS', 15500, 'Plastic frame, Plastic Green lenses.', 5, 15000, 'pradaPR.jpg', 'abc.jpg'),
(6, 'Prada PR13SS', 16500, 'A frame which is medium havana and has a lens which is graduated grey. ', 5, 16000, 'pradaPR13SS.jpg', 'abc.jpg'),
(7, 'Prada BG110', 8500, 'Elegant violet leather bag with golden works.', 6, 9000, 'pradaBG110.jpg', 'abc.jpg'),
(8, 'Prada BG111', 5000, 'Elegant brown leather bag.', 6, 5000, 'PradaBG111.jpg', 'abc.jpg'),
(9, 'NIKE BP100', 2500, 'Sports backpack.', 8, 2300, 'NikeBP100.jpeg', 'abc.jpg'),
(10, 'Nike Air Zoom', 6000, 'Grey mesh sports shoes.', 1, 5600, 'nikeshoe100.jpeg', 'abc.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase`
--

CREATE TABLE IF NOT EXISTS `tbl_purchase` (
  `pk_int_purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_int_product_id` int(11) DEFAULT NULL,
  `int_quantity` int(11) DEFAULT NULL,
  `int_total_amount` int(11) DEFAULT NULL,
  `dat_date` date DEFAULT NULL,
  `fk_int_login_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`pk_int_purchase_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tbl_purchase`
--

INSERT INTO `tbl_purchase` (`pk_int_purchase_id`, `fk_int_product_id`, `int_quantity`, `int_total_amount`, `dat_date`, `fk_int_login_id`) VALUES
(1, 6, 1, 16000, '2016-03-18', 2),
(2, 3, 1, 13000, '2016-03-18', 3),
(3, 5, 1, 15000, '2016-03-28', 2),
(4, 1, 1, 10000, '2016-04-05', 2),
(5, 9, 1, 2300, '2016-04-05', 6),
(6, 2, 3, 9800, '2016-04-11', 2),
(7, 2, 3, 9800, '2016-04-11', 2),
(8, 2, 3, 9800, '2016-04-11', 2),
(9, 3, 1, 13000, '2016-04-11', 2),
(10, 1, 1, 10000, '2016-04-11', 6),
(11, 1, 1, 10000, '2016-04-11', 6),
(12, 3, 2, 26000, '2016-04-11', 6),
(13, 3, 2, 26000, '2016-04-11', 6),
(14, 1, 1, 10000, '2016-04-13', 6),
(15, 7, 1, 9000, '2016-04-13', 2),
(16, 7, 1, 9000, '2016-04-18', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_registration`
--

CREATE TABLE IF NOT EXISTS `tbl_registration` (
  `pk_int_reg_id` int(11) NOT NULL AUTO_INCREMENT,
  `vchr_fname` varchar(20) DEFAULT NULL,
  `vchr_lname` varchar(20) DEFAULT NULL,
  `fk_int_login_id` int(11) DEFAULT NULL,
  `dat_date` date DEFAULT NULL,
  `vchr_status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`pk_int_reg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_registration`
--

INSERT INTO `tbl_registration` (`pk_int_reg_id`, `vchr_fname`, `vchr_lname`, `fk_int_login_id`, `dat_date`, `vchr_status`) VALUES
(1, 'Neha', 'Abdulla', 2, '2016-02-18', 'Active'),
(2, 'Arnav Sing', 'Raizada', 3, '2016-02-24', 'Active'),
(3, 'Khushi Sing', 'Raizada', 4, '2016-02-24', 'Inactive'),
(4, 'shyam', 'Jha', 5, '2016-02-24', 'Inactive'),
(5, 'Aswathy', 'S Das', 6, '2016-03-29', 'Active'),
(6, 'Shashi', 'Gupta', 7, '2016-04-15', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock`
--

CREATE TABLE IF NOT EXISTS `tbl_stock` (
  `pk_int_stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_int_product_id` int(11) DEFAULT NULL,
  `int_quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`pk_int_stock_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_stock`
--

INSERT INTO `tbl_stock` (`pk_int_stock_id`, `fk_int_product_id`, `int_quantity`) VALUES
(1, 1, 4),
(2, 2, 1),
(3, 3, 7),
(4, 4, 5),
(5, 5, 6),
(6, 6, 4),
(7, 7, 8),
(8, 8, 9),
(9, 9, 5),
(10, 10, 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sub_category`
--

CREATE TABLE IF NOT EXISTS `tbl_sub_category` (
  `pk_int_sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `vchr_sub_name` varchar(20) DEFAULT NULL,
  `fk_int_cat_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`pk_int_sub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_sub_category`
--

INSERT INTO `tbl_sub_category` (`pk_int_sub_id`, `vchr_sub_name`, `fk_int_cat_id`) VALUES
(1, 'NIKE', 1),
(2, 'Ray-Ban', 3),
(3, 'Versace', 3),
(4, 'Oakley', 3),
(5, 'Prada', 3),
(6, 'Prada', 2),
(7, 'Dolce & Gabbana', 2),
(8, 'NIKE', 4),
(9, 'DELL', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_role`
--

CREATE TABLE IF NOT EXISTS `tbl_user_role` (
  `pk_int_user_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `vchr_username` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`pk_int_user_role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_user_role`
--

INSERT INTO `tbl_user_role` (`pk_int_user_role_id`, `vchr_username`) VALUES
(1, 'Admin'),
(2, 'Customer');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
