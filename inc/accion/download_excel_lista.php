<?php
ob_start();
/** Incluye PHPExcel */
require_once dirname(__FILE__) . '/../../Classes/PHPExcel.php';
//require_once dirname(__FILE__) . '/Classes/PHPExcel.php';
// Crear nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();
// Redirigir la salida al navegador web de un cliente ( Excel5 )
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="LISTA_DE_PRECIOS.xlsx"');
header('Cache-Control: max-age=0');
// Si usted está sirviendo a IE 9 , a continuación, puede ser necesaria la siguiente
require_once("conexion.php"); 
 
// Propiedades del documento
$objPHPExcel->getProperties()->setCreator("Muebleria Compra Facil")
                             ->setLastModifiedBy("Muebleria Compra Facil")
                             ->setTitle("Lista")
                             ->setSubject("Lista Office")
                             ->setDescription("Generación de lista de los productos")
                             ->setKeywords("Lista")
                             ->setCategory("Archivo generado");

$conf_especial = mysqli_query($conexion, "SELECT valor_int from configuracion where configuracion = 'activador_especial'");
$status_especial = mysqli_fetch_assoc($conf_especial)['valor_int'];
if($status_especial == 0)
{
    //NO lleva especial
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:L1');
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'LISTA DE PRODUCTOS')
                ->setCellValue('A2', 'Descripción')
                ->setCellValue('B2', 'Costo actual')
                ->setCellValue('C2', 'Costo + iva')
                ->setCellValue('D2', 'Ext-P')
                ->setCellValue('E2', 'Ext-M')
                ->setCellValue('F2', 'Contado')
                ->setCellValue('G2', 'CR1')
                ->setCellValue('H2', 'P1')
                ->setCellValue('I2', 'CR2')
                ->setCellValue('J2', 'P2')
                ->setCellValue('K2', 'E-Q')
                ->setCellValue('L2', 'Garantía');

    // Fuente de la primera fila en negrita
    $boldArraytitle = array('font' => array('name' => 'Arial','size' => 14, 'bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
     
    $objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($boldArraytitle); 
                
    // Fuente de la primera fila en negrita
    $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
     
    $objPHPExcel->getActiveSheet()->getStyle('A2:L2')->applyFromArray($boldArray);          
                
    //Ancho de las columnas
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(50);//Descripción 
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);//Costo actual    
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);//Costo + iva 
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);//Ext-P   
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);//Ext-M           
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);//Contado
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);//CR1
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);//P1
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);//CR2
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);//P2
    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);//E-Q
    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(10);//Garantía

        $query = mysqli_query($conexion, "SELECT * from producto order by creado_en desc");
                $result = mysqli_num_rows($query);
                if ($result > 0) 
                {
                    $cel=3;//Numero de fila donde empezara a crear  el reporte
                    while ($data = mysqli_fetch_assoc($query)) 
                    {
                        $id_producto = $data['idproducto'];
                        //aqui vamos a ver si tienen foto o no, para mostrar los iconos acorde
                        if($data['subcategoria'] == null)
                        {
                            $idcategoria = $data['categoria'];
                            $query_meses = mysqli_query($conexion, "SELECT meses_garantia,contado,especial,credito1,credito2,meses_pago from categoria where idcategoria = '$idcategoria'");
                            $data_cat = mysqli_fetch_assoc($query_meses);
                            $garantia = $data_cat['meses_garantia'];
                            $contado = $data_cat['contado'];
                            //$especial = $data_cat['especial'];
                            $credito1 = $data_cat['credito1'];
                            $credito2 = $data_cat['credito2'];
                            $meses_pago = $data_cat['meses_pago'];
                            
                            //no tiene sub
                            $select_producto_nosub = mysqli_query($conexion, "SELECT categoria.nombre as catproducto FROM producto INNER JOIN categoria on categoria.idcategoria = producto.categoria WHERE idproducto = '$id_producto'");
                            $catproducto = mysqli_fetch_assoc($select_producto_nosub)['catproducto'];
                        }
                        else
                        {
                            $idsubcategoria = $data['subcategoria'];
                            $query_meses = mysqli_query($conexion, "SELECT meses_garantia,contado,especial,credito1,credito2,meses_pago from subcategoria where idsubcategoria = '$idsubcategoria'");
                            $data_cat = mysqli_fetch_assoc($query_meses);
                            $garantia = $data_cat['meses_garantia'];
                            $contado = $data_cat['contado'];
                            //$especial = $data_cat['especial'];
                            $credito1 = $data_cat['credito1'];
                            $credito2 = $data_cat['credito2'];
                            $meses_pago = $data_cat['meses_pago'];

                            $select_producto_full = mysqli_query($conexion, "SELECT categoria.nombre as catproducto, subcategoria.nombre as subcat_producto FROM producto INNER JOIN categoria on categoria.idcategoria = producto.categoria INNER JOIN subcategoria on subcategoria.idsubcategoria = producto.subcategoria WHERE idproducto = '$id_producto'");
                            $data_producto = mysqli_fetch_assoc($select_producto_full);
                            $catproducto = $data_producto['catproducto'];
                            $subcat_producto = $data_producto['subcat_producto'];
                        }
                        //aqui empezamos a hacer el reporte de las listas de los productos
                        
                        $costo_iva = $data['costo_iva'];
                        $costo_contado = $data['costo_contado'];
                        $costo_especial = $data['costo_especial'];
                        $costo_cr1 = $data['costo_cr1'];
                        $costo_cr2 = $data['costo_cr2'];
                        

                        $costo_iva = $data['costo_iva'];
                        $descripcion = $data['descripcion'];
                        $costo = $data['costo'];
                        $ext_m = 0;  //<- aun no se ha definido
                        $costo_p1 = $data['costo_p1'];
                        $costo_p2 = $data['costo_p2'];
                        $costo_eq = $data['costo_eq'];
                        if($data['ext_p'] == null)
                        {
                            $ext_p = 0;
                        }
                        else
                        {
                            $ext_p = $data['ext_p'];
                        }

                        $a="A".$cel;
                        $b="B".$cel;
                        $c="C".$cel;
                        $d="D".$cel;
                        $e="E".$cel;
                        $f="F".$cel;
                        $g="G".$cel;
                        $h="H".$cel;
                        $i="I".$cel;
                        $j="J".$cel;
                        $k="K".$cel;
                        $l="L".$cel;
                        // Agregar datos
                        //'=SI((B'.$cel.'/'.$meses_pago.')/2<400,400,(B'.$cel.'/'.$meses_pago.')/2)'
                        //poner texto plano a los que no son admins
                        if($_SESSION['rol'] == "SuperAdmin" or $_SESSION['rol'] == "Administrador")
                        {
                            $objPHPExcel->setActiveSheetIndex()
                           ->setCellValue($a, $descripcion)
                           ->setCellValue($b, $costo)
                           ->setCellValue($c, '=B'.$cel.'+(B'.$cel.'*0.16)')
                           ->setCellValue($d, $ext_p)
                           ->setCellValue($e, $ext_m)
                           ->setCellValue($f, '=B'.$cel.'+(B'.$cel.'*'.($contado/100).')')
                           ->setCellValue($g, '=B'.$cel.'+(B'.$cel.'*'.($credito1/100).')')
                           ->setCellValue($k, $costo_eq)
                           ->setCellValue($h, $costo_p1)    //'=(H'.$cel.'/L'.$cel.')/2')
                           ->setCellValue($i, '=B'.$cel.'+(B'.$cel.'*'.($credito2/100).')')
                           ->setCellValue($j, $costo_p2)   //'=(J'.$cel.'/L'.$cel.')/2')
                           ->setCellValue($l, $garantia);
                        }
                        else
                        {
                            $objPHPExcel->setActiveSheetIndex()
                           ->setCellValue($a, $descripcion)
                           ->setCellValue($b, $costo)
                           ->setCellValue($c, $costo_iva)
                           ->setCellValue($d, $ext_p)
                           ->setCellValue($e, $ext_m)
                           ->setCellValue($f, $costo_contado)
                           ->setCellValue($g, $costo_cr1)
                           ->setCellValue($k, $costo_eq)
                           ->setCellValue($h, $costo_p1)    //'=(H'.$cel.'/L'.$cel.')/2')
                           ->setCellValue($i, $costo_cr2)
                           ->setCellValue($j, $costo_p2)   //'=(J'.$cel.'/L'.$cel.')/2')
                           ->setCellValue($l, $garantia);
                        }
                        
                        $cel+=1;
                    }
                }

    //Fin extracion de datos MYSQL 
    $objPHPExcel
      ->getActiveSheet()
      ->getStyle('B3:C'.$cel)
      ->getNumberFormat()
      ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD_SIMPLE); 
    $objPHPExcel
      ->getActiveSheet()
      ->getStyle('F3:G'.$cel)
      ->getNumberFormat()
      ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
    $objPHPExcel
      ->getActiveSheet()
      ->getStyle('I3:I'.$cel)
      ->getNumberFormat()
      ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);  
    $objPHPExcel
      ->getActiveSheet()
      ->getStyle('K3:K'.$cel)
      ->getNumberFormat()
      ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD_SIMPLE); 

    $rango="A2:L".$cel;
    $styleArray = array('font' => array( 'name' => 'Arial','size' => 10));
    $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($styleArray);
}
else
{
    //si lleva especial
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:M1');
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'LISTA DE PRODUCTOS')
                ->setCellValue('A2', 'Descripción')
                ->setCellValue('B2', 'Costo actual')
                ->setCellValue('C2', 'Costo + iva')
                ->setCellValue('D2', 'Ext-P')
                ->setCellValue('E2', 'Ext-M')
                ->setCellValue('F2', 'Contado')
                ->setCellValue('G2', 'Especial')
                ->setCellValue('H2', 'CR1')
                ->setCellValue('I2', 'P1')
                ->setCellValue('J2', 'CR2')
                ->setCellValue('K2', 'P2')
                ->setCellValue('L2', 'E-Q')
                ->setCellValue('M2', 'Garantía');

    // Fuente de la primera fila en negrita
    $boldArraytitle = array('font' => array('name' => 'Arial','size' => 14, 'bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
     
    $objPHPExcel->getActiveSheet()->getStyle('A1:M1')->applyFromArray($boldArraytitle); 
                
    // Fuente de la primera fila en negrita
    $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
     
    $objPHPExcel->getActiveSheet()->getStyle('A2:M2')->applyFromArray($boldArray);          
                
    //Ancho de las columnas
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(50);//Descripción 
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);//Costo actual    
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);//Costo + iva 
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);//Ext-P   
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);//Ext-M           
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);//Contado
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);//Especial
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);//CR1
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);//P1
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);//CR2
    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);//P2
    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(10);//E-Q
    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(10);//Garantía

        require_once("conexion.php"); 

        $query = mysqli_query($conexion, "SELECT * from producto order by creado_en desc");
                $result = mysqli_num_rows($query);
                if ($result > 0) 
                {
                    $cel=3;//Numero de fila donde empezara a crear  el reporte
                    while ($data = mysqli_fetch_assoc($query)) 
                    {
                        $id_producto = $data['idproducto'];
                        //aqui vamos a ver si tienen foto o no, para mostrar los iconos acorde
                        if($data['subcategoria'] == null)
                        {
                            $idcategoria = $data['categoria'];
                            $query_meses = mysqli_query($conexion, "SELECT meses_garantia,contado,especial,credito1,credito2,meses_pago from categoria where idcategoria = '$idcategoria'");
                            $data_cat = mysqli_fetch_assoc($query_meses);
                            $garantia = $data_cat['meses_garantia'];
                            $contado = $data_cat['contado'];
                            $especial = $data_cat['especial'];
                            $credito1 = $data_cat['credito1'];
                            $credito2 = $data_cat['credito2'];
                            $meses_pago = $data_cat['meses_pago'];
                            
                            //no tiene sub
                            $select_producto_nosub = mysqli_query($conexion, "SELECT categoria.nombre as catproducto FROM producto INNER JOIN categoria on categoria.idcategoria = producto.categoria WHERE idproducto = '$id_producto'");
                            $catproducto = mysqli_fetch_assoc($select_producto_nosub)['catproducto'];
                        }
                        else
                        {
                            $idsubcategoria = $data['subcategoria'];
                            $query_meses = mysqli_query($conexion, "SELECT meses_garantia,contado,especial,credito1,credito2,meses_pago from subcategoria where idsubcategoria = '$idsubcategoria'");
                            $data_cat = mysqli_fetch_assoc($query_meses);
                            $garantia = $data_cat['meses_garantia'];
                            $contado = $data_cat['contado'];
                            $especial = $data_cat['especial'];
                            $credito1 = $data_cat['credito1'];
                            $credito2 = $data_cat['credito2'];
                            $meses_pago = $data_cat['meses_pago'];

                            $select_producto_full = mysqli_query($conexion, "SELECT categoria.nombre as catproducto, subcategoria.nombre as subcat_producto FROM producto INNER JOIN categoria on categoria.idcategoria = producto.categoria INNER JOIN subcategoria on subcategoria.idsubcategoria = producto.subcategoria WHERE idproducto = '$id_producto'");
                            $data_producto = mysqli_fetch_assoc($select_producto_full);
                            $catproducto = $data_producto['catproducto'];
                            $subcat_producto = $data_producto['subcat_producto'];
                        }
                        //aqui empezamos a hacer el reporte de las listas de los productos
                        
                        $costo_iva = $data['costo_iva'];
                        $costo_contado = $data['costo_contado'];
                        $costo_especial = $data['costo_especial'];
                        $costo_cr1 = $data['costo_cr1'];
                        $costo_cr2 = $data['costo_cr2'];
                        

                        $costo_iva = $data['costo_iva'];
                        $descripcion = $data['descripcion'];
                        $costo = $data['costo'];
                        $ext_m = 0;  //<- aun no se ha definido
                        $costo_p1 = $data['costo_p1'];
                        $costo_p2 = $data['costo_p2'];
                        $costo_eq = $data['costo_eq'];
                        if($data['ext_p'] == null)
                        {
                            $ext_p = 0;
                        }
                        else
                        {
                            $ext_p = $data['ext_p'];
                        }
                        if($especial == null)
                        {
                            $especial = 0;
                        }
                        else
                        {
                            $especial = '=B'.$cel.'+(B'.$cel.'*'.($especial/100).')';
                        }

                        
                        $a="A".$cel;
                        $b="B".$cel;
                        $c="C".$cel;
                        $d="D".$cel;
                        $e="E".$cel;
                        $f="F".$cel;
                        $g="G".$cel;
                        $h="H".$cel;
                        $i="I".$cel;
                        $j="J".$cel;
                        $k="K".$cel;
                        $l="L".$cel;
                        $m="M".$cel;
                        // Agregar datos
                        //'=SI((B'.$cel.'/'.$meses_pago.')/2<400,400,(B'.$cel.'/'.$meses_pago.')/2)'
                        //poner la lista con formulas: iva, contado, especial, credito1 y credito2
                        //poner texto plano a los que no son admins
                        if($_SESSION['rol'] == "SuperAdmin" or $_SESSION['rol'] == "Administrador")
                        {
                            $objPHPExcel->setActiveSheetIndex()
                           ->setCellValue($a, $descripcion)
                           ->setCellValue($b, $costo)
                           ->setCellValue($c, '=B'.$cel.'+(B'.$cel.'*0.16)')
                           ->setCellValue($d, $ext_p)
                           ->setCellValue($e, $ext_m)
                           ->setCellValue($f, '=B'.$cel.'+(B'.$cel.'*'.($contado/100).')')
                           ->setCellValue($g, $especial)
                           ->setCellValue($h, '=B'.$cel.'+(B'.$cel.'*'.($credito1/100).')')
                           ->setCellValue($l, $costo_eq)
                           ->setCellValue($i, $costo_p1)    //'=(H'.$cel.'/L'.$cel.')/2')
                           ->setCellValue($j, '=B'.$cel.'+(B'.$cel.'*'.($credito2/100).')')
                           ->setCellValue($k, $costo_p2)   //'=(J'.$cel.'/L'.$cel.')/2')
                           ->setCellValue($m, $garantia);
                        }
                        else
                        {
                            $objPHPExcel->setActiveSheetIndex()
                           ->setCellValue($a, $descripcion)
                           ->setCellValue($b, $costo)
                           ->setCellValue($c, $costo_iva)
                           ->setCellValue($d, $ext_p)
                           ->setCellValue($e, $ext_m)
                           ->setCellValue($f, $costo_contado)
                           ->setCellValue($g, $costo_especial)
                           ->setCellValue($h, $costo_cr1)
                           ->setCellValue($l, $costo_eq)
                           ->setCellValue($i, $costo_p1)    
                           ->setCellValue($j, $costo_cr2)
                           ->setCellValue($k, $costo_p2)   
                           ->setCellValue($m, $garantia);
                        }
                        
                        $cel+=1;
                    }
                }

    //Fin extracion de datos MYSQL 
    $objPHPExcel
      ->getActiveSheet()
      ->getStyle('B3:C'.$cel)
      ->getNumberFormat()
      ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD_SIMPLE); 
    $objPHPExcel
      ->getActiveSheet()
      ->getStyle('F3:H'.$cel)
      ->getNumberFormat()
      ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
    $objPHPExcel
      ->getActiveSheet()
      ->getStyle('J3:J'.$cel)
      ->getNumberFormat()
      ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);  
    $objPHPExcel
      ->getActiveSheet()
      ->getStyle('L3:L'.$cel)
      ->getNumberFormat()
      ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD_SIMPLE); 

    $rango="A2:M".$cel;
    $styleArray = array('font' => array( 'name' => 'Arial','size' => 10));
    $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($styleArray);
}


// Cambiar el nombre de hoja de cálculo
$objPHPExcel->getActiveSheet()->setTitle('Lista de precios');
// Establecer índice de hoja activa a la primera hoja , por lo que Excel abre esto como la primera hoja
$objPHPExcel->setActiveSheetIndex(0);
 
$anio=date("Y");
$nombreR="LISTA DE PRECIOS ".$anio.".xlsx";
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