<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  batbrands
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JLoader::register('BatbrandsHelper', JPATH_ADMINISTRATOR . '/components/com_batbrands/helpers/batbrands.php');

/**
 * Batbrands master display controller.
 *
 * @since  1.6
 */
class BatbrandsController extends JControllerLegacy
{
	/**
	 * Method to display a view.
	 *
	 * @param   boolean  $cachable   If true, the view output will be cached
	 * @param   array    $urlparams  An array of safe URL parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return  BatbrandsController  This object to support chaining.
	 *
	 * @since   1.5
	 */
	public function display($cachable = false, $urlparams = array())
	{
		BatbrandsHelper::updateReset();

		$view   = $this->input->get('view', 'batbrands');
		$layout = $this->input->get('layout', 'default');
		$id     = $this->input->getInt('id');

		// Check for edit form.
		if ($view == 'batbrand' && $layout == 'edit' && !$this->checkEditId('com_batbrands.edit.batbrand', $id))
		{
			// Somehow the person just went to the form - we don't allow that.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_batbrands&view=batbrands', false));

			return false;
		}
		elseif ($view == 'client' && $layout == 'edit' && !$this->checkEditId('com_batbrands.edit.client', $id))
		{
			// Somehow the person just went to the form - we don't allow that.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_batbrands&view=clients', false));

			return false;
		}

		return parent::display();
	}
}
