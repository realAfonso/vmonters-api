select 
	uhe.id AS id,
	uhe.user AS user,
	e.id AS eggId,
	e.specie AS specie,
	e.image AS image,
	e.title AS title,
	e.description AS description 
from 
	vms_user_has_eggs uhe,
	vms_eggs e
where 
	uhe.egg = e.id AND
	uhe.isOpened = 0