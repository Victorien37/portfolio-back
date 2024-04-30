<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Author: Victorien Rodrigues">
        {{-- Bootstrap --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        {{-- CSRF TOKEN --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title') - Portfolio</title>
    </head>
    <body>
        @auth
            <header>
                @include('components.navbar')
                <br>
            </header>
            <main role="main">
                <div class="container">
                    <h1>@yield('title')</h1>
                    @include('components.flash-message')
                    <br>
                    @yield('content')
                </div>
            </main>
        @endauth
        @guest
            <main role="main">
                @yield('content')
            </main>
        @endguest
        {{-- Bootstrap --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        {{-- Sortable --}}
        <script src="https://cdn.jsdelivr.net/gh/RubaXa/Sortable/Sortable.min.js"></script>

        {{-- Axios --}}
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        {{-- Custom JS --}}
        <script>
            const displayImage = () => {
                const image = document.getElementById('image');
                const imageSelected = document.getElementById('image-selected');
                imageSelected.innerHTML = '';
                if (image.files.length > 0) {
                    const reader = new FileReader();
                    reader.onloadend = (e) => {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('img-fluid');
                        document.getElementById('image_base64').value = e.target.result.split(',')[1];
                        imageSelected.appendChild(img);
                    };
                    reader.readAsDataURL(image.files[0]);
                }
            };
        </script>

        {{-- Footer JS --}}
        @stack('footer_js')
    </body>
</html>
