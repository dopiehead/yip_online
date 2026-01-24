<?php
require __DIR__ . '/vendor/autoload.php';

$smarty = new Smarty();
$smarty->setTemplateDir(__DIR__ . '/resources/views');
$smarty->setCompileDir(__DIR__ . '/storage/compile');

$smarty->assign('name', 'Yusuf');
$smarty->display('test.tpl');
