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
})()