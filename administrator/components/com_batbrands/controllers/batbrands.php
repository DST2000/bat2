<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_batbrands
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\Utilities\ArrayHelper;

/**
 * Batbrands list controller class.
 *
 * @since  1.6
 */
class BatbrandsControllerBatbrands extends JControllerAdmin
{
	/**
	 * The prefix to use with controller messages.
	 *
	 * @var    string
	 * @since  1.6
	 */
	protected $text_prefix = 'COM_BATBRANDS_BATBRANDS';

	/**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 *
	 * @see     JControllerLegacy
	 * @since   1.6
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);

		$this->registerTask('sticky_unpublish', 'sticky_publish');
	}

	/**
	 * Method to get a model object, loading it if required.
	 *
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  JModelLegacy  The model.
	 *
	 * @since   1.6
	 */
	public function getModel($name = 'Batbrand', $prefix = 'BatbrandsModel', $config = array('ignore_request' => true))
	{
		return parent::getModel($name, $prefix, $config);
	}

	/**
	 * Stick items
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	public function sticky_publish()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$ids    = $this->input->get('cid', array(), 'array');
		$values = array('sticky_publish' => 1, 'sticky_unpublish' => 0);
		$task   = $this->getTask();
		$value  = ArrayHelper::getValue($values, $task, 0, 'int');

		if (empty($ids))
		{
			JError::raiseWarning(500, JText::_('COM_BATBRANDS_NO_BATBRANDS_SELECTED'));
		}
		else
		{
			// Get the model.
			/** @var BatbrandsModelBatbrand $model */
			$model = $this->getModel();

			// Change the state of the records.
			if (!$model->stick($ids, $value))
			{
				JError::raiseWarning(500, $model->getError());
			}
			else
			{
				if ($value == 1)
				{
					$ntext = 'COM_BATBRANDS_N_BATBRANDS_STUCK';
				}
				else
				{
					$ntext = 'COM_BATBRANDS_N_BATBRANDS_UNSTUCK';
				}

				$this->setMessage(JText::plural($ntext, count($ids)));
			}
		}

		$this->setRedirect('index.php?option=com_batbrands&view=batbrands');
	}
}
