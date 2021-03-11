SELECT 
	uhs.id as id, 
    uhs.user as user, 
    uhs.name as name, 
    s.name as specie, 
    s.id as specieId,
    s.image as image,
    s.description as description,
    s.level as level,
    s.attribute as attribute,
    s.type1,
    s.type2,
    uhs.personality,
    s.hp,
    s.atk,
    s.def,
    s.spatk,
    s.spdef,
    s.spd,
    uhs.euHp,
    uhs.euAtk,
    uhs.euDef,
    uhs.euSpAtk,
    uhs.euSpDef,
    uhs.euSpd,
    s.rarity,
    uhs.buddy as isBuddy
FROM 
    vms_user_has_species uhs, 
    vms_species s 
WHERE 
    uhs.specie = s.id
ORDER BY s.name ASC