alter table customer
modify id int primary key auto_increment;

alter table customer
modify note varchar(200) null;

alter table bills
modify id int primary key auto_increment;

alter table bill_detail
modify id int primary key auto_increment;

select * from customer;
select * from bills;
select * from bill_detail;