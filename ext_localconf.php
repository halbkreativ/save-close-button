<?php
declare(strict_types=1);

defined('TYPO3') or die();

// Hook for adding Save+Close Button
// needed for v11 (v12+ uses EventListener instead)
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['Backend\Template\Components\ButtonBar']['getButtonsHook'][]
    = \halbkreativ\SaveCloseButton\Hooks\SaveCloseButtonHook::class . '->addSaveCloseButton';
