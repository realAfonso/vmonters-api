select 
	she.id AS id,
	she.specie AS previous,
	s.id AS specie,
	s.name AS name,
	s.image AS image,
	s.type1 AS type1,
	s.type2 AS type2,
	she.data_neutral AS data_neutral,
	she.data_courage AS data_courage,
	she.data_friendship AS data_friendship,
	she.data_love AS data_love,
	she.data_knowledge AS data_knowledge,
	she.data_sincerity AS data_sincerity,
	she.data_reliability AS data_reliability,
	she.data_hope AS data_hope,
	she.data_light AS data_light,
	she.data_kindness AS data_kindness,
	she.data_destiny AS data_destiny,
	she.data_miracles AS data_miracles,
	she.item AS item 
from 
	vms_specie_has_evolutions she, 
	vms_species s
where 
	she.evolution = s.id