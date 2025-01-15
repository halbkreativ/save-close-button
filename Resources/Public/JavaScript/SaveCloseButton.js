import FormEngine from '@typo3/backend/form-engine.js'

class SaveCloseButton {
    constructor() {
        let button = document.querySelector('[name=_saveandclosedok]');
        button?.addEventListener('click', (e) => {
            e.preventDefault();
            FormEngine.saveAndCloseDocument();
        })
    }
}

export default new SaveCloseButton();