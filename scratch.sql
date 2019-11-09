-- this is just some crude sql that has been working okay for me. I'll try to maintain an up to date list of the queries over here, before they get all chopped up in dbTdFuncs.php, indexE.php and indexB.php


insert into availability (`Name`, `Date`, `is`, `1`, `2`, `5`, `6`) values ('tuyg', '2019-11-10', 0, 1 , 1 , 1 , 1 ) on duplicate key update `1`=1,`2`=1,`5`=1,`6`=1,`is`=0;

select count(*) as c from (select * from availability where `Name` = 'tuyg' and `6`=1) as a where (a.`is` = 1 and a.date <= '2019-11-03') or (date = '2019-11-03' );



#IS THIS PERSON AVAILABLE THIS DAY, appears to work
select count(*) as c from
              (select * from availability where `Name` = 'tuyg' and `6`=1) as a
where (a.`is` = 1 and a.date <= '2019-11-03')
                              or
                                 (date = '2019-11-03' );



#AVAIL INSERTION, WORKS!
INSERT INTO availability (`Name`, `Date`, `is`, `6`)
VALUES ('tuyg', '2019-11-03', 0, 1)
 on duplicate key update `6`=1, `is`=0;




#get the most recent default that is not newer than the current sundate
SELECT CASE
    WHEN availability.Date = '2019-11-03' and `1` = 1 then 'gamma'
    when true then true
else true
end
  from availability
where
true;

# get the names of the people available today
select name from availability  where date='2019-11-03' or `is`=0 and `1`=1
union
(select name from availability where date <= '2019-11-03' and `IS`=1 and `1`=1 group by date limit 1 )
                                         ;

select * from availability;

#unfinished
INSERT INTO explicitSchedule (bizName, monDate, `is`)values ('november', '2019-11-03', 0);






#SET TRUE PERSON AVAILABLE


# WHO IS AVAILABLE
SELECT  DISTINCT OUTERSET.INNERSET AS EMPLOYEES FROM (SELECT DATE, `is`, CASE WHEN `1`='1' THEN `NAME` END as INNERSET FROM availability
WHERE date = '2019-11-03' OR isDefault != 0) as OUTERSET;
;

# HOW MANY ARE AVAILABLE?
#everybody in this week where they are available on monday of the given date (which represents the sunday of the week.
# should also match on the bizName
SELECT sum(
               CASE
                   WHEN `1` = '1' THEN 1
                   end
           )
as k
from availability
where
      case
      when true then `date` = '2019-11-03'
END;



# WHEN `7` = '1' THEN '7'
# WHEN `2` = '1' THEN '2'
#         WHEN `3` = '1' THEN '3'
#         WHEN `4` = '1' THEN '4'
#         WHEN `5` = '1' THEN '5'
#         WHEN `6` = '1' THEN '6'