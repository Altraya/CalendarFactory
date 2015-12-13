CREATE TRIGGER `lessThan50` BEFORE INSERT ON `activite`
 FOR EACH ROW BEGIN
	declare i integer;
    declare c_v integer;
    declare c cursor for 
    select idActivite from activite
    where new.idAgenda = idAgenda 
    and DateDebut between new.DateDebut and new.DateDebut+to_date('7','D'); 
	
    open c;
    set i = 0;
    get_activite : loop
	fetch c into c_v;
    set i=i+1;
    end loop get_activite;
    
    if(i>50) then 
    	CALL raise_application_error(3001, 'no update');
    end if;
   
END