<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_batbrands
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the batbrands functions only once
JLoader::register('ModBatbrandsHelper', __DIR__ . '/helper.php');

$headerText = trim($params->get('header_text'));
$footerText = trim($params->get('footer_text'));

JLoader::register('BatbrandsHelper', JPATH_ADMINISTRATOR . '/components/com_batbrands/helpers/batbrands.php');
BatbrandsHelper::updateReset();
$list = &ModBatbrandsHelper::getList($params);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');

require JModuleHelper::getLayoutPath('mod_batbrands', $params->get('layout', 'default'));
