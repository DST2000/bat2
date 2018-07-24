<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_batbrands
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

/**
 * Batbrand HTML class.
 *
 * @since  2.5
 */
abstract class JHtmlBatbrand
{
	/**
	 * Display a batch widget for the client selector.
	 *
	 * @return  string  The necessary HTML for the widget.
	 *
	 * @since   2.5
	 */
	public static function clients()
	{
		JHtml::_('bootstrap.tooltip');

		// Create the batch selector to change the client on a selection list.
		return implode(
			"\n",
			array(
				'<label id="batch-client-lbl" for="batch-client" class="hasTooltip" title="'
					. JHtml::_('tooltipText', 'COM_BATBRANDS_BATCH_CLIENT_LABEL', 'COM_BATBRANDS_BATCH_CLIENT_LABEL_DESC')
					. '">',
				JText::_('COM_BATBRANDS_BATCH_CLIENT_LABEL'),
				'</label>',
				'<select name="batch[client_id]" id="batch-client-id">',
				'<option value="">' . JText::_('COM_BATBRANDS_BATCH_CLIENT_NOCHANGE') . '</option>',
				'<option value="0">' . JText::_('COM_BATBRANDS_NO_CLIENT') . '</option>',
				JHtml::_('select.options', static::clientlist(), 'value', 'text'),
				'</select>'
			)
		);
	}

	/**
	 * Method to get the field options.
	 *
	 * @return  array  The field option objects.
	 *
	 * @since   1.6
	 */
	public static function clientlist()
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true)
			->select('id As value, name As text')
			->from('#__batbrand_clients AS a')
			->order('a.name');

		// Get the options.
		$db->setQuery($query);

		try
		{
			$options = $db->loadObjectList();
		}
		catch (RuntimeException $e)
		{
			JError::raiseWarning(500, $e->getMessage());
		}

		return $options;
	}

	/**
	 * Returns a pinned state on a grid
	 *
	 * @param   integer  $value     The state value.
	 * @param   integer  $i         The row index
	 * @param   boolean  $enabled   An optional setting for access control on the action.
	 * @param   string   $checkbox  An optional prefix for checkboxes.
	 *
	 * @return  string   The Html code
	 *
	 * @see     JHtmlJGrid::state
	 * @since   2.5.5
	 */
	public static function pinned($value, $i, $enabled = true, $checkbox = 'cb')
	{
		$states = array(
			1 => array(
				'sticky_unpublish',
				'COM_BATBRANDS_BATBRANDS_PINNED',
				'COM_BATBRANDS_BATBRANDS_HTML_PIN_BATBRAND',
				'COM_BATBRANDS_BATBRANDS_PINNED',
				true,
				'publish',
				'publish'
			),
			0 => array(
				'sticky_publish',
				'COM_BATBRANDS_BATBRANDS_UNPINNED',
				'COM_BATBRANDS_BATBRANDS_HTML_UNPIN_BATBRAND',
				'COM_BATBRANDS_BATBRANDS_UNPINNED',
				true,
				'unpublish',
				'unpublish'
			),
		);

		return JHtml::_('jgrid.state', $states, $value, $i, 'batbrands.', $enabled, true, $checkbox);
	}
}
