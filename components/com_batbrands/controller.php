<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_batbrands
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Batbrands Controller
 *
 * @since  1.5
 */
class BatbrandsController extends JControllerLegacy
{
	/**
	 * Method when a batbrand is clicked on.
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	public function click()
	{
		$id = $this->input->getInt('id', 0);

		if ($id)
		{
			$model = $this->getModel('Batbrand', 'BatbrandsModel', array('ignore_request' => true));
			$model->setState('batbrand.id', $id);
			$model->click();
			$this->setRedirect($model->getUrl());
		}
	}
}
