use cmr;

alter table medicine_sort change ms_sort `order` int;
alter table medicine_sort change ms_annotion`note` nvarchar(100),change ms_start createAt timestamp,change ms_end changeAt timestamp;
