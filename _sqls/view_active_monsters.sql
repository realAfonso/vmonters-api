SELECT 
	uhs.id as id, 
    uhs.user as user, 
    uhs.name as name, 
    s.name as specie, 
    s.image as image,
    s.level as level,
    s.attribute as attribute,
    s.type1,
    s.type2,
    s.hp,
    s.atk,
    s.def,
    s.spatk,
    s.spdef,
    s.spd,
    s.rarity,
    uhs.buddy as isBuddy
FROM 
    vms_user_has_species uhs, 
    vms_species s 
WHERE 
    uhs.specie = s.id