document.addEventListener('DOMContentLoaded', function () {
    const uploadArea = document.getElementById('cv-upload-area');
    const uploadInput = document.getElementById('cv-upload-input');
    const uploadText = document.getElementById('cv-upload-text');

    if (uploadArea && uploadInput && uploadText) {
        uploadArea.addEventListener('click', () => {
            uploadInput.click();
        });

        uploadInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                uploadText.textContent = file.name;
            } else {
                uploadText.textContent = 'Select or drag and drop files to upload';
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
});