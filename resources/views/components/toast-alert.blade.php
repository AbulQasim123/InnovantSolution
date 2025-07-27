<script>
    function setupToastr() {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-bottom-right",
            timeOut: 3000,
            extendedTimeOut: 1000,
            tapToDismiss: false,
            newestOnTop: false,
            preventDuplicates: true,
            containerId: 'toast-container'
        };
    }

    document.addEventListener('livewire:init', () => {
        setupToastr();

        // Add
        Livewire.on('data-added', (event) => {
            setupToastr();
            toastr.success(event.message, event.title);
            setTimeout(() => {
                Livewire.navigate(event.redirectUrl);
            }, 1000);
        });

        // Update
        Livewire.on('data-updated', (event) => {
            setupToastr();
            toastr.success(event.message, event.title);
            setTimeout(() => {
                Livewire.navigate(event.redirectUrl);
            }, 1000);
        });

        // Delete
        Livewire.on('data-deleted', (event) => {
            setupToastr();
            toastr.success(event.message, event.title);
            setTimeout(() => {
                Livewire.navigate(event.redirectUrl);
            }, 1000);
        });

        // Imports complete
        Livewire.on('data-complete', (event) => {
            setupToastr();
            toastr.success(event.message, event.title);
        });

        // Imports failed
        Livewire.on('data-failed', (event) => {
            setupToastr();
            toastr.success(event.message, event.title);
        });

        // Error
        Livewire.on('data-error', (event) => {
            setupToastr('error', event.message, event.title);
        });
    });

    document.addEventListener('livewire:navigated', () => {
        setupToastr();
    });
</script>

<style>
    /* Custom Toastr Styles */
    #toast-container>.toast-success {
        background-color: #e53935 !important;
        /* green */
        color: #fff !important;
        border-color: #e53935 !important;
    }

    #toast-container>.toast-error {
        background-color: #e53935 !important;
        /* red */
        color: #fff !important;
        border-color: #e53935 !important;
    }

    #toast-container>.toast-warning {
        background-color: #ff9800 !important;
        /* orange */
        color: #fff !important;
        border-color: #ff9800 !important;
    }

    #toast-container>.toast-info {
        background-color: #2196f3 !important;
        /* blue */
        color: #fff !important;
        border-color: #2196f3 !important;
    }


    #toast-container.toast-bottom-right {
        bottom: 20px !important;
        right: 20px !important;
        width: 400px !important;
        z-index: 99999 !important;
        top: auto !important;
        left: auto !important;
    }

    #toast-container.toast-bottom-right>.toast {
        position: relative !important;
        margin: 0 0 10px 0 !important;
        width: 100% !important;
    }
</style>
