<?php

if (!defined ('TYPO3_MODE')) die ('Access denied.');

$TYPO3_CONF_VARS['FE']['XCLASS']['ext/tt_news/pi/class.tx_ttnews.php']= t3lib_extMgm::extPath($_EXTKEY).'class.ux_tx_ttnews.php';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['tx_ttnews'] = array( 'className' => 'ux_tx_ttnews' );

?>
