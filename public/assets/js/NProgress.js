
document.addEventListener('livewire:load', function () {
    Livewire.hook('message.sent', () => {
        NProgress.start();
    });

    Livewire.hook('message.processed', () => {
        NProgress.done();
    });
});

// NProgress.configure({ showSpinner: false });
