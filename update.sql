--
-- Update job --
ALTER TABLE `job`
ADD `app_date` VARCHAR(20) NOT NULL
AFTER `sub_emp_id`,
    ADD `app_time` VARCHAR(20) NOT NULL
AFTER `app_date`,
    ADD `type_name` VARCHAR(100) NOT NULL
AFTER `app_time`;
ALTER TABLE `job`
ADD `cus_name` VARCHAR(100) NOT NULL
AFTER `type_name`,
    ADD `emp_name` VARCHAR(100) NOT NULL
AFTER `cus_name`,
    ADD `sub_emp_name` VARCHAR(100) NOT NULL
AFTER `emp_name`;
ALTER TABLE `job`
ADD `price` DECIMAL(10, 2) NOT NULL
AFTER `advance`;
--
-- Product --
ALTER TABLE `product`
ADD `type_name` VARCHAR(100) NOT NULL
AFTER `job_type`;
--
-- Update payment --
ALTER TABLE `payment`
ADD `user_id` INT(11) NOT NULL
AFTER `reserve_date`,
    ADD `cashier` VARCHAR(100) NOT NULL
AFTER `user_id`;
--
-- Update job --
ALTER TABLE `job`
ADD `booking_user` INT NOT NULL
AFTER `order_no`,
    ADD `active_user` INT NOT NULL
AFTER `booking_user`,
    ADD `close_user` INT NOT NULL
AFTER `active_user`,
    ADD `cancel_user` INT NOT NULL
AFTER `close_user`,
    ADD `edit_user` INT NOT NULL
AFTER `cancel_user`;
--
-- Update attendance --
ALTER TABLE `attendance`
ADD `user_id` INT NOT NULL
AFTER `work_time`;
--
-- Update bank --
ALTER TABLE `bank`
ADD `ac_name` INT NOT NULL
AFTER `action`,
    ADD `dep_id` INT NOT NULL
AFTER `ac_name`,
    ADD `dep_name` INT NOT NULL
AFTER `dep_id`;
--
-- Update sales list --
ALTER TABLE `sales_list`
ADD `emp_commies` DECIMAL(10, 2) NOT NULL
AFTER `met_id`,
    ADD `sup_emp_commies` DECIMAL(10, 2) NOT NULL
AFTER `emp_commies`;
--
-- Update product --
ALTER TABLE `product`
ADD `emp_commies` DECIMAL(10, 2) NOT NULL
AFTER `brand`,
    ADD `sup_emp_commies` DECIMAL(10, 2) NOT NULL
AFTER `emp_commies`;