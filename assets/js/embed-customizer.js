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
const embedText = document.querySelectorAll('input[name="emcs-embed-text"]');
const embedTextSize = document.querySelectorAll('input[name="emcs-embed-text-size"]');
const embedTextColor = document.querySelectorAll('input[name="emcs-embed-text-color"]');
const embedButtonStyle = document.querySelector('select[name="emcs-embed-button-style"]');
const embedButtonSize = document.querySelector('select[name="emcs-embed-button-size"]');
const embedButtonBackground = document.querySelector('input[name="emcs-embed-button-background"]');


// Handle the start customization button click
startCustomizingButton.addEventListener('click', showDefaultCustomizer);

function showDefaultCustomizer(e) {
    e.preventDefault();
    showInlineFormCustomizer();
}

// ---------- Start Handling Form Inputs -------------

// Handle switching to any selected customizer
chooseEmbedTypeSelect.forEach(element => {
    element.addEventListener('input', changeEmbedType);
});

function changeEmbedType() {
    switch (this.value) {
        case 'emcs-inline-text':
            return showInlineFormCustomizer();
        case 'emcs-popup-text':
            return showPopupTextFormCustomizer();
        case 'emcs-popup-button':
            return showPopupButtonFormCustomizer();
        default:
            return showInlineFormCustomizer();
    }
}

function showInlineFormCustomizer() {

    let option = prepareEmbedCustomizerOptions(1);

    hideAllEmbedCustomizersExcept(inlineFormCustomizerForm);
    resetEmbedTypeSelector(inlineFormCustomizerForm, 0);
    updateGeneratedShortcode(option, inlineFormCustomizerForm);
}

function showPopupTextFormCustomizer() {

    let option = prepareEmbedCustomizerOptions(2);

    hideAllEmbedCustomizersExcept(popupTextCustomizerForm);
    resetEmbedTypeSelector(popupTextCustomizerForm, 1);
    updateGeneratedShortcode(option, popupTextCustomizerForm);
}

function showPopupButtonFormCustomizer() {

    let option = prepareEmbedCustomizerOptions(3);

    hideAllEmbedCustomizersExcept(popupButtonCustomizerForm);
    resetEmbedTypeSelector(popupButtonCustomizerForm, 2);
    updateGeneratedShortcode(option, popupButtonCustomizerForm);
}

function resetEmbedTypeSelector(customizerForm, index) {
    customizerForm.querySelector('select[name="emcs-customizer-embed-type"]').selectedIndex = index;
}

function hideAllEmbedCustomizersExcept(customizer = '') {
    if (customizer !== '') {

        // start by hiding alll customizer forms
        chooseCustomizerForm.style.display = 'none';
        inlineFormCustomizerForm.style.display = 'none'
        popupTextCustomizerForm.style.display = 'none';
        popupButtonCustomizerForm.style.display = 'none';

        // display only the right customizer
        customizer.style.display = 'block';
    }
}

// -------------------------------- Inline Form Inputs -------------------------------------------------

// Handles form height input
formHeight.addEventListener('input', updateInlineEmbedCustomizer);

// Handles form width input
formWidth.addEventListener('input', updateInlineEmbedCustomizer);

function updateInlineEmbedCustomizer() {
    updateEmbedCustomizerPreview(1, inlineFormCustomizerForm);
}

// -------------------------------- Popup Text Inputs -------------------------------------------------

// Handle embed text input
embedText.forEach(element => {
    element.addEventListener('input', updatePopupTextCustomizer);
});

// Handle embed text size input
embedTextSize.forEach(element => {
    element.addEventListener('input', updatePopupTextCustomizer);
});

// Handle embed text color input
embedTextColor.forEach(element => {
    element.addEventListener('input', updatePopupTextCustomizer);
});

function updatePopupTextCustomizer() {

    updateEmbedCustomizerPreview(2, popupTextCustomizerForm);
    updateEmbedCustomizerPreview(3, popupButtonCustomizerForm);
}

