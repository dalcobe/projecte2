DELIMITER //
CREATE PROCEDURE data_Reserva(IN hora_ TIME,in dia_semana int(1), OUT _retorno INT)
BEGIN
SET _retorno = 1;
IF dia_semana > (DAYOFWEEK(current_date())+1) or dia_semana < (DAYOFWEEK(current_date())) or current_time() > DATE_SUB(hora_, INTERVAL 1 HOUR) or current_time() > DATE_ADD(hora_, INTERVAL 1 DAY)THEN
SET _retorno = 0;
 END IF;
END
//


# CREATE PROCEDURE data_Reserva(IN hora_ TIME,in dia_semana int(1), OUT _retorno INT)
# IF dia_semana > (DAYOFWEEK(current_date())+1) and hora_>current_time() THEN