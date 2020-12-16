SELECT 
	l.id, u.name, 
	a.image, 
	l.action, 
	l.hour 
FROM 
	vms_logs l, 
	vms_users u, 
	vms_avatars a 
WHERE 
	l.user = u.id AND 
	a.id = u.avatar 
ORDER BY l.id DESC LIMIT 100