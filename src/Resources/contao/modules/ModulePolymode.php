<?php

namespace Duncrow\PolymodeBundle\Module;

use Contao\BackendTemplate;
use Contao\FilesModel;
use Contao\Module;
use Duncrow\PolymodeBundle\Mobile_Detect;

class ModulePolymode extends Module
{
	protected $strTemplate;

	public function generate()
	{
	    // If not template is selected in the settings of the module, set default template to polymode
        if(!$this->polymode_template) $this->polymode_template = 'mod_polymode';
        if(!$this->polymode_mobileTemplate) $this->polymode_mobileTemplate = 'mod_polymode_mobile';

        // Detect mobile & tablet or desktop, and set template accordingly
        $detect = new Mobile_Detect();
        ($detect->isMobile()) ? $this->strTemplate = $this->polymode_mobileTemplate : $this->strTemplate = $this->polymode_template;

		if (TL_MODE == 'BE')
		{
			/** @var \BackendTemplate|object $objTemplate */
			$objTemplate = new BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### POLYMODE ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

        $buildFile = FilesModel::findByUuid($this->polymode_buildFile);

        $GLOBALS['TL_CSS'][] = '/bundles/polymode/assets/featherlight-1.7.13/featherlight.min.css';
        $GLOBALS['TL_CSS'][] = '/bundles/polymode/css/polymode.css';
        $GLOBALS['TL_JAVASCRIPT'][] = '/bundles/polymode/assets/featherlight-1.7.13/featherlight.min.js';
        $GLOBALS['TL_JAVASCRIPT'][] = $buildFile->path;
        $GLOBALS['TL_BODY'][] = '<script src="/bundles/polymode/js/polymode.js"></script>';

		return parent::generate();
	}


	/**
	 * Generate the module
	 */
	protected function compile()
	{
        $buildFile = FilesModel::findByUuid($this->polymode_buildFile);
        $indexOfSecondLastDot = strpos($buildFile->path, '.', strpos($buildFile->path, '.') + strlen('.'));
        $this->Template->path = str_split($buildFile->path, $indexOfSecondLastDot)[0];
	}
}
