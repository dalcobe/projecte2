DROP TRIGGER IF EXISTS aforamentAct;
DELIMITER //
CREATE TRIGGER aforamentAct AFTER INSERT ON reserva_lliure FOR EACH ROW
BEGIN
 DECLARE sala integer;
 SET sala = (SELECT num_sala from sales where num_sala = (select numero_sala from activitats A where A.ID = (select ID from reserva_lliure R order by R.idreserva desc limit 1)));
 UPDATE sales
 SET aforament = aforament - 1 
 WHERE S.num_sala = sala;
END
//