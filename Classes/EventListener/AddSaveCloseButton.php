<?php

namespace halbkreativ\SaveCloseButton\EventListener;

use TYPO3\CMS\Backend\Template\Components\ButtonBar;
use TYPO3\CMS\Backend\Template\Components\Buttons\InputButton;
use TYPO3\CMS\Backend\Template\Components\ModifyButtonBarEvent;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class AddSaveCloseButton
 * used in TYPO3 v12 and v13
 */
class AddSaveCloseButton
{
    /**
     * @param ModifyButtonBarEvent $event
     * @return void
     */
    public function __invoke(ModifyButtonBarEvent $event): void
    {
        $buttons = $event->getButtons();

        $saveButton = $buttons[ButtonBar::BUTTON_POSITION_LEFT][2][0] ?? null;
        if ($saveButton instanceof InputButton) {

            /** @var \TYPO3\CMS\Core\Imaging\IconFactory $iconFactory */
            $iconFactory = GeneralUtility::makeInstance(IconFactory::class);

            /** @var \TYPO3\CMS\Core\Information\Typo3Version $versionInformation */
            $versionInformation = GeneralUtility::makeInstance(Typo3Version::class);

            $saveCloseButton = $event->getButtonBar()->makeInputButton()
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
                        $versionInformation->getVersion() >= 13 ? \TYPO3\CMS\Core\Imaging\IconSize::SMALL : \TYPO3\CMS\Core\Imaging\Icon::SIZE_SMALL
                    )
                )
                ->setShowLabelText(true);

            if ($versionInformation->getMajorVersion() >= 13) {
                /** @var PageRenderer $pageRenderer */
                $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
                $pageRenderer->loadJavaScriptModule('@save_close_button/form/backend/SaveCloseButton.js');
            }

            $buttons[ButtonBar::BUTTON_POSITION_LEFT][2][] = $saveCloseButton;
        }

        $event->setButtons($buttons);
    }

    /**
     * @return LanguageService
     */
    protected function getLanguageService(): LanguageService
    {
        return $GLOBALS['LANG'];
    }
}
