/**
 * Career Detail Page JavaScript - Double T
 * Handles CV Drag & Drop and Career Application Form AJAX submission
 */

document.addEventListener('DOMContentLoaded', function () {
    const uploadArea = document.getElementById('cv-upload-area');
    const uploadInput = document.getElementById('cv-upload-input');
    const uploadText = document.getElementById('cv-upload-text');
    const initialUploadText = uploadText ? uploadText.textContent : 'Select or drag and drop files to upload';

    if (uploadArea && uploadInput && uploadText) {
        uploadArea.addEventListener('click', () => {
            uploadInput.click();
        });

        uploadInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                uploadText.textContent = file.name;
            } else {
                uploadText.textContent = initialUploadText;
            }
        });

        // Handle drag and drop
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.style.borderColor = 'var(--primary-2)';
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.style.borderColor = 'var(--border-default)';
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.style.borderColor = 'var(--border-default)';
            if (e.dataTransfer.files && e.dataTransfer.files.length > 0) {
                uploadInput.files = e.dataTransfer.files;
                uploadText.textContent = e.dataTransfer.files[0].name;
            }
        });
    }

    // Career Application Form AJAX Submission
    const careerForm = document.getElementById('careerApplyForm') || document.querySelector('.career-apply-form');
    if (!careerForm) return;

    careerForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const alertBox = document.getElementById('careerAlert');
        if (alertBox) {
            alertBox.style.display = 'none';
            alertBox.innerHTML = '';
        }

        const submitBtn = careerForm.querySelector('button[type="submit"]');
        const originalText = submitBtn ? submitBtn.innerHTML : '';

        const isVi = (window.doublet_ajax && window.doublet_ajax.current_lang === 'vi');
        const sendingText = (window.doublet_ajax && window.doublet_ajax.i18n && window.doublet_ajax.i18n.sending) 
            ? window.doublet_ajax.i18n.sending 
            : (isVi ? 'ĐANG GỬI...' : 'SENDING...');
        const successText = (window.doublet_ajax && window.doublet_ajax.i18n && window.doublet_ajax.i18n.success) 
            ? window.doublet_ajax.i18n.success 
            : (isVi ? 'GỬI HỒ SƠ THÀNH CÔNG!' : 'APPLICATION SUBMITTED!');

        // Validate CV file input
        if (uploadInput && (!uploadInput.files || uploadInput.files.length === 0)) {
            const noFileMsg = isVi ? 'Vui lòng đính kèm tệp CV ứng tuyển của bạn.' : 'Please upload your CV file.';
            if (alertBox) {
                alertBox.style.display = 'block';
                alertBox.style.backgroundColor = 'rgba(235, 31, 48, 0.1)';
                alertBox.style.color = '#EB1F30';
                alertBox.style.border = '1px solid #EB1F30';
                alertBox.textContent = noFileMsg;
            }
            return;
        }

        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = `<span class="txt txt-14 txt-semi">${sendingText}</span>`;
        }

        const formData = new FormData(careerForm);
        if (!formData.get('action')) {
            formData.append('action', 'doublet_submit_career_apply');
        }
        if (!formData.get('nonce') && window.doublet_ajax) {
            const nonceVal = window.doublet_ajax.career_nonce || window.doublet_ajax.nonce;
            if (nonceVal) formData.append('nonce', nonceVal);
        }
        if (!formData.get('lang') && window.doublet_ajax && window.doublet_ajax.current_lang) {
            formData.append('lang', window.doublet_ajax.current_lang);
        }

        const ajaxUrl = (window.doublet_ajax && window.doublet_ajax.ajax_url) ? window.doublet_ajax.ajax_url : '/wp-admin/admin-ajax.php';

        const sendCareerRequest = (recaptchaToken = '') => {
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
                        careerForm.reset();
                        if (uploadText) {
                            uploadText.textContent = initialUploadText;
                        }
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.style.backgroundColor = '';
                            submitBtn.innerHTML = originalText;
                        }
                    }, 3000);
                } else {
                    const errMsg = (res && res.data && res.data.message) ? res.data.message : (isVi ? 'Có lỗi xảy ra, vui lòng thử lại.' : 'An error occurred, please try again.');
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
                console.error('Career application submission error:', err);
                const connErrMsg = (window.doublet_ajax && window.doublet_ajax.i18n && window.doublet_ajax.i18n.error) 
                    ? window.doublet_ajax.i18n.error 
                    : (isVi ? 'Lỗi kết nối máy chủ, vui lòng thử lại sau.' : 'Connection error, please try again later.');
                if (alertBox) {
                    alertBox.style.display = 'block';
                    alertBox.style.backgroundColor = 'rgba(235, 31, 48, 0.1)';
                    alertBox.style.color = '#EB1F30';
                    alertBox.style.border = '1px solid #EB1F30';
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
                window.grecaptcha.execute(siteKey, { action: 'career' })
                    .then((token) => sendCareerRequest(token))
                    .catch((err) => {
                        console.warn('reCAPTCHA execution error:', err);
                        sendCareerRequest('');
                    });
            });
        } else {
            sendCareerRequest('');
        }
    });
});