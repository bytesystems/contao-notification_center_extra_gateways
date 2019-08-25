<?php

$table = NotificationCenter\Model\Gateway::getTable();

$GLOBALS['TL_DCA'][$table]['palettes']['zapier'] = '{title_legend},title,type;{gateway_legend},zapier_url';
/**
 * Fields
 */
$GLOBALS['TL_DCA'][$table]['fields']['zapier_url'] = [
    'label'     => &$GLOBALS['TL_LANG'][$table]['zapier_url'],
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => [
        'mandatory'      => true,
        'rgxp'           =>'url',
        'decodeEntities' => true,
        'maxlength'      => 255,
        'tl_class'       => 'w50'
    ],
    'sql'                     => "varchar(255) NOT NULL default ''"
];
