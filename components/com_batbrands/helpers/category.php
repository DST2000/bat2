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
 * Batbrands Component Category Tree
 *
 * @since  1.6
 */
class BatbrandsCategories extends JCategories
{
	/**
	 * Constructor
	 *
	 * @param   array  $options  Array of options
	 *
	 * @since   1.6
	 */
	public function __construct($options = array())
	{
		$options['table']     = '#__batbrands';
		$options['extension'] = 'com_batbrands';

		parent::__construct($options);
	}
}
