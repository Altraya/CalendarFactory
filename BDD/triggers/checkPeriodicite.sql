CREATE TRIGGER `checkPeriodicite` AFTER INSERT ON `activite`
 FOR EACH ROW
begin 
	declare nbOcc_v integer;
    declare i integer;
    declare c_v integer;
    declare c cursor for 
    select idActivite from activite
    where new.idAgenda = idAgenda and 
    new.titre = titre and 
    new.description = description and 
    new.positionGeographique = positionGeographique;
    
    open c;
    set nbOcc_v = new.nbOccurence;
    set i = 0;
    get_activite : loop
	fetch c into c_v;
    set i=i+1;
    end loop get_activite;
    
    if(i <> nbOcc_v) then
    	CALL raise_application_error(3001, 'no update');
    end if;
end