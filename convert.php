<?php /**
	Convert excel file to csv
*/

//Various excel formats supported by PHPExcel library
$excel_readers = array(
	'Excel5' , 
	'Excel2003XML' , 
	'Excel2007'
);

require_once('lib/PHPExcel/PHPExcel.php');

$reader = PHPExcel_IOFactory::createReader('Excel5');
$reader-&gt;setReadDataOnly(true);

$path = 'data.xls';
$excel = $reader-&gt;load($path);

$writer = PHPExcel_IOFactory::createWriter($excel, 'CSV');
$writer-&gt;save('data.csv');

echo 'File saved to csv format';

?>