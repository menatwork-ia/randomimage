<?php

/**
 * Contao Open Source CMS
 *
 * @copyright  MEN AT WORK 2014
 * @package    randomimage
 * @license    GNU/LGPL
 * @filesource
 */

class ContentRandomImage extends ContentElement
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'ce_text';

    /**
     * Return if the image does not exist
     * @return string
     */
    public function generate()
    {
		// UUID to path
		if(version_compare(VERSION, '3.0', '>='))
		{
			$this->arrData['randomSRC'] = \FilesModel::findByPk($this->arrData['randomSRC'])->path;
		}
		
        // Check if we have a folder
        if (!is_dir(TL_ROOT . "/" . $this->arrData['randomSRC']))
        {
            $this->singleSRC = '';
        }
        else
        {
            $arrAllowedImages = trimsplit(",", $GLOBALS['TL_CONFIG']['validImageTypes']);
            $arrFiles         = array();

            // Scan for picture        
            foreach (scan(TL_ROOT . "/" . $this->arrData['randomSRC']) as $value)
            {
                // Build path
                $strFile = TL_ROOT . "/" . $this->arrData['randomSRC'] . "/" . $value;

                // Check if we have a file and if the file from tpye $arrAllowedImages
                if (is_file($strFile) && in_array(pathinfo($value, PATHINFO_EXTENSION), $arrAllowedImages))
                {
                    $arrFiles[] = $this->arrData['randomSRC'] . "/" . $value;
                }
            }

            // Get a random picture
            if (!empty($arrFiles))
            {
                $this->singleSRC = $arrFiles[array_rand($arrFiles, 1)];
                $this->arrData['singleSRC'] = $this->singleSRC;
            }
        }
		
       
		
        if (!strlen($this->singleSRC) || !is_file(TL_ROOT . '/' . $this->singleSRC))
        {
            return '';
        }
		
		$this->arrData['cssID'][1] = 'ce_text ' . $this->arrData['cssID'][1];

        return parent::generate();
    }

    /**
     * Generate the content element
     */
    protected function compile()
    {
        $this->addImageToTemplate($this->Template, $this->arrData);
    }

}