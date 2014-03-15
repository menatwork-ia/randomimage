<?php

/**
 * Contao Open Source CMS
 *
 * @copyright  MEN AT WORK 2014
 * @package    randomimage
 * @license    GNU/LGPL
 * @filesource
 */

/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['randomimage'] = '{type_legend},type,headline;{text_legend},text;{image_legend},randomSRC,alt,title,size,imagemargin,imageUrl,fullsize,caption,floating;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['randomSRC'] = array
(
    'label'           => &$GLOBALS['TL_LANG']['tl_content']['randomSRC'],
    'exclude'         => true,
    'inputType'       => 'fileTree',
    'eval'            => array
    (
        'fieldType'   => 'radio',
        'files'       => false,
        'mandatory'   => true,
        'tl_class'    => 'clr'
    ),
    'sql'             => 'blob NULL'
);