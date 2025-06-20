<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Hotel Hebat - Your Luxury Stay Destination">
    <title>Snak Nv Hotel</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('img/logo.png')}}">
    
    <!-- CSS -->
    <link href="{{asset('Boostrap5/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Siemreap&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    
    <style>
        :root {
            --primary-color: #ff4d4d;
            --secondary-color: #2c3e50;
            --text-color: #333;
            --light-bg: #f8f9fa;
        }
        
        body {
            font-family: 'Poppins', 'Siemreap', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
        }
        
        .navbar {
            backdrop-filter: blur(10px);
            background-color: rgba(33, 37, 41, 0.95) !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar .nav-link {
            font-weight: 500;
            transition: color 0.3s ease;
            margin: 0 10px;
        }
        
        .navbar .nav-link:hover {
            color: var(--primary-color) !important;
        }
        
        .btn-danger {
            background-color: var(--primary-color);
            border: none;
            padding: 8px 20px;
            border-radius: 25px;
            transition: transform 0.3s ease;
        }
        
        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255,77,77,0.2);
        }
        
        .logo {
            transition: transform 0.3s ease;
        }
        
        .logo:hover {
            transform: scale(1.05);
        }
        
        main {
            min-height: calc(100vh - 60px);
        }
        
        /* Modern Loading Animation */
        .loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: white;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>


<body>
    <!-- Loading Animation -->
    <div class="loading" id="loader">
        <div class="spinner-border text-danger" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a href="{{ url('/')}}" class="navbar-brand">
                <img class="logo" width="80px" src="{{ asset('img/logo.png') }}" alt="Hotel Hebat Logo">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a href="{{ url('/')}}" class="nav-link" aria-current="page" href="#services">ទំព័រដើម</a>
                    <a class="nav-link" aria-current="page" href="#services">សេវាកម្ម</a>
                    {{-- <a class="nav-link" href="#gallery">រូបភាព</a> --}}
                    <a class="nav-link" href="{{url('page/about-us')}}">អំពីយើង</a>
                    <a class="nav-link" href="{{url('page/contact-us')}}">ទំនាក់ទំនងយើង</a>
                    @if(Session::has('customerlogin'))
                    <a class="nav-link" href="{{url('customer/add-testimonial')}}">បន្ថែមមតិ</a>
                    <a class="nav-link" href="{{url('logout')}}">ចាកចេញ</a>
                    <a class="nav-link btn btn-danger" href="{{url('booking')}}">ការកក់</a>
                    @else
                    <a class="nav-link" href="{{url('login')}}">ចូលប្រើប្រាស់</a>
                    <a class="nav-link" href="{{url('register')}}">ចុះឈ្មោះ</a>
                    <a class="nav-link btn btn-danger" href="{{url('booking')}}">ការកក់</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-5">
        @yield('content')
    </main>

    <!-- Scripts -->
    <script type="text/javascript" src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('Boostrap5/bootstrap.bundle.min.js')}}"></script>
    <script>
        // Loading Animation
        window.addEventListener('load', function() {
            document.getElementById('loader').style.display = 'none';
        });
        
        // Smooth Scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>