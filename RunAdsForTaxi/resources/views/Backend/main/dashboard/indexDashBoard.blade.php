@extends('Backend.index')
@section('contentAdmin')
    <style>
        .dropdown-result-search{
            height: 300px;
            overflow: auto;
            display: none;
            cursor: pointer;
        }
    </style>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card" style="border: 0px" >
            <div class="card-body">
                <div style="display: flex;justify-content: space-between">
                    <div class=" col-sm-7" style="font-size: 30px; font-weight: 900;">
                        Dashboard
                    </div>
                    <div style="display: flex; align-items: center;">
                        <img style="object-fit: cover; border-radius: 0px" width="50px" height="50px"
                        src="{{ asset('uploads/images/logo.png') }}"
                        alt="">
                        <h4 class="page-title" style="color: #000000; font-weight: 700; ">
                            Cooperate with
                        </h4>
                    </div>
                </div>

                <div  class="row" style="margin-top:20px; height: 500px; margin: 0rem 2rem; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                    <div class="col-md-12 " style=" height: 500px; width: 100%">
                        <div  class="row" style="height: 100px;">
                            <div class="col-md-4" style="width: 100%; display: flex; flex-direction: column; justify-content: flex-end; align-items: flex-start;">
                                <h5 class="page-title" style="color: #000000; font-weight: 700; font-size: 18px; ">
                                    Choose Any Company: <span class="set_name_company"></span>
                                </h5>
                                <h5 class="page-title" style="color: #000000; font-weight: 700;  font-size: 18px;">
                                    And Search Car is here:
                                </h5>
                            </div>
                            <div class="col-md-8" style="  
                                width: 100%;
                                display: flex;
                                justify-content: flex-start;
                                align-items: flex-end;">
                                <div class="input-ads" style="height: 45px; width: 480px; padding: 0px; display: flex; justify-content: center; align-items: center; background-color: rgb(220 153 152); position: absolute; border: 0px;">
                                    <div class="choose-time" get_time="0">
                                        Day
                                    </div>
                                    <div class="choose-time" get_time="1">
                                        Week
                                    </div>
                                    <div class="choose-time" get_time="2">
                                        Month
                                    </div>
                                    <div class="choose-time" get_time="3">
                                        Year
                                    </div>
                                    <div id="action">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div  class="row" style="height: 100px;">
                            <div class="col-md-4" style="width: 100%; display: flex; justify-content: center; align-items: center;">
                                
                                <div class="section-ipt-search input-ads" style="border: 3px solid #c82e2e;
                                border-radius: 20px 20px 20px 20px; align-items: stretch; display: flex; flex-wrap: nowrap;">
                                    <input type="text" id="ipt-search-dashboard" taxi-id=-1 company-id=-1  placeholder="Enter vehicle num ..." style="background-color: transparent; outline: none; border: none; font-weight: 700; width: inherit; margin: 0px 0.5rem; "  />
                                    <button id="btn-submit-search-dashboard"  style="background-color: transparent; color: #c82e2e; padding: 0rem 0.5rem; cursor: pointer; font-size: 20px; border: 0px; outline: none !important;">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    <div class="dropdown-result-search">
                                        @foreach($parentGroups as $parentGroup)
                                            @foreach($parentGroup->childGroups as $childGroup)
                                                <div class="item-result-search" data-id="{{$childGroup->company_id}}" data-type="company">
                                                    <span class="label-item-search">Group</span>
                                                    <span class="value-item-search">
                                                    {{$parentGroup->company_group}}-{{$childGroup->company_group}}
                                                    </span>
                                                </div>
                                                @foreach($childGroup->taxies as $taxi)
                                                    <div class="item-result-search" data-id="{{$taxi->id}}" data-type="taxi">
                                                        <span class="label-item-search">Taxi</span>
                                                        <span class="value-item-search">
                                                            {{$taxi->vehicle_num}} 
                                                        </span>
                                                        <span class="comment-item-result">[{{$parentGroup->company_group}}-{{$childGroup->company_group}}] </span>
                                                    </div>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-8" style="width: 100%; display: flex; justify-content: center; align-items: center;">
                                <div class="input-ads" style="height: 40px; width: 100%; margin-top: 0px; margin: 0rem 2rem; display: flex;">
                                    <div class="col-md-1 previous-date" style="display: flex; justify-content: center; align-items: center; font-size: 25px;">
                                        <i class="fa-solid fa-caret-left"></i>
                                    </div>
                                    <div class="col-md-10" style="display: flex; justify-content: center; align-items: center; font-size: 20px; font-weight: 700;">
                                        <span class="choose-time-to-filter active"  get_time="1" start_date="<?php
                                                                                                date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                                                                date_default_timezone_get();
                                                                                                $today = date('00:00:00 d/m/Y');
                                                                                                echo $today;
                                                                                                ?>"
                                                                                    end_date="<?php
                                                                                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                                                    date_default_timezone_get();
                                                                                    $today = date('23:59:59 d/m/Y');
                                                                                    echo $today;
                                                                                    ?>">
                                            <?php
                                                date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                date_default_timezone_get();
                                                $today = date('Y/m/d');
                                                echo $today;
                                                ?>
                                        </span>
                                        <span class="choose-time-to-filter"  get_time="2" start_date="<?php
                                                                                echo date("00:00:00 d/m/Y", strtotime('monday this week'));
                                                                                ?>"
                                                                            end_date="<?php
                                                                                echo date("23:59:59 d/m/Y", strtotime('sunday this week'))
                                                                                ?>">
                                            <?php
                                                $ddate = date('Y/m/d');
                                                $date = new DateTime($ddate);
                                                $week = $date->format("W");
                                                echo "Week: $week"; 
                                            ?> - 
                                            <?php 
                                                echo "From " ;
                                                echo date("Y/m/d", strtotime('monday this week')), "\n";
                                                echo " to "  ;
                                                echo date("Y/m/d", strtotime('sunday this week')), "\n";
                                            ?>
                                        </span>
                                        <span class="choose-time-to-filter"  get_time="3" start_date="<?php
                                                                                $dt = date('Y/m/d');
                                                                                echo date("00:00:00 01/m/Y", strtotime($dt));
                                                                                ?>"
                                                                            end_date="<?php
                                                                                $dt = date('Y/m/d');
                                                                                echo date("23:59:59 t/m/Y", strtotime($dt))
                                                                                ?>">
                                            <?php
                                                $month = date('m');
                                                echo "Month: $month"; 
                                            ?> - 
                                            <?php 
                                                $dt = date('Y/m/d');
                                                echo 'From: '. date("Y/m/01", strtotime($dt)).' to '. date("Y/m/t", strtotime($dt));
                                            ?>
                                        </span>
                                        <span class="choose-time-to-filter"  get_time="4"  start_date="<?php
                                                                                $dt = date('Y/m/d');
                                                                                echo date("00:00:00 01/01/Y", strtotime($dt));
                                                                                ?>"
                                                                            end_date="<?php
                                                                                $dt = date('Y/m/d');
                                                                                echo date("23:59:59 31/12/Y", strtotime($dt))
                                                                                ?>">
                                            <?php
                                                $year = date('Y');
                                                echo "Year: $year"; 
                                            ?> - 
                                            <?php 
                                                $dt = date('Y/m/d');
                                                echo 'From: '. date("Y/01/01", strtotime($dt)).' to '. date("Y/12/31", strtotime($dt));
                                            ?>
                                        </span>
                                    </div>
                                    <div class="col-md-1 next-date" style="display: flex; justify-content: center; align-items: center; font-size: 25px;">
                                        <i class="fa-solid fa-caret-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div  class="row" style="height: 300px;">
                            <div class="col-md-12" style=" width: 100%; ">
                                <!-- Icon Cards-->
                                <div class="row">
                                    <div class="col-xl-3 col-sm-6 mb-3">
                                        <div class="card text-white bg-primary o-hidden h-100" style="  background-color: rgb(242 140 140 / 54%) !important; border-radius: 20px; overflow: hidden;">
                                            <div class="card-body">
                                                <div class="card-body-icon">
                                                    <i class="fa-solid fa-power-off"></i>
                                                </div>
                                                <div class="mr-5" style="display: flex; flex-direction: column;">
                                                    <span class="result-time" style="color: black; font-size: 50px; font-weight: 600;">0</span>
                                                    <span style="color: #c82e2e; font-size: 20px; font-weight: 800;">Car run time</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 mb-3">
                                        <div class="card text-white bg-primary o-hidden h-100" style="  background-color: rgb(242 140 140 / 54%) !important;  border-radius: 20px; overflow: hidden;">
                                            <div class="card-body">
                                                <div class="card-body-icon">
                                                    <i class="fa-regular fa-circle-play"></i>
                                                </div>
                                                <div class="mr-5" style="display: flex; flex-direction: column;">
                                                    <span class="result-time" style="color: black; font-size: 50px; font-weight: 600;">0h</span>
                                                    <span style="color: #c82e2e; font-size: 20px; font-weight: 800;">Ads Run Time</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 mb-3">
                                        <div class="card text-white bg-primary o-hidden h-100" style="  background-color: rgb(242 140 140 / 54%) !important; border-radius: 20px; overflow: hidden;">
                                            <div class="card-body">
                                                <div class="card-body-icon">
                                                    <i class="fa-regular fa-circle-pause"></i>
                                                </div>
                                                <div class="mr-5" style="display: flex; flex-direction: column;">
                                                    <span class="result-time" style="color: black; font-size: 50px; font-weight: 600;">0h</span>
                                                    <span style="color: #c82e2e; font-size: 20px; font-weight: 800;">Ads Pause Time</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 mb-3">
                                        <div class="card text-white bg-primary o-hidden h-100" style="  background-color: rgb(242 140 140 / 54%) !important; border-radius: 20px; overflow: hidden;">
                                            <div class="card-body">
                                                <div class="card-body-icon">
                                                    <i class="fa-regular fa-circle-stop"></i>
                                                </div>
                                                <div class="mr-5" style="display: flex; flex-direction: column;">
                                                    <span class="result-time" style="color: black; font-size: 50px; font-weight: 600;">0h</span>
                                                    <span style="color: #c82e2e; font-size: 20px; font-weight: 800;">App Stop Time</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
    <script src="{{ asset('backend/js/dashboard/dashboard.js') }}"></script>
    {{-- Css Dasshoard --}}
    <style>
        .list-group-item {
            cursor: pointer;
        }
        .all_pagination {
            display: flex;
            justify-content: center;
        }
        .pagination {
            margin: 0.5rem;
        }
        .rounded-circle {
            object-fit: cover;
        }
        .card_product_admin {
            cursor: pointer;
        }
        .mb-3 {
            margin: 0px !important;
        }

        .btn-lifeSound {
            color: #fff;
            background-color: #822020;
            border-color: #7e1e1e;
        }

        .btn-lifeSound:focus {
            box-shadow: rgba(214, 3, 3, 0.3) 0px 0px 0px 3px;
        }

        .input-lifeSound {
            border-color: #7e1e1e;
            border: 2px solid #7e1e1e;
        }

        .input-lifeSound:focus {
            border-color: #7e1e1e;

            box-shadow: rgba(214, 3, 3, 0.3) 0px 0px 0px 3px;
        }


        .p-4 {
            padding: 5px !important;
        }
        .p-4.active {
            padding: 5px !important;
            background-color: #7e1e1e !important;
        }

        .pb-5, .py-5 {
            padding-bottom: 0rem !important;
            padding-top: 0rem !important;
        }

        .dropdown-search-vehical-num {
            transform: unset !important;
        }

        .choose-time {
            width: 120px;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            transition: 1s;
        }

        .choose-time {
            z-index: 2;
        }

        #action {
            position: absolute;
            top: 0;
            left: 0;
            background-color: #c82e2e;
            width: 120px;
            height: 100%;
            border-radius: 19px;
            z-index: 1;
            transition: 1s;
        }

        
        .dropdown-result-search
        {
            display: none;
            position: absolute;
            margin-top: 40px;
            width: 100%;
            left: 0;
            height: max-content;
            max-height: 200px;
            z-index: 2;
            background: white;
            padding: 4px 8px;
            border-radius: 4px 4px 20px 20px;
            border: 3px solid #c82e2e;
        
        }


        .dropdown-result-search::-webkit-scrollbar
        {   
            width: 6px;
        }
        .dropdown-result-search::-webkit-scrollbar-track {
            /* background-color: rgb(253, 162, 162); */
        }

        .dropdown-result-search::-webkit-scrollbar-thumb {
            background-color: #c82e2e ;
            border-radius: 6px;
        }

        .section-ipt-search 
        {
            height: 40px;
            margin-top: 0px;
            position: relative;
        }

        .btn-outline-none::focus {
            outline: none;
            box-shadow: none;
        }



        .card-body-icon {
            position: absolute;
            font-size: 100px !important;
            z-index: 0;
            top: -25px;
            right: -25px;
            font-size: 5rem;
            -webkit-transform: rotate(15deg);
            -ms-transform: rotate(15deg);
            transform: rotate(15deg);
        }

        .choose-time-to-filter {
            display: none;
        }
        .choose-time-to-filter.active {
            display: block;
        }

        .previous-date, .next-date {
            cursor: pointer;
        }


    </style>
    
@endsection