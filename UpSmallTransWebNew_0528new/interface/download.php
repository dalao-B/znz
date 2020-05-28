<?php

function out_file($filepath, $type, $filename) {
	
	//文档类型对照表
	$filetype = array(
		'chm'	=> 'application/octet-stream',
		'ppt'	=> 'application/vnd.ms-powerpoint',
		'xls'	=> 'application/vnd.ms-excel',
		'xlsx'	=> 'application/vnd.ms-excel',
		'doc'	=> 'application/msword',
		'exe'	=> 'application/octet-stream',
		'rar'	=> 'application/octet-stream',
		'js'	=> "javascript/js",
		'css'	=> "text/css",
		'hqx'	=> "application/mac-binhex40",
		'bin'	=> "application/octet-stream",
		'oda'	=> "application/oda",
		'pdf'	=> "application/pdf",
		'ai'	=> "application/postsrcipt",
		'eps'	=> "application/postsrcipt",
		'es'	=> "application/postsrcipt",
		'rtf'	=> "application/rtf",
		'mif'	=> "application/x-mif",
		'csh'	=> "application/x-csh",
		'dvi'	=> "application/x-dvi",
		'hdf'	=> "application/x-hdf",
		'nc'	=> "application/x-netcdf",
		'cdf'	=> "application/x-netcdf",
		'ts'	=> "application/x-troll-ts",
		'src'	=> "application/x-wais-source",
		'zip'	=> "application/zip",
		'cpio'	=> "application/x-cpio",
		'gtar'	=> "application/x-gtar",
		'shar'	=> "application/x-shar",
		'tar'	=> "application/x-tar",
		'man'	=> "application/x-troff-man",
		'sh'	=> "application/x-sh",
		'tcl'	=> "application/x-tcl",
		'tex'	=> "application/x-tex",
		'texi'	=> "application/x-texinfo",
		't'		=> "application/x-troff",
		'tr'	=> "application/x-troff",
		'roff'	=> "application/x-troff",
		'shar'	=> "application/x-shar",
		'me'	=> "application/x-troll-me",
		'ts'	=> "application/x-troll-ts",
		'gif'	=> "image/gif",
		'jpeg'	=> "image/pjpeg",
		'jpg'	=> "image/pjpeg",
		'jpe'	=> "image/pjpeg",
		'ras'	=> "image/x-cmu-raster",
		'pbm'	=> "image/x-portable-bitmap",
		'ppm'	=> "image/x-portable-pixmap",
		'xbm'	=> "image/x-xbitmap",
		'xwd'	=> "image/x-xwindowdump",
		'ief'	=> "image/ief",
		'tif'	=> "image/tiff",
		'tiff'	=> "image/tiff",
		'pnm'	=> "image/x-portable-anymap",
		'pgm'	=> "image/x-portable-graymap",
		'rgb'	=> "image/x-rgb",
		'xpm'	=> "image/x-xpixmap",
		'txt'	=> "text/plain",
		'c'		=> "text/plain",
		'cc'	=> "text/plain",
		'h'		=> "text/plain",
		'html'	=> "text/html",
		'htm'	=> "text/html",
		'htl'	=> "text/html",
		'rtx'	=> "text/richtext",
		'etx'	=> "text/x-setext",
		'tsv'	=> "text/tab-separated-values",
		'mpeg'	=> "video/mpeg",
		'mpg'	=> "video/mpeg",
		'mpe'	=> "video/mpeg",
		'avi'	=> "video/x-msvideo",
		'qt'	=> "video/quicktime",
		'mov'	=> "video/quicktime",
		'moov'	=> "video/quicktime",
		'movie'	=> "video/x-sgi-movie",
		'au'	=> "audio/basic",
		'snd'	=> "audio/basic",
		'wav'	=> "audio/x-wav",
		'aif'	=> "audio/x-aiff",
		'aiff'	=> "audio/x-aiff",
		'aifc'	=> "audio/x-aiff",
		'swf'	=> "application/x-shockwave-flash"
	);
	
	$filetype	= $filetype[$type] ;
    
	header("Content-type: ".$filetype);
	header("Content-Disposition:attachment;filename=\"$filename\"");
	header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
	header('Expires:0');
	header('Pragma:public');
	echo '';
	flush();
    

    if ($filepath != ""){
    	$query		= file_get_contents($filepath);
		echo $query;	
    	unlink($filepath);
	}

	
	
}
?>