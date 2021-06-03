const startCustomizingButton = document.querySelector('button[id="emcs-choose-customizer"]');
const customizerHomeButton = document.querySelector('button[id="emcs-customizer-home"]');
const chooseCustomizerForm = document.querySelector('.emcs-choose-customizer-form');
const inlineTextCustomizerForm = document.querySelector('.emcs-inline-text-customizer-form');

startCustomizingButton.addEventListener('click', startCustomizing);

function startCustomizing(e) {
    e.preventDefault();

    // show default customizer
    showDefaultCustomizer();
}

function showDefaultCustomizer() {
    showInlineTextCustomizer();
}

function showInlineFormCustomizer() {
    return;
}

function showInlineTextCustomizer() {
    // hide all other customizer
    chooseCustomizerForm.style.display = 'none';


    inlineTextCustomizerForm.style.display = 'block'
}

customizerHomeButton.addEventListener('click', customizerHome);

function customizerHome() {
    // hide all other customizer
    inlineTextCustomizerForm.style.display = 'none'

    chooseCustomizerForm.style.display = 'block';
}