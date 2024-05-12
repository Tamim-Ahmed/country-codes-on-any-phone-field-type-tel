function enqueue_intl_tel_input() {
    // Enqueue intl-tel-input CSS
    wp_enqueue_style('intl-tel-input', 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.min.css');

    // Enqueue intl-tel-input JavaScript and utils.js
    wp_enqueue_script('intl-tel-input', 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.min.js', array('jquery'), null, true);
    wp_enqueue_script('intl-tel-input-utils', 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/utils.js', array('intl-tel-input'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_intl_tel_input');

function initialize_intl_tel_input() {
    if (is_admin()) {
        return; // Don't execute in the WordPress admin area
    }

    wp_add_inline_script('intl-tel-input', '
        document.addEventListener("DOMContentLoaded", function() {
            var inputTel = document.querySelectorAll(\'input[type="tel"]\');

            inputTel.forEach(function(input) {
                var iti = window.intlTelInput(input, {
                    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/utils.js",
                    initialCountry: "bd", // Change default country code according to your needs. Its Set default country to BD/Bangladesh
                    separateDialCode: true
                });

                iti.promise.then(function() {
                    // Clear the input field after initializing
                    input.value = "";
                });
            });
        });
    ');
}
add_action('wp_enqueue_scripts', 'initialize_intl_tel_input');
