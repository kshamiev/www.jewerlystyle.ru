SELECT 
  z.ID,
  z.`Name`,
  z.`Description`,
  wp.`Imgs`,
  MIN(g.`Price`) AS Price
FROM
  Shop_Wares AS z 
  LEFT JOIN Shop_WaresPhoto AS wp 
    ON wp.Shop_Wares_ID = z.ID 
  LEFT JOIN `Shop_Goods` AS g 
    ON g.`Shop_Wares_ID` = z.`ID` 
WHERE z.`Zero_Section_ID` IN (1) 
GROUP BY 1,
  2,
  3 
ORDER BY 2 ;

