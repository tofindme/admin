
-- radb 表设计 角色访问权限控制

CREATE DATABASE IF NOT EXISTS `admin` default character set utf8 COLLATE utf8_unicode_ci;
USE `admin`;

DROP TABLE IF EXISTS `yb_user`;
CREATE TABLE `yb_user`(
    `u_id` int(4) PRIMARY KEY AUTO_INCREMENT,
    `u_name` VARCHAR(100) NOT NULL COMMENT '用户名称',
    `u_pwd` VARCHAR(30) NOT NULL COMMENT '用户密码',
    `u_status` int(1) DEFAULT 0 NOT NULL COMMENT '用户状态 0 正常',
    UNIQUE KEY `user_uk` (`u_name`)
)ENGINE=InnoDB DEFAULT CHARSET utf8 COMMENT '用户表';
INSERT intO `yb_user`(u_id, u_name, u_pwd) VALUES(1, 'admin','admin');
INSERT intO `yb_user`(u_id, u_name, u_pwd) VALUES(2, 'test1','test1');
INSERT intO `yb_user`(u_id, u_name, u_pwd) VALUES(3, 'test2','test2');

DROP TABLE IF EXISTS `yb_role`;
CREATE TABLE IF NOT EXISTS `yb_role`(
    `r_id` int PRIMARY KEY AUTO_INCREMENT,
    `r_name` VARCHAR(150) NOT NULL COMMENT '角色名称',
    `r_status` int DEFAULT 0 NOT NULL COMMENT '角色状态 0 正常',
    UNIQUE KEY `role_uk` (`r_name`)
)ENGINE=InnoDB DEFAULT CHARSET utf8 COMMENT '角色表';
INSERT intO `yb_role`(r_id, r_name) VALUES(1, '超级管理员');
INSERT intO `yb_role`(r_id, r_name) VALUES(2, '第三方合作者');
INSERT intO `yb_role`(r_id, r_name) VALUES(3, '普通运营人员');
INSERT intO `yb_role`(r_id, r_name) VALUES(4, '小米渠道');

DROP TABLE IF EXISTS `yb_privilege`;
CREATE TABLE IF NOT EXISTS `yb_privilege`(
    `p_id` int(4)  PRIMARY KEY AUTO_INCREMENT,
    `p_pid` int(4) DEFAULT 0 NOT NULL COMMENT '所属父权限',
    `p_name` VARCHAR(100) NOT NULL COMMENT '权限名称',
    `p_addr` VARCHAR(256) NOT NULL COMMENT '权限对应的跳转',
    `p_status` int(1) DEFAULT 0 NOT NULL COMMENT '权限状态',
    `p_icon` VARCHAR(256) NOT NULL COMMENT '权限图标',
    UNIQUE KEY `priv_uk` (`p_id`, `p_pid`)
)ENGINE=InnoDB DEFAULT CHARSET utf8 COMMENT '权限表';
INSERT intO `yb_privilege`(p_id, p_pid, p_name, p_addr, p_icon) VALUES(1,0, '玩家留存分析', 'liucun/', 'icon1');
INSERT intO `yb_privilege`(p_id, p_pid, p_name, p_addr, p_icon) VALUES(2,0, '渠道管理', 'platform/', 'icon2');
INSERT intO `yb_privilege`(p_id, p_pid, p_name, p_addr, p_icon) VALUES(3,0, '付费统计', 'money/', '');
INSERT intO `yb_privilege`(p_id, p_pid, p_name, p_addr, p_icon) VALUES(4,0, '装备统计', 'item/', '');
INSERT intO `yb_privilege`(p_id, p_pid, p_name, p_addr, p_icon) VALUES(5,0, '玩家信息查询', 'user/', '');

INSERT intO `yb_privilege`(p_id, p_pid, p_name, p_addr, p_icon) VALUES(6,1, '15日留存', 'liucun/15', '');
INSERT intO `yb_privilege`(p_id, p_pid, p_name, p_addr, p_icon) VALUES(7,1, '活跃留存', 'liucun/online', '');

INSERT intO `yb_privilege`(p_id, p_pid, p_name, p_addr, p_icon) VALUES(8,2, 'oppo', 'platform/oppo', '');
INSERT intO `yb_privilege`(p_id, p_pid, p_name, p_addr, p_icon) VALUES(9,2, '华为', 'platform/huawei', '');
INSERT intO `yb_privilege`(p_id, p_pid, p_name, p_addr, p_icon) VALUES(10,2, '小米', 'platform/miui', '');
INSERT intO `yb_privilege`(p_id, p_pid, p_name, p_addr, p_icon) VALUES(11,2, '魅族', 'platform/meizu', '');


DROP TABLE IF EXISTS `yb_user_role`;
CREATE TABLE IF NOT EXISTS `yb_user_role`(
    `u_id` int(4) NOT NULL COMMENT '用户id',
    `r_id` int(4) NOT NULL COMMENT '角色id',
    `status` int(1) NOT NULL COMMENT '用户对应的角色状态 0 有此角色',
    UNIQUE KEY `user_role_uk` (`u_id`, `r_id`)
)ENGINE=InnoDB DEFAULT CHARSET utf8 COMMENT '用户->角色关系表';
INSERT intO `yb_user_role`(u_id, r_id) VALUES(1, 1);
INSERT intO `yb_user_role`(u_id, r_id) VALUES(2, 2);
INSERT intO `yb_user_role`(u_id, r_id) VALUES(3, 3);

DROP TABLE IF EXISTS `yb_role_pri`;
CREATE TABLE IF NOT EXISTS `yb_role_pri`(
    `r_id` int(4) NOT NULL COMMENT '角色id',
    `p_id` int(4) NOT NULL COMMENT '权限id',
    `status` int(1) NOT NULL COMMENT '角色对应的权限状态 0 有此权限',
    UNIQUE KEY `role_pri_uk` (`r_id`, `p_id`)
)ENGINE=InnoDB DEFAULT CHARSET utf8 COMMENT '角色->权限关系表';
INSERT intO `yb_role_pri`(r_id, p_id) VALUES(1, 1);
INSERT intO `yb_role_pri`(r_id, p_id) VALUES(1, 2);
INSERT intO `yb_role_pri`(r_id, p_id) VALUES(1, 3);
INSERT intO `yb_role_pri`(r_id, p_id) VALUES(1, 4);
INSERT intO `yb_role_pri`(r_id, p_id) VALUES(1, 5);

INSERT intO `yb_role_pri`(r_id, p_id) VALUES(2, 2);

INSERT intO `yb_role_pri`(r_id, p_id) VALUES(3, 5);

INSERT intO `yb_role_pri`(r_id, p_id) VALUES(4, 10);

