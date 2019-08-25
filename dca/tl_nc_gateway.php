<?php

$arrDca = $GLOBALS['TL_DCA']['tl_nc_gateway'];

/**
 * Fields
 */
$arrDca['palettes']['zapier'] = '{title_legend},title,type;{gateway_legend},zapier_url';
$arrDca['fields']['zapier_url'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_nc_gateway']['zapier_url'],
    'exclude'                 => true,
    'search'                  => true,
    'inputType'               => 'text',
    'eval'                    => array('mandatory'=>true, 'rgxp'=>'url', 'decodeEntities'=>true, 'maxlength'=>255, 'tl_class'=>'w50 wizard'),
    'sql'                     => "varchar(255) NOT NULL default ''"
);