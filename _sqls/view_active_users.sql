select 
	u.id AS id,
	u.name AS name,
	a.image AS avatar,
	u.email AS email,
	u.password AS password,
	u.wallet AS wallet,
	u.reputation AS reputation,
	u.house AS house,
	u.map,
	u.lastLogin AS lastLogin,
	u.lastDay AS lastDay,
	c.id AS crest,
	u.type AS type,
	u.vip AS vip
from 
	vms_users u,
	vms_avatars a,
	vms_crests c,
	vms_users_has_crests uc
where 
	(u.id = uc.user) and 
	(c.id = uc.crest) and 
	(a.id = u.avatar) and 
	(u.status = 1)
