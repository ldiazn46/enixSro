<?php
function anti_injection($sql){
   $sql 			= preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"),"",$sql);
   $sql 			= trim($sql);
   $sql 			= strip_tags($sql);
   $sql 			= addslashes($sql);
   $sql 			= stripslashes($sql);
  $sql				= str_replace("'", "''", $sql);
   //$sql				= preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $sql);
   return $sql;
}  


?> 