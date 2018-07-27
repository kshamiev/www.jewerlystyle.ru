SELECT
	sw.ID,
	sw.`Name`,
	sw.`Description`,
	swp.`Imgs`,
	SUM(sb.`Price` * sb.`Cnt`) AS Prices
FROM Shop_Wares AS sw
	LEFT JOIN Shop_WaresPhoto AS swp ON swp.Shop_Wares_ID = sw.ID
	INNER JOIN `Shop_Goods` AS sg ON sg.`Shop_Wares_ID` = sw.`ID`
	INNER JOIN `Shop_Basket` AS sb ON sb.`Shop_Goods_ID` = sg.`ID`
WHERE
	sb.`Zero_Users_ID` = 1
	AND sb.`Shop_Warehouse_ID` = 1
GROUP BY
	1, 2, 3
ORDER BY
	2
