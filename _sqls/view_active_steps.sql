select 
	mhs.id AS id,
	mhs.monster AS monster,
	s.name AS name,
	s.image AS image,
    s.id AS specie,
    uhs.user AS user
from 
	vms_monster_has_step mhs,	 
	vms_species s,
    vms_user_has_species uhs
where 
	mhs.specie = s.id AND
    uhs.id = mhs.monster