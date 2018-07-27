        SELECT
          dc.`Name` AS Color,
          dp.`Name` AS Packing,
          sg.`ID`,
          sg.`Price`,
          SUM(sr.`Cnt`) AS Cnt
        FROM
          `Shop_Goods` AS sg
          LEFT JOIN `Directory_Color` AS dc
            ON dc.`ID` = sg.`Directory_Color_ID`
          LEFT JOIN `Directory_Packing` AS dp
            ON dp.`ID` = sg.`Directory_Packing_ID`
          LEFT JOIN `Shop_Reserve` AS sr
            ON sr.`Shop_Goods_ID` = sg.`ID`
            -- AND sr.`Shop_Warehouse_ID` = 1
        WHERE sg.`Shop_Wares_ID` = {$ware_id}
        GROUP BY dc.`Name`,
          dp.`Name`
        ORDER BY dc.`Name`,
          dp.`Name`
