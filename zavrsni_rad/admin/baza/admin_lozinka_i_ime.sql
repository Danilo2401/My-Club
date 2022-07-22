insert into admin_panel.admin_log(ime,lozinka) values ("Admin","admin123");
select * from admin_panel.admin_log;

select * from admin_panel.admin_log where  ime = "Admin" and lozinka = "admin123";