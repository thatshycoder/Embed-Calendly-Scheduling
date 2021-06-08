// Buttons & Inputs
const startCustomizingButton = document.querySelector('button[name="emcs-choose-customizer"]');
const customizerHomeButton = document.querySelectorAll('button[name="emcs-customizer-home"]');
const chooseCustomizerSelect = document.querySelector('select[name="emcs-choose-customizer-select"]');
const chooseEmbedTypeSelect = document.querySelectorAll('select[name="emcs-customizer-embed-type"]');

// Forms
const chooseCustomizerForm = document.querySelector('.emcs-choose-customizer-form');
const inlineFormCustomizerForm = document.querySelector('.emcs-inline-form-customizer-form');
const popupTextCustomizerForm = document.querySelector('.emcs-popup-text-customizer-form');
const popupButtonCustomizerForm = document.querySelector('.emcs-popup-button-customizer-form');

// Form Fields
const formHeight = document.querySelector('input[name="emcs-embed-form-height"]');
const formWidth = document.querySelector('input[name="emcs-embed-form-width"]');

// Handle the start customization button click
startCustomizingButton.addEventListener('click', showDefaultCustomizer);

function showDefaultCustomizer(e) {
    e.preventDefault();

    //inlineFormCustomizerForm.querySelector('select[name="emcs-customizer-embed-type"]').value = 'emcs-inline-text';
    showInlineFormCustomizer('type="1"');
}

// ---------- Start Handling Form Input Actions -------------

// Handle switching to any selected customizer
chooseEmbedTypeSelect.forEach(element => {
    element.addEventListener('change', changeEmbedType);
});

function changeEmbedType() {
    switch (this.value) {
        case "emcs-inline-text":
            return showInlineFormCustomizer(`type="1"`);
        case "emcs-popup-text":
            return showPopupTextFormCustomizer(`type="2"`);
        case "emcs-popup-button":
            return showPopupButtonFormCustomizer(`type="3"`);
        default:
            return showInlineFormCustomizer(`type="1"`);
    }
}

function showInlineFormCustomizer(option = '') {
    // hide all other customizer
    chooseCustomizerForm.style.display = 'none';
    popupTextCustomizerForm.style.display = 'none';
    popupButtonCustomizerForm.style.display = 'none';

    // display only the right customizer
    inlineFormCustomizerForm.style.display = 'block'

    option += ` form_height="600" form_width="400"`;

    updateGeneratedShortcode(option, inlineFormCustomizerForm);
}

function showPopupTextFormCustomizer(option = '') {
    // hide all other customizer
    chooseCustomizerForm.style.display = 'none';
    inlineFormCustomizerForm.style.display = 'none'
    popupButtonCustomizerForm.style.display = 'none';

    // display only the right customizer
    popupTextCustomizerForm.style.display = 'block';

    updateGeneratedShortcode(option, popupTextCustomizerForm);
}

function showPopupButtonFormCustomizer(option = '') {
    // hide all other customizer
    chooseCustomizerForm.style.display = 'none';
    inlineFormCustomizerForm.style.display = 'none'
    popupTextCustomizerForm.style.display = 'none';

    // display only the right customizer
    popupButtonCustomizerForm.style.display = 'block';

    updateGeneratedShortcode(option, popupButtonCustomizerForm);
}

// handles form height
formHeight.addEventListener('input', updateEmbedFormHeight);

function updateEmbedFormHeight() {
    let height = this.value;
    let option = `form_height="${height}"`;

    updateGeneratedShortcode(option, inlineFormCustomizerForm);
}

// handles form width
formWidth.addEventListener('input', updateEmbedFormWidth);

function updateEmbedFormWidth() {
    let width = this.value;
    let option = `width="${width}"`;

    updateGeneratedShortcode(option, inlineFormCustomizerForm);
}

/**
 * Update the generated shortcode with new options
 * @param {String} options 
 */
function updateGeneratedShortcode(options, parent) {

    let shortcodeContainer = parent.querySelector('.emcs-embed-customizer-shortcode');
    shortcodeContainer.style.display = 'none'

    if (options == '' && options !== undefined) {

        shortcodeContainer.style.display = 'block';
        shortcode.innerHTML = generateShortcode(getDefaultShortcodeOptions());

    } else {
        shortcodeContainer.style.display = 'block';

        options = getDefaultShortcodeOptions() + ' ' + options;
        shortcodeContainer.innerHTML = generateShortcode(options);
    }
}

function generateShortcode(options) {
    return `[calendly ${options}]`;
}

function getDefaultShortcodeOptions() {
    return `url="${chooseCustomizerSelect.value}"`;
}

// Handles when the "back" button is clicked from any customizer type
customizerHomeButton.forEach(btn => {
    btn.addEventListener('click', showChooseCustomizerForm);
});

function showChooseCustomizerForm() {
    // hide all other customizer
    inlineFormCustomizerForm.style.display = 'none';
    popupTextCustomizerForm.style.display = 'none';
    popupButtonCustomizerForm.style.display = 'none';

    // display only the right customzier
    chooseCustomizerForm.style.display = 'block';
}