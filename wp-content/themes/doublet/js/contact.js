/**
 * Contact Page JavaScript - Double T
 * Handles Contact Form AJAX submission
 */

document.addEventListener('DOMContentLoaded', () => {
    const contactForm = document.getElementById('contactForm');
    if (!contactForm) return;

    contactForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const alertBox = document.getElementById('contactAlert');
        if (alertBox) {
            alertBox.style.display = 'none';
            alertBox.innerHTML = '';
        }

        const submitBtn = contactForm.querySelector('button[type="submit"]');
        const originalText = submitBtn ? submitBtn.innerHTML : '';

        const sendingText = (window.doublet_ajax && window.doublet_ajax.i18n && window.doublet_ajax.i18n.sending) ? window.doublet_ajax.i18n.sending : 'SENDING...';
        const successText = (window.doublet_ajax && window.doublet_ajax.i18n && window.doublet_ajax.i18n.success) ? window.doublet_ajax.i18n.success : 'SENT SUCCESSFULLY!';

        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = `<span class="txt txt-14 txt-semi">${sendingText}</span>`;
        }

        const formData = new FormData(contactForm);
        if (!formData.get('action')) {
            formData.append('action', 'doublet_submit_contact');
        }
        if (!formData.get('nonce') && window.doublet_ajax) {
            const nonceVal = window.doublet_ajax.contact_nonce || window.doublet_ajax.nonce;
            if (nonceVal) formData.append('nonce', nonceVal);
        }
        if (!formData.get('lang') && window.doublet_ajax && window.doublet_ajax.current_lang) {
            formData.append('lang', window.doublet_ajax.current_lang);
        }

        const ajaxUrl = (window.doublet_ajax && window.doublet_ajax.ajax_url) ? window.doublet_ajax.ajax_url : '/wp-admin/admin-ajax.php';

        const sendContactRequest = (recaptchaToken = '') => {
            if (recaptchaToken) {
                formData.append('recaptcha_token', recaptchaToken);
            }

            fetch(ajaxUrl, {
                method: 'POST',
                body: formData,
                credentials: 'same-origin'
            })
            .then((response) => response.json())
            .then((res) => {
                if (res && res.success) {
                    if (submitBtn) {
                        submitBtn.style.backgroundColor = '#0B6F7E';
                        submitBtn.innerHTML = `<span class="txt txt-14 txt-semi">&#10003; ${successText}</span>`;
                    }
                    if (alertBox) {
                        alertBox.style.display = 'block';
                        alertBox.style.backgroundColor = 'rgba(32, 183, 198, 0.12)';
                        alertBox.style.color = '#0B6F7E';
                        alertBox.style.border = '1px solid #20B7C6';
                        alertBox.textContent = (res.data && res.data.message) ? res.data.message : successText;
                    }

                    setTimeout(() => {
                        contactForm.reset();
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.style.backgroundColor = '';
                            submitBtn.innerHTML = originalText;
                        }
                    }, 2500);
                } else {
                    const errMsg = (res && res.data && res.data.message) ? res.data.message : 'Có lỗi xảy ra, vui lòng thử lại.';
                    if (alertBox) {
                        alertBox.style.display = 'block';
                        alertBox.style.backgroundColor = 'rgba(235, 31, 48, 0.1)';
                        alertBox.style.color = '#EB1F30';
                        alertBox.style.border = '1px solid #EB1F30';
                        alertBox.textContent = errMsg;
                    }
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalText;
                    }
                }
            })
            .catch((err) => {
                console.error('Contact form submission error:', err);
                if (alertBox) {
                    alertBox.style.display = 'block';
                    alertBox.style.backgroundColor = 'rgba(235, 31, 48, 0.1)';
                    alertBox.style.color = '#EB1F30';
                    alertBox.style.border = '1px solid #EB1F30';
                    const connErrMsg = (window.doublet_ajax && window.doublet_ajax.i18n && window.doublet_ajax.i18n.error) ? window.doublet_ajax.i18n.error : 'Connection error, please try again later.';
                    alertBox.textContent = connErrMsg;
                }
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }
            });
        };

        const siteKey = (window.doublet_ajax && window.doublet_ajax.recaptcha_site_key) ? window.doublet_ajax.recaptcha_site_key : '';
        if (typeof window.grecaptcha !== 'undefined' && siteKey) {
            window.grecaptcha.ready(() => {
                window.grecaptcha.execute(siteKey, { action: 'contact' })
                    .then((token) => sendContactRequest(token))
                    .catch((err) => {
                        console.warn('reCAPTCHA execution error:', err);
                        sendContactRequest('');
                    });
            });
        } else {
            sendContactRequest('');
        }
    });
});
