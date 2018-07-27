TRUNCATE TABLE `jewerlystyle`.`Shop_Reserve`;

-- добавляем товар на склад (в резерв)
INSERT IGNORE `Shop_Reserve` ( 
	`Shop_Warehouse_ID`,
	`Shop_Goods_ID`,
	`Cnt`)
SELECT 1, ID, 0 FROM `Shop_Goods`;

-- изменяем количество товара еа складе
UPDATE `Shop_Reserve` SET Cnt = 10000;

-- SELECT Shop_Goods_ID, COUNT(*) FROM `shop_reserve` GROUP BY 1;