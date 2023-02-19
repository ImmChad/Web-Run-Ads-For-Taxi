<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Set Icon Logo -->
    <link rel="icon" href="{{ asset('uploads/images/logo.png') }}"> 

    <!-- Use bootstrap 4.0.0 -->
    <!-- Use font awesome 6.3.0 -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/css/dataTables.bootstrap4.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css'>
    {{-- <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'> --}}
    
    
    <link rel="stylesheet" href="{{ asset('backend/css/newStyle.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}"> --}}
</head>
<body>
    <style>
        .dropdown-result-taxi {
            width: 100%;
            position: absolute;
            max-height: 400px;
            height: 400px;
            background: white;
            box-shadow: 0px 4px 20px -1px black;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            margin-top: 5px;
            display:none;
        }
        .mess-search-taxi
        {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100%;
            font-size: 30px;
        }

        .section-search-search-taxi{
           position: relative; 
        }
        
        .item-result-taxi,.item-result-taxi:hover
        {
            display: block;
            margin: 10px;
            font-size: 20px;
            color: #c82e2e!important;
            font-weight: bold;
            cursor: pointer;
            border-bottom: 1px solid #c82e2e;
   
        }
        .list-result-taxi
        {
            height:100%
        }
    </style>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top navbar-run-ads" id="mainNav">
        {{-- <a class="navbar-brand" href="#">LIFE SOUND</a> --}}
        <h1 class="purples">Run Ads Taxi</h1>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto" style="display: flex; justify-content: center; align-items: center">
                <li class="nav-item section-search-search-taxi">
                    <form class="form-inline my-2 my-lg-0 mr-lg-2">
                        <div class="input-group big-input-header">
                            <input class="form-control input-header ipt-search-taxi" type="text" placeholder="Search taxi with vehicle number">
                            <span class="input-group-append">
                                <button class="btn btn-search-header" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                    <div class="dropdown-result-taxi">
                        <div class="list-result-taxi">
                            <div class="mess-search-taxi">
                            Please Enter Vehicle Number
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto" style="display: flex; justify-content: center; align-items: center">
                <li class="nav-item click-profile-admin" style="margin: 0px 10px">
                    @if(session()->has('inforAdmin'))
                        <span style="color: #c82e2e; cursor: pointer; font-weight: 700;">{{ session()->get('inforAdmin')->name_admin }}</span>
                    @endif
                    
                    {{-- <img src="{{ asset('uploads/admin/boy_volleyball.png') }}" class="avatar-navbar" style="width: 50px;
                        height: 50px;
                        object-fit: cover;
                        border: 2px solid #c82e2e;
                        border-radius: 0px;
                        cursor: pointer;">
                        <span style="color: #c82e2e; cursor: pointer; font-weight: 700;">Tùng Admin</span> --}}
                </li>
                <li class="nav-item" style="">
                    <a class="nav-link" href="/logout-admin" style="color: #c82e2e; display: flex; justify-content: center; align-items: center; flex-wrap: nowrap;"><i class="fa fa-fw fa-sign-out" style="color: #c82e2e; font-size: 25px "></i></a>
                </li>
            </ul>
        </div>
    </nav>


    <div class="content-wrapper">
        <div class="row" style="width: 100%; height: 100%">
            <div class="col-md-2 view-navigation-page">
                <div class="box-page" id="">
                    {{-- Dashboard --}}
                    @if ($pagination == 1)
                        <div class="sub-box-page" style="background-color: #c82e2e;">
                            <a class="nav-link" href="/dashboard" style="color: white !important;">
                    @else
                        <div class="sub-box-page">
                            <a class="nav-link" href="/dashboard">
                    @endif
                            <i class="fa fa-fw fa-dashboard"></i>
                            <div class="text-in-box-page">
                                <span class="nav-link-text">Dashboard</span>
                            </div>
                        </a>
                    </div>
                    {{-- List of Taxi --}}
                    @if ($pagination == 2)
                        <div class="sub-box-page" style="background-color: #c82e2e;">
                            <a class="nav-link" href="/car/all-car" style="color: white !important;">
                    @else
                        <div class="sub-box-page">
                            <a class="nav-link" href="/car/all-car">
                    @endif
                            <i class="fa-solid fa-car"></i>
                            <div class="text-in-box-page">
                                <span class="nav-link-text">List of Taxi</span>
                            </div>
                        </a>
                    </div>
                    {{-- List of Group --}}
                    @if ($pagination == 3)
                        <div class="sub-box-page" style="background-color: #c82e2e; color: white !important;">
                            <a class="nav-link" href="/company/all-company" style="color: white !important;">
                    @else
                        <div class="sub-box-page">
                            <a class="nav-link" href="/company/all-company" >
                    @endif
                            <i class="fa-solid fa-building"></i>
                            <div class="text-in-box-page">
                                <span class="nav-link-text">List of Group</span>
                            </div>
                        </a>
                    </div>
                    {{-- video management --}}
                    @if ($pagination == 4)
                        <div class="sub-box-page" style="background-color: #c82e2e; ">
                            <a class="nav-link" href="/video/all-video" style="color: white !important;">
                    @else
                        <div class="sub-box-page">
                            <a class="nav-link" href="/video/all-video">
                    @endif
                            <i class="fa-solid fa-film"></i>
                            <div class="text-in-box-page">
                                <span class="nav-link-text">video management</span>
                            </div>
                        </a>
                    </div>
                    
                    
                    
                </div>
            </div>
            <div class="col-md-10 view-content-page">
                @yield('contentAdmin')
            </div>
        </div>
    </div>

    <div class="toast">
        <div class="toast-content">
            <i class="fa fa-info check" aria-hidden="true"></i>
            {{-- <i class="fa-solid fa-circle-info"></i> --}}


            <div class="message">
                <span class="text text-1">Notification !!!</span>
                <span class="text text-2">Your changes has been saved</span>
            </div>
        </div>
        {{-- <i class="fa-solid fa-xmark close"></i> --}}
        <i class="fa fa-times close" aria-hidden="true" style="font-size: 20px;"></i>
        <div class="progress"></div>
    </div>


    <div class="loading_proccess">
        <img class="icon_loading" src="{{ asset('uploads/images/loading.gif') }}" alt="" />
        <h1 class="text_percent_process purples">100%</h1>
    </div>

    <div class="pop-up-ads">
        <div class="exit-pop-up-ads">
            <i class="fa-solid fa-x"></i>
        </div>



    </div>

</body>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.5/umd/popper.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js'></script>
    <script src="{{ asset('backend/js/admin.js') }}"></script>
    <script src="{{ asset('backend/js/searchTaxi.js') }}"></script>

    <script>

        @if(isset($messToast))
            displayToast('{{ json_decode($messToast) }}');
        @endif
    </script>
</html>