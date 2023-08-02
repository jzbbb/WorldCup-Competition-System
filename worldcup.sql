/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2022/12/6 15:49:40                           */
/*==============================================================*/
-- 导入失败就直接复制全部代码到mysql运行


DROP DATABASE IF EXISTS worldcup;

CREATE DATABASE IF NOT EXISTS worldcup;

USE worldcup;

DROP TABLE IF EXISTS Player;

DROP TABLE IF EXISTS EVENTs;

DROP TABLE IF EXISTS game;

DROP TABLE IF EXISTS team;

DROP TABLE IF EXISTS USER;



/*==============================================================*/
/* Table: user                                                  */
/*==============================================================*/

CREATE TABLE user  (
   userId               bigint(20) NOT NULL AUTO_INCREMENT comment '用户id（递增排序）',
   userName             varchar(15) not null comment '用户姓名',
   userPassword         varchar(15) not null comment '用户密码',
   userRole             int      default 2 comment '用户角色（1：管理员，2：普通用户）',
   voteTeam             VARCHAR(10) default "无" comment '支持队伍名字',
   gender               int(10)  default 0 comment '性别（1:男、 2:女）',
   age                  int(10)  default 0 comment '年龄',
   birthday             date   comment '出生日期',
   phone                varchar(15) default 0 comment '手机号',
   address              varchar(30) default "无" comment '地址',
   createdBy             bigint(20)  default 1 comment '创建者（userId）',
   primary key(userId),
   FOREIGN KEY(createdBy) REFERENCES user(userId)
) ;
insert into user(userId,userName,userPassword,userRole) values(1,"lbwnb","123456",1);

/*==============================================================*/
/* Table: Team                                                  */
/*==============================================================*/
CREATE TABLE Team
(
   teamId              bigint(20) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
   teamName            VARCHAR(10) default "无" comment '队伍名字',
   teamDesc            VARCHAR(300) default "无" comment '队伍描述',
   worldRank           INT default 0 comment '队伍世界排名',
   groupNo             CHAR(1) default 0 comment '所在小组（a-h）',
   groupPoint          INT default 0 comment '小组积分',
   groupRank           INT default 0 comment '小组排名',
   wins                 INT default 0 comment '胜场数',
   draws                INT default 0 comment '平局数',
   fails                INT default 0 comment '败局数',
   goals                INT default 0 comment '进球数',
   coach                VARCHAR(20)  default '无' comment '教练名',
   bestPlayerId         varchar(20) default 1 comment '最佳球员',
   winRate              float default 0 comment'夺冠胜率（%表示）',
   createdBy            bigint(20) default 1 COMMENT '创建者id',
   FOREIGN KEY(createdBy) REFERENCES user(userId),
   PRIMARY KEY (teamId)
);
insert into team(teamId,teamName,teamDesc) values(1,"无","无");
/*==============================================================*/
/* Table: Player                                                */
/*==============================================================*/
CREATE TABLE Player
(
   player_id            bigint(20) NOT NULL AUTO_INCREMENT comment '球员id编号（主键）',
   player_name          VARCHAR(30) comment '球员名字',
   player_desc          VARCHAR(300) default "无" comment '球员描述',
   player_age           int  comment '球员球衣号码',
   player_num           INT  comment '球员年龄',
   height               int  comment'球员身高',
   player_club          VARCHAR(30) comment '球员效力俱乐部',
   player_salary        int default 0 comment '球员年薪，单位:万欧元',
   player_pos           VARCHAR(20) comment '球员位置/司职',
   player_score         INT default 0 comment '球员进球数',
   birth_date           DATE default "2000-01-01" comment '球员生日',
   team_id              int default 1 comment '球队编号',
   createBy             INT default 1 comment '创建者id',
   PRIMARY KEY (player_id),
   FOREIGN KEY(createBy) REFERENCES user(userId),
   FOREIGN KEY(team_id) REFERENCES team(teamId)
);
insert into player(player_id,player_name) values(0,"无");

/*==============================================================*/
/* Table: game                                                  */
/*==============================================================*/
CREATE TABLE game
(
   game_id              bigint(20) NOT NULL AUTO_INCREMENT comment '比赛id',
   home_team_id         bigint(20) comment '主队id',
   guest_team_id        bigint(20) comment '客队id',
   home_score           INT default 0 comment '主队进球数',
   guest_score           INT default 0 comment '客队进球数',
   game_type            CHAR(1) default 1 comment '比赛类型（1：小组赛，2：淘汰赛）',
   begin_time           DATETIME comment '比赛开始时间',
   end_time             DATETIME comment '比赛结束时间',
   game_logo              INT default 1 comment  '比赛标志（1：未开始，2：结束）',
   COMMENT              VARCHAR(300) default "无" comment '比赛描述',
   createBy             INT default 1 comment '创建者id',
   PRIMARY KEY (game_id),
   FOREIGN KEY(createBy) REFERENCES user(userId),
   FOREIGN KEY(home_team_id) REFERENCES team(teamId),
   FOREIGN KEY(guest_team_id) REFERENCES team(teamId)
);