// -------------------------------- Popup Button Inputs -------------------------------------------------

// Handle embed button style select
embedButtonStyle.addEventListener('change', updatePopupButtonCustomizer);

// Handle embed button size select
embedButtonSize.addEventListener('change', updatePopupButtonCustomizer);

// Handle embed button background input
embedButtonBackground.addEventListener('input', updatePopupButtonCustomizer);

function updatePopupButtonCustomizer() {
    updateEmbedCustomizerPreview(3, popupButtonCustomizerForm);
}

function updateEmbedCustomizerPreview(customizerType = 1, customizerForm = '') {
    let option = prepareEmbedCustomizerOptions(customizerType);
    updateGeneratedShortcode(option, customizerForm);
}

/**
 * Get default embed customizer options and update new values when available
 * @param {String} customizer Embed customizer type
 * @param {Object} option_value Updated option
 * @returns Embed customizer option object
 */
function prepareEmbedCustomizerOptions(customizer = 1) {

    let inlineCustomizerOptions = {
        type: 1,
        form_height: formHeight.value,
        form_width: formWidth.value
    }

    let popupTextCustomizerOption = {
        type: 2,
        text: popupTextCustomizerForm.querySelector('input[name="emcs-embed-text"]').value,
        text_color: popupTextCustomizerForm.querySelector('input[name="emcs-embed-text-color"]').value,
        text_size: popupTextCustomizerForm.querySelector('input[name="emcs-embed-text-size"]').value
    }

    let popupButtonCustomizerOption = {
        type: 3,
        text: popupButtonCustomizerForm.querySelector('input[name="emcs-embed-text"]').value,
        text_color: popupButtonCustomizerForm.querySelector('input[name="emcs-embed-text-color"]').value,
        text_size: popupButtonCustomizerForm.querySelector('input[name="emcs-embed-text-size"]').value,
        button_style: getPopupButtonProperties().style,
        button_size: getPopupButtonProperties().size,
        button_background: getPopupButtonProperties().background
    }

    switch (customizer) {
        case 1:
            return inlineCustomizerOptions;
        case 2:
            return popupTextCustomizerOption;
        case 3:
            return popupButtonCustomizerOption;
        default:
            return inlineCustomizerOptions;
    }
}

function getPopupButtonProperties() {
    let embedButtonProperties = {};

    if (popupButtonCustomizerForm.querySelector('select[name="emcs-embed-button-style"]').value == 'emcs-embed-button-float') {
        embedButtonProperties.style = 2;
    } else {
        embedButtonProperties.style = 1;
    }

    switch (popupButtonCustomizerForm.querySelector('select[name="emcs-embed-button-size"]').value) {
        case 'emcs-embed-button-small':
            embedButtonProperties.size = 1;
            break;

        case 'emcs-embed-button-medium':
            embedButtonProperties.size = 2;
            break;

        default:
            embedButtonProperties.size = 3;
    }

    embedButtonProperties.background = popupButtonCustomizerForm.querySelector('input[name="emcs-embed-button-background"]').value;

    return embedButtonProperties;
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
        shortcode.innerHTML = generateShortcode(getDefaultShortcodeOptionString());

    } else {
        shortcodeContainer.style.display = 'block';

        let optionString = ' ';

        for (let i in options) {
            optionString += `${i}="${ options[i] }" `;
        }

        let option = `${ getDefaultShortcodeOptionString() } ${optionString}`;
        shortcodeContainer.innerHTML = generateShortcode(option);
    }
}

function generateShortcode(options) {
    return `[calendly ${options}]`;
}

function getDefaultShortcodeOptionString() {
    return `url="${chooseCustomizerSelect.value}"`;
}

// Handles when the "back" button is clicked from any customizer type
customizerHomeButton.forEach(btn => {
    btn.addEventListener('click', showChooseCustomizerForm);
});

function showChooseCustomizerForm() {
    hideAllEmbedCustomizersExcept(chooseCustomizerForm);
}