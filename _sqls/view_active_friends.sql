select 
	uf.user AS userId,
	uf.friend AS friendId,
	uf.nickname AS nickname,
	u.name AS name,
	a.image AS avatar,
	us.id AS buddy,
	c.id AS crest 
from 
	vms_users u,
	vms_crests c,
	vms_user_has_friends uf,
	vms_user_has_species us,
	vms_users_has_crests uc, 
	vms_avatars a 
where
	(u.id = uf.friend) and 
	(u.id = uc.user) and 
	(u.id = us.user) and 
	(us.buddy = '1') and 
	(c.id = uc.crest) and 
	(a.id = u.avatar) and 
	(u.status = 1)