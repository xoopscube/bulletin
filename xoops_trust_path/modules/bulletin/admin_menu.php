<?php
$constpref = '_MI_' . strtoupper( $mydirname ) ;

$adminmenu = array(
	[
		'title' => constant( $constpref.'_ADMENU5' ) ,
		'link' => 'admin/index.php?op=list' ,
    ],
	[
		'title' => constant( $constpref.'_ADMENU2' ) ,
		'link' => 'admin/index.php?op=topicsmanager' ,
    ],
	[
		'title' => constant( $constpref.'_ADMENU_CATEGORYACCESS' ) ,
		'link' => 'admin/index.php?page=category_access' ,
    ],
	[
		'title' => constant( $constpref.'_ADMENU4' ) ,
		'link' => 'admin/index.php?op=permition' ,
    ],
	[
		'title' => constant( $constpref.'_ADMENU7' ) ,
		'link' => 'admin/index.php?op=convert' ,
    ],
) ;

$adminmenu4altsys = array(
	[
		'title' => constant( $constpref.'_ADMENU_MYLANGADMIN' ) ,
		'link' => 'admin/index.php?mode=admin&lib=altsys&page=mylangadmin' ,
    ],
	[
		'title' => constant( $constpref.'_ADMENU_MYTPLSADMIN' ) ,
		'link' => 'admin/index.php?mode=admin&lib=altsys&page=mytplsadmin' ,
    ],
//	[
//		'title' => constant( $constpref.'_ADMENU_MYBLOCKSADMIN' ) ,
//		'link' => 'admin/index.php?mode=admin&lib=altsys&page=myblocksadmin' ,
//    ],
//	[
//		'title' => _PREFERENCES ,
//		'link' => 'admin/index.php?mode=admin&lib=altsys&page=mypreferences' ,
//    ],
) ;
