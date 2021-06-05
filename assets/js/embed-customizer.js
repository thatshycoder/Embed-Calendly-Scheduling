// Buttons & Inputs
const startCustomizingButton = document.querySelector('button[name="emcs-choose-customizer"]');
const customizerHomeButton = document.querySelectorAll('button[name="emcs-customizer-home"]');
const chooseCustomizerSelect = document.querySelector('select[name=emcs-choose-customizer-select]');

// Forms
const chooseCustomizerForm = document.querySelector('.emcs-choose-customizer-form');
const inlineFormCustomizerForm = document.querySelector('.emcs-inline-form-customizer-form');
const popupTextCustomizerForm = document.querySelector('.emcs-popup-text-customizer-form');
const popupButtonCustomizerForm = document.querySelector('.emcs-popup-button-customizer-form');

const generatedShortcode = document.querySelectorAll('.emcs-embed-customizer-shortcode');

startCustomizingButton.addEventListener('click', startCustomizing);

function startCustomizing(e) {
    e.preventDefault();

    // show default customizer and shortcode
    showDefaultCustomizer();
    showDefaultShortcode()
}

function showDefaultShortcode() {
    let shortcode = `[calendly url="${ chooseCustomizerSelect.value }"]`;

    generatedShortcode.forEach(element => {
        element.innerHTML = shortcode;
    });
}

function showDefaultCustomizer() {
    showPopupButtonFormCustomizer();
}

function showInlineFormCustomizer() {
    // hide all other customizer
    chooseCustomizerForm.style.display = 'none';
    popupTextCustomizerForm.style.display = 'none';
    popupButtonCustomizerForm.style.display = 'none';

    // display only the right form
    inlineFormCustomizerForm.style.display = 'block'
}

function showPopupTextFormCustomizer() {
    // hide all other customizer
    chooseCustomizerForm.style.display = 'none';
    inlineFormCustomizerForm.style.display = 'none'
    popupButtonCustomizerForm.style.display = 'none';

    // display only the right form
    popupTextCustomizerForm.style.display = 'block';
}

function showPopupButtonFormCustomizer() {
    // hide all other customizer
    chooseCustomizerForm.style.display = 'none';
    inlineFormCustomizerForm.style.display = 'none'
    popupTextCustomizerForm.style.display = 'none';

    // display only the right form
    popupButtonCustomizerForm.style.display = 'block';
}

customizerHomeButton.forEach(btn => {
    btn.addEventListener('click', customizerHome);
});

function customizerHome() {
    // hide all other customizer
    inlineFormCustomizerForm.style.display = 'none';
    popupTextCustomizerForm.style.display = 'none';
    popupButtonCustomizerForm.style.display = 'none';

    // display only the right form
    chooseCustomizerForm.style.display = 'block';
}

// chooseCustomizerSelect.addEventListener('change', generatedShortcode);

// generatedShortcode.forEach(element => {
//     let shortcode = element.value;

//     shortcode += '[calendly ';
//     shortcode += 'url=';
//     shortcode += ' ]';

//     generatedShortcode.innerHTML = shortcode;

// });