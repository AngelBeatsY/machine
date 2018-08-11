<?php
	system('cd /d D:\Soft\LibreOffice 5\program && soffice.exe --convert-to pdf:writer_pdf_Export --outdir F:/doc/ F:/abc.ppt',$info);
	echo $info;
	var_dump($info);
?>