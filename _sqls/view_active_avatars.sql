SELECT DISTINCT a.id, uha.user, a.image, a.description, a.isDefault FROM vms_user_has_avatars uha, vms_avatars a WHERE uha.avatar = a.id OR a.isDefault = 1