select S1.nom, S1.descripcio, S1.hora
from activitats S1
where S1.ID = (select *
				from activitat_col·lectiva S2
				where S1.ID = S2.ID);