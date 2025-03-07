document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('select-all').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('input[name="selected_playlists[]"]');
        checkboxes.forEach(checkbox => {
            if (!checkbox.disabled) {
                checkbox.checked = this.checked;
            }
        });
    });

    let successMessage = document.querySelector('.container').getAttribute('data-success-message');
    if (successMessage && successMessage.trim() !== "") {
        alert(successMessage);
    }
});
