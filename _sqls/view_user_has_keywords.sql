select
       uhk.id AS id,
       uhk.user AS user,
       k.label AS label,
       k.keyword AS keyword,
       k.target AS target,
       l.code AS language
from
      vms_user_has_keywords uhk,
      vms_keywords k,
      vms_languages l
where
      uhk.keyword = k.keyword and
      k.language = l.id