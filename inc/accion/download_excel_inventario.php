<?php
ob_start();
session_start();
/** Incluye PHPExcel */
require_once dirname(__FILE__) . '/../../Classes/PHPExcel.php';
//require_once dirname(__FILE__) . '/Classes/PHPExcel.php';
// Crear nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();
// Redirigir la salida al navegador web de un cliente ( Excel5 )
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="INVENTARIO.xlsx"');
header('Cache-Control: max-age=0');
// Si usted está sirviendo a IE 9 , a continuación, puede ser necesaria la siguiente
require_once("conexion.php"); 
 
// Propiedades del documento
$objPHPExcel->getProperties()->setCreator("Muebleria Compra Facil")
                             ->setLastModifiedBy("Muebleria Compra Facil")
                             ->setTitle("Lista")
                             ->setSubject("Lista Office")
                             ->setDescription("Generación del inventario")
                             ->setKeywords("Lista")
                             ->setCategory("Archivo generado");

    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:C1');
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'INVENTARIO')
                ->setCellValue('A2', 'Producto')
                ->setCellValue('B2', 'Stock M')
                ->setCellValue('C2', 'Folio Serie');

    // Fuente de la primera fila en negrita
    $boldArraytitle = array('font' => array('name' => 'Arial','size' => 14, 'bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
     
    $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->applyFromArray($boldArraytitle); 
                
    // Fuente de la primera fila en negrita
    $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
     
    $objPHPExcel->getActiveSheet()->getStyle('A2:C2')->applyFromArray($boldArray);          
                
    //Ancho de las columnas
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(22);//
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);//
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);//

    $query = mysqli_query($conexion, "SELECT producto.idproducto, producto.identificador, producto.en_stock, entrada.folio_compra FROM entrada_productos INNER JOIN producto on producto.idproducto = entrada_productos.producto INNER JOIN entrada on entrada.identrada = entrada_productos.entrada GROUP by producto.idproducto order by producto.en_stock");
    $result = mysqli_num_rows($query);
    if ($result > 0) 
    {
        $cel=3;//Numero de fila donde empezara a crear  el reporte
        while ($data = mysqli_fetch_assoc($query)) 
        {
            $id_producto = $data['idproducto'];
            $query_series = mysqli_query($conexion, "SELECT entrada.folio_compra, entrada_productos_serie.serie from entrada INNER JOIN entrada_productos_serie on entrada_productos_serie.entrada = entrada.identrada WHERE entrada_productos_serie.producto = '$id_producto' AND entrada_productos_serie.vendido = 0");
            
            $identificador = $data['identificador'];
            $en_stock = $data['en_stock'];

            $a="A".$cel;
            $b="B".$cel;
            
            $objPHPExcel->setActiveSheetIndex()
            ->setCellValue($a, $identificador)
            ->setCellValue($b, $en_stock);

            $cel2 = 0;
            while ($data_serie = mysqli_fetch_assoc($query_series))
            {
                $c="C".($cel+$cel2);
                $folio_serie = $data_serie['folio_compra']."-".$data_serie['serie'];

                $objPHPExcel->setActiveSheetIndex()
                ->setCellValue($c, $folio_serie);
                $cel2+=1;
            }

            $objPHPExcel->setActiveSheetIndex()->mergeCells('A'.$cel.':'.'A'.($cel+$cel2-1));
            $objPHPExcel->setActiveSheetIndex()->mergeCells('B'.$cel.':'.'B'.($cel+$cel2-1));
            $cel = $cel + $cel2;
        }
    }

    $rango="A2:C".$cel;
    $styleArray = array('font' => array( 'name' => 'Arial','size' => 10));
    $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($styleArray);


// Cambiar el nombre de hoja de cálculo
$objPHPExcel->getActiveSheet()->setTitle('Lista de inventario');
// Establecer índice de hoja activa a la primera hoja , por lo que Excel abre esto como la primera hoja
$objPHPExcel->setActiveSheetIndex(0);
 
$anio=date("Y");
$nombreR="INVENTARIO ".$anio.".xlsx";
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=$nombreR");
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
// Si usted está sirviendo a IE a través de SSL , a continuación, puede ser necesaria la siguiente
//header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
//header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
//header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
//header ('Pragma: public'); // HTTP/1.0
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
$objWriter->setPreCalculateFormulas(false);
$objWriter->save('php://output');
exit;
ob_end_flush();

?>
