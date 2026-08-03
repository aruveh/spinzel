(function () {
    const form = document.getElementById('newsletterForm');
    const submitButton = document.getElementById('newsLetterBtn');
    if (!form) return;
    form.addEventListener('submit', async function (e) {

        e.preventDefault();

        submitButton.disabled = true;
        submitButton.textContent = 'Subscribing...';

        const email = document.getElementById('newsletterEmail').value;

        const formData = new FormData();
        formData.append('form_type', 'newsletter');
        formData.append('email', email);

        try {

            const response = await fetch(
                'https://www.spinzel.com/wp-json/a9-forms/v1/submit',
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

function togglePwd() {
    var i = document.querySelector('#step-1.active input[type=password],#login-panel input[type=password]');
    if (i) i.type = i.type === 'password' ? 'text' : 'password';
}

function checkStrength(v) {
    var fill = document.getElementById('strength-fill');
    var score = 0;
    var checks = {
        len: v.length >= 8,
        upper: /[A-Z]/.test(v),
        num: /[0-9]/.test(v),
        special: /[^A-Za-z0-9]/.test(v)
    };
    score = Object.values(checks).filter(Boolean).length;
    var widths = ['0%', '25%', '50%', '75%', '100%'];
    var colors = ['#EF4444', '#EF4444', '#F59E0B', '#10B981', '#059669'];
    fill.style.width = widths[score];
    fill.style.background = colors[score];
    Object.keys(checks).forEach(k => {
        document.getElementById('h-' + k.replace('len', 'len').replace('upper', 'upper').replace('num', 'num').replace('special', 'special'))?.classList.toggle('met', checks[k])
    });
}

(function () {
	'use strict';

	// Prevent duplicate event listener registration if script is loaded more than once
	if (window.__a9FormsInitialized) {
		return;
	}
	window.__a9FormsInitialized = true;

	document.addEventListener('submit', function (e) {
		var form = e.target.closest('.a9-form');
		var formWrapper = form.closest('.a9-form-container');
		if (!form) return;

		e.preventDefault();

		// Guard against double submission on the form element
		if (form.dataset.isSubmitting === 'true') {
			return;
		}

		var submitBtn = form.querySelector('.a9-form-submit-btn');
		var btnText = form.querySelector('.a9-btn-text');
		var loader = form.querySelector('.a9-btn-loader');
		var responseBox = formWrapper.querySelector('.a9-form-response');

		// Basic client-side required field validation
		var isValid = true;
		var requiredInputs = form.querySelectorAll('[required]');

		requiredInputs.forEach(function (input) {
			if (!input.value.trim()) {
				isValid = false;
				input.style.borderColor = '#ef4444';
			} else {
				input.style.borderColor = '';
			}
		});

		if (!isValid) {
			if (responseBox) {
				responseBox.className = 'a9-form-response a9-error';
				responseBox.textContent = 'Please fill in all required fields.';
				responseBox.style.display = 'block';
			}
			return;
		}

		// Lock submission state
		form.dataset.isSubmitting = 'true';

		// Clear previous response & disable submit button
		if (responseBox) {
			responseBox.className = 'a9-form-response';
			responseBox.textContent = '';
			responseBox.style.display = 'none';
		}

		if (submitBtn) {
			submitBtn.disabled = true;
		}
		if (loader) {
			loader.style.display = 'inline-block';
		}

		var formData = new FormData(form);

		// Target Ajax URL from localized data or window fallback
		var ajaxUrl = 'https://www.spinzel.com/wp-json/a9-forms/v1/submit';

		fetch(ajaxUrl, {
			method: 'POST',
			body: formData,
			headers: {
				'Accept': 'application/json'
			}
		})
			.then(function (res) {
				return res.json();
			})
			.then(function (data) {
				form.dataset.isSubmitting = 'false';
				if (submitBtn) submitBtn.disabled = false;
				if (loader) loader.style.display = 'none';

				if (data && data.success) {
					if (responseBox) {
						responseBox.className = 'a9-form-response a9-success';
						responseBox.textContent = data.message || 'Thank you! Your submission has been received.';
						responseBox.style.display = 'block';
					}
					form.reset();
				} else {
					var errorMsg = (data && data.message) ? data.message : 'An error occurred. Please try again.';
					if (responseBox) {
						responseBox.className = 'a9-form-response a9-error';
						responseBox.textContent = errorMsg;
						responseBox.style.display = 'block';
					}
				}
			})
			.catch(function (err) {
				form.dataset.isSubmitting = 'false';
				if (submitBtn) submitBtn.disabled = false;
				if (loader) loader.style.display = 'none';

				if (responseBox) {
					responseBox.className = 'a9-form-response a9-error';
					responseBox.textContent = 'An unexpected error occurred. Please try again.';
					responseBox.style.display = 'block';
				}
			});
	});

	// Remove red border on input change
	document.addEventListener('input', function (e) {
		if (e.target && e.target.closest && e.target.closest('.a9-form')) {
			e.target.style.borderColor = '';
		}
	});

})();