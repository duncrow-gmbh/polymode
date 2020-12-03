<?php

$GLOBALS['TL_DCA']['tl_module']['palettes']['polymode'] = '{title_legend},name,type;{settings_legend},polymode_buildFile,polymode_loadingscreen_background;{template_legend:hide},polymode_template,polymode_mobileTemplate;';


$GLOBALS['TL_DCA']['tl_module']['fields']['polymode_buildFile'] = array
(
    'exclude'                 => true,
    'inputType'               => 'fileTree',
    'eval'                    => array('fieldType'=>'radio', 'mandatory'=>true, 'files'=>true, 'filesOnly'=>true, 'tl_class'=>'w50', 'extensions'=>'json'),
    'sql'                     => "binary(16) NULL"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['polymode_loadingscreen_background'] = array
(
    'exclude'                 => true,
    'inputType'               => 'text',
    'eval'                    => array('maxlength'=>6, 'disabled'=>true, 'colorpicker'=>true, 'isHexColor'=>true, 'decodeEntities'=>true, 'tl_class'=>'w50 wizard'),
    'sql'                     => "varchar(64) NOT NULL default '0D101F'"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['polymode_template'] = array
(
    'exclude'                 => true,
    'inputType'               => 'select',
    'options_callback' => static function ()
    {
        return Contao\Controller::getTemplateGroup('polymode_');
    },
    'eval'                    => array('includeBlankOption'=>true, 'chosen'=>true, 'tl_class'=>'w50'),
    'sql'                     => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['polymode_mobileTemplate'] = array
(
    'exclude'                 => true,
    'inputType'               => 'select',
    'options_callback' => static function ()
    {
        return Contao\Controller::getTemplateGroup('polymode_');
    },
    'eval'                    => array('includeBlankOption'=>true, 'chosen'=>true, 'tl_class'=>'w50'),
    'sql'                     => "varchar(64) NOT NULL default ''"
);