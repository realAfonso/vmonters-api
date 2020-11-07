select 
	a.id AS id,
	a.description AS description,
	a.image AS image,
	a.price AS price,
	a.startDate AS startDate,
	a.endDate AS endDate
from 
	vms_avatars a 
where 
	(a.status = 1) and 
	(a.isDefault = 0)
order by a.id desc