<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(
    [
	'bytesystems',]
);


/**
 * Register the classes
 */
ClassLoader::addClasses(
    [
	// Library
	'bytesystems\NotificationCenterExtraGateways\Gateway\Zapier'                        => 'system/modules/notification_center_extra_gateways/library/NotificationCenterExtraGateways/Gateway/Zapier.php',
	'bytesystems\NotificationCenterExtraGateways\MessageDraft\ZapierMessageDraft' => 'system/modules/notification_center_extra_gateways/library/NotificationCenterExtraGateways/MessageDraft/ZapierMessageDraft.php',
    ]
);
