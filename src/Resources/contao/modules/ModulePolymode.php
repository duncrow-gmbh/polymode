<?php

namespace Duncrow\PolymodeBundle\Module;

use Contao\BackendTemplate;
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

		// load the polymode.css file
        $GLOBALS['TL_CSS'][] = '/bundles/polymode/css/polymode.css';

		return parent::generate();
	}


	/**
	 * Generate the module
	 */
	protected function compile()
	{
	}
}
