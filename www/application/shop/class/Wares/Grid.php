<?php

/**
 * Controller. View a list of objects by page.
 *
 * To work with the item.
 *
 * @package Shop.Wares.Controller
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @version $Id$
 * @link http://www.phpzero.com/
 * @copyright <PHP_ZERO_COPYRIGHT>
 * @license http://www.phpzero.com/license/
 */
class Shop_Wares_Grid extends Zero_Crud_Grid
{
    /**
     * The table stores the objects handled by this controller.
     *
     * @var string
     */
    protected $ModelName = 'Shop_Wares';

    /**
     * Template view
     *
     * @var string
     */
    protected $Template = 'Zero_Crud_Grid';

    /**
     * Initialization of the stack chunks and input parameters
     *
     * @param int $catId
     * @throws PHPExcel_Exception
     * @throws PHPExcel_Reader_Exception
     * @return boolean flag stop execute of the next chunk
     */
    public function Action_Export($catId = 0)
    {
        $sql_join = '';
        if ( 0 < $catId )
        {
            $sql = "SELECT ID FROM Zero_Section WHERE Zero_Section_ID = {$catId}";
            $listId = Zero_DB::Select_List($sql);
            $listId[] = $catId;
            $catId = implode(',', $listId);
            $sql_join = "AND sw.`Zero_Section_ID` IN ({$catId})";
        }

        require ZERO_PATH_APPLICATION . '/shop/library/PHPExcel.php';

        /////
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")->setLastModifiedBy("Maarten Balliauw")->setTitle("PHPExcel Test Document")->setSubject("PHPExcel Test Document")->setDescription("Test document for PHPExcel, generated using PHP classes.")->setKeywords("office PHPExcel php")->setCategory("Test result file");

        // Add some data
        $objPHPExcel->setActiveSheetIndex(0);

        //
        $sql = "
        SELECT
            sw.`Name`,
            sw.`Imgs`,
            dc.`Name` AS Color,
            dp.`Name` AS Packing,
            sg.`Price`
        FROM `Shop_Goods` AS sg
            INNER JOIN `Directory_Color` AS dc ON dc.`ID` = sg.`Directory_Color_ID`
            INNER JOIN `Directory_Packing` AS dp ON dp.`ID` = sg.`Directory_Packing_ID`
            INNER JOIN `Shop_Wares` AS sw ON sw.`ID` = sg.`Shop_Wares_ID` {$sql_join}
        ORDER BY
            sw.`Name`,
            dc.`Name`,
            dp.`Name`
        ";

        $data = Zero_DB::Select_Array($sql);

        $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn(0)->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn(1)->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn(2)->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn(3)->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn(4)->setAutoSize(true);

        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(0, 1)->getFont()->setSize(14);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(0, 1)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(1, 1)->getFont()->setSize(14);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(1, 1)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(2, 1)->getFont()->setSize(14);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(2, 1)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(3, 1)->getFont()->setSize(14);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(3, 1)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(4, 1)->getFont()->setSize(14);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(4, 1)->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->setCellValue('A' . 1, 'Фото');
        $objPHPExcel->getActiveSheet()->setCellValue('B' . 1, 'Наименование');
        $objPHPExcel->getActiveSheet()->setCellValue('C' . 1, 'Цвет');
        $objPHPExcel->getActiveSheet()->setCellValue('D' . 1, 'Фасовка');
        $objPHPExcel->getActiveSheet()->setCellValue('E' . 1, 'Цена');

        //$objPHPExcel->getDefaultStyle()->getAlignment()->setHorizontal('center');
        //$objPHPExcel->getDefaultStyle()->getAlignment()->setVertical('center');

        foreach ($data as $i => $row)
        {
            $i += 2;

            if ( $row['Imgs'] != '' )
            {
                $row['Imgs'] = '/upload/data/' . $row['Imgs'];
                //        $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(100);
                $objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(80);

                $objDrawing = new PHPExcel_Worksheet_Drawing();
                $objDrawing->setName('Terms and conditions');
                $objDrawing->setDescription('Terms and conditions');
                $objDrawing->setPath(ZERO_PATH_SITE . $row['Imgs']);
                $objDrawing->setOffsetX(3);
                $objDrawing->setOffsetY(3);
                $objDrawing->setCoordinates('A' . $i);
                //    $objDrawing->setHeight(50);
                $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
            }
            else
            {
                //        $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(100);
                $objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(20);
                $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(0, $i)->getAlignment()->setHorizontal('center');
                $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(0, $i)->getAlignment()->setVertical('center');

                $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, 'Картинки нет');
            }
            //
            $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(1, $i)->getAlignment()->setHorizontal('center');
            $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(1, $i)->getAlignment()->setVertical('center');
            $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(2, $i)->getAlignment()->setHorizontal('center');
            $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(2, $i)->getAlignment()->setVertical('center');
            $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(3, $i)->getAlignment()->setHorizontal('center');
            $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(3, $i)->getAlignment()->setVertical('center');
            $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(4, $i)->getAlignment()->setHorizontal('center');
            $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(4, $i)->getAlignment()->setVertical('center');

            $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $row['Name']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $row['Color']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $row['Packing']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $row['Price']);
        }

        // Save Excel 2007 file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        //        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Прайс-лист.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
        exit;
    }
}