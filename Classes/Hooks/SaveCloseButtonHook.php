<?php

namespace halbkreativ\SaveCloseButton\Hooks;

use TYPO3\CMS\Backend\Template\Components\ButtonBar;
use TYPO3\CMS\Backend\Template\Components\Buttons\InputButton;
use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationExtensionNotConfiguredException;
use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationPathDoesNotExistException;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class SaveCloseButtonHook
 * used in TYPO3 v11
 */
class SaveCloseButtonHook
{
    /**
     * @param array $params
     * @param $buttonBar
     * @return array
     * @throws ExtensionConfigurationExtensionNotConfiguredException
     * @throws ExtensionConfigurationPathDoesNotExistException
     */
    public function addSaveCloseButton(array $params, &$buttonBar): array
    {
        $buttons = $params['buttons'];

        $saveButton = $buttons[ButtonBar::BUTTON_POSITION_LEFT][2][0] ?? null;
        if ($saveButton instanceof InputButton) {
            /** @var \TYPO3\CMS\Core\Imaging\IconFactory $iconFactory */
            $iconFactory = GeneralUtility::makeInstance(IconFactory::class);

            $saveCloseButton = $buttonBar->makeInputButton()
                ->setName('_saveandclosedok')
                ->setValue('1')
                ->setForm($saveButton->getForm())
                ->setTitle(
                    $this->getLanguageService()->sL(
                        'LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:rm.saveCloseDoc'
                    )
                )
                ->setIcon(
                    $iconFactory->getIcon(
                        'actions-document-save-close',
                        \TYPO3\CMS\Core\Imaging\Icon::SIZE_SMALL
                    )
                )
                ->setShowLabelText(true);

            $buttons[ButtonBar::BUTTON_POSITION_LEFT][2][] = $saveCloseButton;
        }

        return $buttons;
    }

    /**
     * @return LanguageService
     */
    protected function getLanguageService(): LanguageService
    {
        return $GLOBALS['LANG'];
    }
}