/*==============================================================*/
/* Table: events                                                 */
/*==============================================================*/
CREATE TABLE EVENTS
(
   events_id            bigint(20) NOT NULL AUTO_INCREMENT comment '事件编号',
   game_id              bigint(20) default 1 comment '比赛id',
   team_id              bigint(20) default 1 comment '队伍id',
   player_id            bigint(20) default 1 comment '球员id',
   events_time           DATETIME comment '事件发生时间',
   createBy             bigint(20) default 1 comment '创建者id',
   PRIMARY KEY (events_id),
   FOREIGN KEY(createBy) REFERENCES user(userId),
   FOREIGN KEY(player_id) REFERENCES player(player_id),
   FOREIGN KEY(game_id) REFERENCES game(game_id),
   FOREIGN KEY(team_id) REFERENCES team(teamId)
);

alter table team add constraint FK_Reference_16 foreign key (bestPlayerId)
references Player (player_id) on delete restrict on update restrict;


/*==============================================================*/
/* Trigger                                                      */
/*==============================================================*/

-- 实时更新球员球队进球数
delimiter $$
CREATE TRIGGER events_score
	AFTER INSERT
	ON events
	FOR EACH ROW
BEGIN
	UPDATE player
	SET player_score = player_score + 1
	WHERE player_id = NEW.player_id;
	UPDATE team
	SET goals = goals + 1
	WHERE teamId = NEW.team_id;
   update game
   set home_score=home_score+1
   where game_id=new.game_id and home_team_id=new.team_id;
   update game
   set guest_score=guest_score+1
   where game_id=new.game_id and guest_team_id=new.team_id;
END $$
delimiter ;



/*==============================================================*/
/* PROCEDURE                                                      */
/*==============================================================*/

-- 原本设想通过game表的game_logo来标记一场比赛是否结束，如果更新game_logo的值为2就触发一个触发器，用来更新本场比赛结束后两队的胜负，并将
-- 其胜负平的情况同步更新到team表的wins，draws， fails字段，但会报错，原因是在game表上建立update触发器来更新team表的字段，就会调用上面
-- 建立的game_score触发器，就会报错一个可能会循环执行的错误，所以放弃了在game表上建立触发器的想法，改为创建一个存储过程来手动更新胜负


-- DROP TRIGGER IF EXISTS game_score;
-- -- 实时更新game比赛表中的进球信息
-- delimiter $$
-- CREATE PROCEDURE game_score(gameid bigint(20))
-- BEGIN
-- DECLARE logo int;
-- SELECT game_logo into logo from game where game_id=gameid;
-- IF(game_logo=1) THEN
-- 	UPDATE game
-- 	SET home_score = home_score + 1
-- 	WHERE home_team_id = new.teamId;
-- 	UPDATE game
-- 	SET guest_score = guest_score + 1
-- 	WHERE guest_team_id = new.teamId;
-- END IF;
-- END $$
-- delimiter ;

-- 存储过程update_wins，用来更新比赛结束后每只球队的胜负情况
DROP PROCEDURE IF EXISTS update_wins;
CREATE PROCEDURE update_wins (
	gameid bigint(20)
)
BEGIN
	DECLARE home_id bigint(20);
	DECLARE guest_id bigint(20);
	DECLARE homescore int;
	DECLARE guestscore int;
	SELECT home_team_id, guest_team_id, home_score, guest_score
	INTO home_id, guest_id, homescore, guestscore
	FROM game
	WHERE game_id = gameid;
	IF homescore > guestscore THEN
		UPDATE team
		SET wins = wins + 1
		WHERE teamId = home_id;
		UPDATE team
		SET fails = fails + 1
		WHERE guest_id = teamId;
	ELSEIF homescore < guestscore THEN
		UPDATE team
		SET wins = wins + 1
		WHERE teamId = guest_id;
		UPDATE team
		SET fails = fails + 1
		WHERE teamId = home_id;
	ELSE 
		UPDATE team
		SET draws = draws + 1
		WHERE teamId = guest_id;
		UPDATE team
		SET draws = draws + 1
		WHERE teamId = home_id;
	END IF;
END;

-- 存储过程update_point，用来更新每场比赛结束后所有球队的小组积分
DROP PROCEDURE IF EXISTS update_point;
CREATE PROCEDURE update_point ()
BEGIN
	UPDATE team
	SET groupPoint = 3 * wins + draws;
END;

-- 存储过程update_rank，用来分组计算各个球队所在的小组排名
DROP PROCEDURE IF EXISTS update_rank;

CREATE PROCEDURE update_rank ()
BEGIN
	SET @pre = 0;
	SET @row = 0;
	SET @curGroup = '0';
	UPDATE team a
		INNER JOIN (
			SELECT teamId, goals, groupPoint, groupNo
				, CASE 
					WHEN @curGroup = groupNo THEN @row := @row + 1
					WHEN @curGroup <> groupNo THEN @row := 1
				END AS urank, @curGroup := groupNo, @pre := groupPoint
			FROM team
			ORDER BY groupNo DESC, groupPoint DESC, goals DESC
		) b
		ON a.teamId = b.teamId
	SET a.groupRank = b.urank;
END;


