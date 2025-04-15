<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            position: fixed;
            width: 250px;
            height: 100%;

            /* Necessary for the icon to show outside the sidebar */
            overflow: visible;
            z-index: 99;
        }

        .shrink {
            left: -250px;
        }

        .icon {
            position: absolute;
            transform: translateY(10%);
            left: 250px;
            padding: 10px;
            cursor: pointer;
        }

        /* Light Mode */
        .sidebar {
            background-color: rgb(255, 255, 255);
            color: black;
            border: 1px solid grey;
        }

        .sidebar a {
            font-size: 1.2em;
            color: black;
            text-decoration: none;
        }

        .icon {
            color: #fff !important;
            background-color: #7a12e1 !important;
        }


        /* Dark Mode */




        /* Custom Icon */
        .icon {
            border-top-right-radius: 35px;
            border-bottom-right-radius: 35px;
        }


        body {
            background-color: #e8e3e3;
        }

        .btn-primary {
            color: #fff !important;
            background-color: #7a12e1 !important;
            border-color: #7a12e1 !important;
        }

        .btn-primary:hover {
            color: #fff !important;
            background-color: #460a83 !important;
            border-color: #460a83 !important;
        }

        .color-text {
            color: #460a83 !important;
        }

        .color-area {
            background-color: #460a83 !important;
        }
    </style>

    <div class="wrapper d-flex1">


        <div class="sidebar">
            <!-- Sidebar content goes here -->
            <div class="icon">Icon</div>



            <div class="sidebar-profile text-center">
                <h2 class="text-center">Dashboard</h2>
                <hr>
                <img class="rounded-circle" style="width: 100px; height:100px" src="{{ Auth::user()->getImage() }}"
                    alt="">
                <h5>Name here</h5>
            </div>

            <ul class="sidebar-links list-group p-0 border border-0">
                <li class="list-group-item border border-0"><a href="{{ route('authors.recipes.index') }}">Dashboard</a>
                </li>
                <li class="list-group-item border border-0"><a href="{{ route('chefs.index') }}">RecipeNest</a></li>
                <li class="list-group-item border border-0"><a
                        href="{{ route('authors.profile.edit', ['profile' => Auth::id()]) }}">Profile</a></li>
                <li class="list-group-item border border-0"><a href="{{ route('authors.recipes.create') }}">Create
                        Recipe</a></li>
                <li class="list-group-item border border-0"><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>


                </li>





            </ul>
        </div>


        <style>
            @media (max-width: 767.98px) {

                .custom-navbar-nav {
                    justify-content: center !important;
                    width: 100% !important;
                    text-align: center !important;
                }

            }
        </style>
        <nav class="navbar navbar-expand-md bg-light navbar-light justify-content-end">

            <!-- Toggler/collapsible Button -->
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse"
                data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links -->
            <div class="collapse navbar-collapse justify-content-between aligh-items-center1 w-100"
                id="collapsibleNavbar">
                <ul class="navbar-nav custom-navbar-nav ml-auto justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                </ul>
            </div>
        </nav>
        <br>


        <div class="main-content container my-5">


            <div class="toggle-body mb-5">
                <button class="btn btn-primary mytoggle float-right">Toggle</button>
            </div>



            {{ $slot }}


            <!-- loader -->
            <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
                    <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
                    <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                        stroke="#F96D00" />
                </svg></div>


        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom JavaScript -->
    <script>
        $(document).ready(function() {
            $('.mytoggle, .icon').click(function() {
                $('.sidebar').toggleClass('shrink');
            });
        });
    </script>

    <script src="{{ asset('scripts/image-preview.js') }}"></script>
    @stack('scripts')

</body>

</html>