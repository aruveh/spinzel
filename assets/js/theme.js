(function(){
    const form = document.getElementById('newsletterForm');
    const submitButton = document.getElementById('newsLetterBtn');
    if(!form) return;
    form.addEventListener('submit', async function (e) {

        e.preventDefault();

        submitButton.disabled = true;
        submitButton.textContent = 'Subscribing...';

        const email = document.getElementById('newsletterEmail').value;

        const formData = new FormData();
        formData.append('form_nonce', '286d0dd94f');
        formData.append('email', email);

        try {

            const response = await fetch(
                'https://www.spinzel.com/wp-json/metform/v1/entries/insert/2202',
                {
                    method: 'POST',
                    body: formData
                }
            );

            const result = await response.json();

            if (response.ok) {

                document.getElementById('newsLetterBtn').textContent =
                    'Subscribed!';
                submitButton.style.background = 'var(--amber)';
                form.reset();

            } else {

                document.getElementById('message').textContent =
                    result.message || 'Something went wrong.';
            }

        } catch (error) {
            submitButton.disabled = false;
            submitButton.textContent = 'Get Started Free →';
            document.getElementById('message').textContent =
                'Network error.';
        }

    });
})();

(function () {
    const script1 = {
        div_id: 'fullscreen',
        theme_style: 1,
        order_by: 2,
        limit_surveys: 7
    };
    const script2 = {
        div_id: 'cpx_fullscreen',
        theme_style: 1,
        order_by: 2,
        limit_surveys: 7
    };

    const config = {
        general_config: {
            app_id: "32507",
            ext_user_id: "user_1",
            secure_hash: "f6828b276977f34bd7f3062f47982d3ff82b8f1f7fb1462d942005f03b74e3ad"
        },        
        style_config: {
            text_color: '#2b2b2b',
            survey_box: {
                topbar_background_color: '#ffaf20',
                box_background_color: 'white',
                rounded_borders: true,
                stars_filled: 'black',
            },
        },
        script_config: [script1, script2],
        debug: false,
        useIFrame: true
    };

    window.config = config;
})();