select A.imatge, A.nom, A.hora, S.aforament, M.nom, A.num_sala
from activitats A, sales S, monitors M
where A.num_sala=S.num_sala and S.num_sala=M.num_sala
order by imatge;