create table test(id integer, date integer, amount integer);

insert into test(id, date, amount) values(1, 1, 1);
insert into test(id, date, amount) values(2, 2, 2);
insert into test(id, date, amount) values(6, 3, -1);
insert into test(id, date, amount) values(8, 4, 2);
insert into test(id, date, amount) values(7, 5, -6);
insert into test(id, date, amount) values(9, 6, 1);
insert into test(id, date, amount) values(3, 7, -5);
insert into test(id, date, amount) values(4, 8, 1);
insert into test(id, date, amount) values(5, 9, 7);

# BEFORE MYSQL 8

SELECT id 
FROM (
  SELECT t.id,
       @total := @total + t.amount AS total
  FROM
  ( SELECT
    id,
    amount
    FROM test
    ORDER BY date ) t
  JOIN (SELECT @total:=0) total_calculation
) with_total 
WHERE total < 0 
LIMIT 1;

# USING MYSQL 8 WINDOW FUNCTIONS

SELECT id 
FROM (
  SELECT id, SUM(amount) OVER (ORDER BY date) AS total 
  FROM test) with_total
WHERE total < 0 
LIMIT 1;