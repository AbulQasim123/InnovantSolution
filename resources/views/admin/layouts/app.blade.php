<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />
    <meta property="og:image" content="https://www.notiontechnologies.com/resources/admin-og/auto-og.png" />
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

    @include('admin.partials.style')
    @livewireStyles
</head>

<body class="flex h-screen">
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('admin.partials.sidebar')
            <div class="layout-page">
                @include('admin.partials.header')
                <div class="content-wrapper">
                    {{ $slot }}
                    @include('admin.partials.footer')
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
    </div>

    @livewireScripts
    @include('admin.partials.script')

    <x-toast-alert />


    <script>
        // First time page load
        document.addEventListener("DOMContentLoaded", () => {
            if (typeof window.initMainScripts === 'function') {
                window.initMainScripts();
            }
        });

        // After Livewire navigate
        document.addEventListener("livewire:navigated", () => {
            setTimeout(() => {
                if (typeof window.initMainScripts === 'function') {
                    window.initMainScripts();
                }
            }, 50);
        });
    </script>

    <script>
        // Add this function
        function closeAllDropdowns() {
            const openDropdowns = document.querySelectorAll('.dropdown-menu.show');
            openDropdowns.forEach(dropdown => {
                const parent = dropdown.closest('.dropdown');
                if (parent) {
                    const toggle = parent.querySelector('.dropdown-toggle');
                    if (toggle) {
                        toggle.classList.remove('show');
                        toggle.setAttribute('aria-expanded', 'false');
                    }
                    dropdown.classList.remove('show');
                }
            });
        }

        // Update existing event listeners
        document.addEventListener("DOMContentLoaded", () => {
            closeAllDropdowns();
            if (typeof window.initMainScripts === 'function') {
                window.initMainScripts();
            }
        });

        document.addEventListener("livewire:navigated", () => {
            closeAllDropdowns();
            setTimeout(() => {
                if (typeof window.initMainScripts === 'function') {
                    window.initMainScripts();
                }
            }, 50);
        });

        // Add this for browser back/forward navigation
        window.addEventListener('popstate', () => {
            setTimeout(closeAllDropdowns, 50);
        });
    </script>

</body>

</html>
