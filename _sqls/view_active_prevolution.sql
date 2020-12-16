select 
	she.id AS id,
	she.evolution AS evolution,
	s.id AS specie,
	s.name AS name,
	s.image AS image,
	s.type1 AS type1,
	s.type2 AS type2 
from 
	vms_specie_has_evolutions she, 
	vms_species s
where 
	she.specie = s.id