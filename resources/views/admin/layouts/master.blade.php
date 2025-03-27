<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>

    <!-- App favicon -->
    <link rel="icon" type="image/png" href="{{ asset('admin/images/favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('admin/images/favicon/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('admin/images/favicon/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('admin/images/favicon/apple-touch-icon.png') }}" />
    <meta name="apple-mobile-web-app-title" content="Ouron" />
    <link rel="manifest" href="{{ asset('admin/images/favicon/site.webmanifest') }}" />

    <!-- Vendor css (Require in all Page) -->
    <link href="{{ asset('admin/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Icons css (Require in all Page) -->
    <link href="{{ asset('admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css (Require in all Page) -->
    <link href="{{ asset('admin/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Theme Config js (Require in all Page) -->
    <script src="{{ asset('admin/js/config.js') }}"></script>

    {{-- CK editor CDN --}}
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.3.0/ckeditor5.css">

</head>

<body>
    <div class="wrapper">
        @include('admin.layouts.sidebar')

        @include('admin.layouts.header')


        @yield('content')


    </div>


    <!-- Vendor Javascript (Require in all Page) -->
    <script src="{{ asset('admin/js/vendor.js') }}"></script>

    <!-- App Javascript (Require in all Page) -->
    <script src="{{ asset('admin/js/app.js') }}"></script>

    <!-- Vector Map Js -->
    <script src="{{ asset('admin/vendor/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/jsvectormap/maps/world-merc.js') }}"></script>
    <script src="{{ asset('admin/vendor/jsvectormap/maps/world.js') }}"></script>

    <!-- Dashboard Js -->
    <script src="{{ asset('admin/js/pages/dashboard.js') }}"></script>

    {{-- CK editor CDN --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/44.3.0/ckeditor5.umd.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('browse-files').addEventListener('click', function() {
                document.getElementById('product-images').click();
            });

            document.getElementById('product-images').addEventListener('change', function(event) {
                handleFiles(event.target.files);
            });

            document.getElementById('product-dropzone').addEventListener('drop', function(event) {
                event.preventDefault();
                handleFiles(event.dataTransfer.files);
            });

            document.getElementById('product-dropzone').addEventListener('dragover', function(event) {
                event.preventDefault();
            });

            function handleFiles(files) {
                const previewContainer = document.getElementById('preview-container');
                previewContainer.innerHTML = '';
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'img-thumbnail col-md-3 img-fluid';
                        previewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
    </script>

    <script>
        document.getElementById('add-color').addEventListener('click', function() {
            const newColor = document.getElementById('new-color').value;
            if (newColor) {
                const colorContainer = document.querySelector('.color-container');
                const colorId = 'color-' + newColor.replace('#', '');
                const colorInput = `<input type="checkbox" class="btn-check" name="color[]" id="${colorId}" value="${newColor}">
<label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center" for="${colorId}">
<i class="bx bxs-circle fs-18" style="color: ${newColor}"></i>
</label>`;
                colorContainer.insertAdjacentHTML('beforeend', colorInput);
                document.getElementById('new-color').value = '';
            }
        });
    </script>

    <script>
        const {
            ClassicEditor,
            Essentials,
            Paragraph,
            Bold,
            Italic,
            Font
        } = CKEDITOR;
        // Create a free account and get <YOUR_LICENSE_KEY>
        // https://portal.ckeditor.com/checkout?plan=free
        ClassicEditor
            .create(document.querySelector('#editor'), {
                licenseKey: 'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3NzQzMTAzOTksImp0aSI6ImUzNzk3NjVkLWU1OWItNDIzYi1iZTU3LWQwMGI1YTVjNTQ0NCIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiXSwiZmVhdHVyZXMiOlsiRFJVUCJdLCJ2YyI6ImQ5MWUyNzM2In0.Ikt0oR6QJPtQrbsK_CTlhKBedTJ1Y52knHtElskNLd5Gq4f0bOnrFnnlqMxOWDhXKtwoIImRZl45wWsOdTcutQ',
                plugins: [Essentials, Paragraph, Bold, Italic, Font],
                toolbar: [
                    'undo', 'redo', '|', 'bold', 'italic', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                ]
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editorBlog'), {
                licenseKey: 'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3NzQzMTAzOTksImp0aSI6ImUzNzk3NjVkLWU1OWItNDIzYi1iZTU3LWQwMGI1YTVjNTQ0NCIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiXSwiZmVhdHVyZXMiOlsiRFJVUCJdLCJ2YyI6ImQ5MWUyNzM2In0.Ikt0oR6QJPtQrbsK_CTlhKBedTJ1Y52knHtElskNLd5Gq4f0bOnrFnnlqMxOWDhXKtwoIImRZl45wWsOdTcutQ',
                plugins: [Essentials, Paragraph, Bold, Italic, Font, ],
                toolbar: [
                    'bold', 'italic', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                    'numberedList', 'bulletedList'
                ]
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(error => {
                console.error(error);
            });
    </script>




</body>

</html>
