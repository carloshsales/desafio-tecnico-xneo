function loading() {
    $(document).ready(function () {
        let loadingOverlay = $("#loading-overlay");

        setTimeout(function () {
            loadingOverlay.hide();
        }, 500);
    });
}