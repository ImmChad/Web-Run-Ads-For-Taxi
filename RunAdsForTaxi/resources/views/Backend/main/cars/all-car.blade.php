@extends('Backend.index')
@section('contentAdmin')
    <style>
        a,a:hover{
            outline:none;
            color:#c82e2e
        }
    </style>
    <style>
        #all-table_length,#all-table_filter,#all-table_info,#all-table_paginate
        {
            display: none!important;
        }
        #all-table
        {
            border-collapse:collapse!important;
            margin-top:0px !important
        }
        .brd{
        background-color:#ccc;
        }
        th:nth-child(1){
        border-radius:20px 0px 0px 20px;
        }
        th:last-child{
        border-radius:0px 20px 20px 0px;
        }
        .form-ipt-field,.ipt-update-field
        {
            font-weight: 600;
        }
        .ipt-update-field
        {
            outline: none;
            border-radius: 20px;
            border: 3px solid #c82e2e;
            padding: 0 20px;
            height: 32px;
        }
        .select-field
        {
            
            cursor: pointer;
            position: relative;
            display: flex;
            justify-content: space-between;
            min-width: 150px !important;
        }
        .btn-drop-select
        {
            color:#c82e2e;
            cursor: pointer;
            margin-left:20px;
        }
        .form-ipt-select
        {
            width: max-content;
            max-width:300px;
        }
        .drop-list-select
        {
            display: none;
            position: absolute;
            width: 100%;
            left: 0;
            top: 100%;
            margin-top: 4px;
            background: white;
            z-index: 1;
            border-radius: 4px 4px 20px 20px;
            border: 1px solid #c82e2e;
            padding: 0px 20px;
            max-height: 250px;
            overflow-y: scroll;
            overflow-x: hidden;
            z-index: 3;
        }

        .drop-list-select::-webkit-scrollbar {
            width: 8px;
        }

        .drop-list-select::-webkit-scrollbar-track {
            /* background-color: rgb(253, 162, 162); */
        }

        .drop-list-select::-webkit-scrollbar-thumb {
            background-color: #c82e2e ;
            border-radius: 6px;
        }
        .item-select-field
        {

            cursor: pointer;
            width: max-content;

        }
        .drop-list-select a, .drop-list-select a:hover {
            text-decoration: none;
            color: black;
        }
        #thead-position
        {
            z-index: 2;
            background: white;
        }
        #tbody-position
        {
            position: relative;
            top: 50px;
        }
        .table-parent-div::-webkit-scrollbar-track-piece:start {
            background: transparent;
            margin-top: 50px;
        }
    </style>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card" style="border: 0px solid black;">
            <div class="card-body">
                <div style="display: flex;justify-content: space-between; align-items:center" >
                    <div class="card-title col-sm-7" style="font-size: 30px; font-weight: 900;">The List Taxi</div>
                        <div class="form-ipt-field form-ipt-select">
                            <div class="ipt-update-field select-field">
                                <div id="ipt_group_id" class="value-select-field" data-value="-1">
                                    @if($filter_company_id > -1)
                                        @foreach($dataAllCompanyMinimum as $itemCompanyMinimum)
                                            @if($itemCompanyMinimum->company_id == $filter_company_id)
                                                {{$itemCompanyMinimum->dataParent->company_group}}-{{$itemCompanyMinimum->company_group}}
                                            @endif
                                        @endforeach
                                    @else
                                        All Company
                                    @endif
                                </div>
                                <div class="btn-drop-select">
                                    <i class="fa-solid fa-caret-down"></i>
                                </div>
                                <div class="drop-list-select">
                                    <a href="{{"/car/all-car?page={$page}&afficher={$afficher}&filter_company_id=-1"}}">
                                        <div class="item-select-field" data-value="-1">
                                            All Company
                                        </div>
                                    </a>
                                    @foreach($dataAllCompanyMinimum as $itemCompanyMinimum)
                                    <a href="{{"/car/all-car?page={$page}&afficher={$afficher}&filter_company_id={$itemCompanyMinimum->company_id}"}}">
                                        <div class="item-select-field" data-value="{{$itemCompanyMinimum->company_id}}">
                                            {{$itemCompanyMinimum->dataParent->company_group}}-{{$itemCompanyMinimum->company_group}}
                                        </div>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    <div style="display: flex; justify-content: center; align-items: center;margin-left:20px">
                        <a href="/car/add-car">
                        <button class="button-ads" style="text-transform: uppercase ">
                            Add a taxi
                        </button>
                        </a>
                    </div>
                </div>

                <div style="border-radius: 20px; overflow: hidden;">
                    <table style=" margin-bottom: 0px; " class="table table-bordered">
                        
                    </table>
                </div>
                <div class="table-parent-div" style="box-shadow: rgb(17 17 26 / 10%) 0px 1px 0px;">
                
                    <table style="" id="all-table" class="table table-bordered">
                        <thead id="thead-position">
                            <tr style="background-color: #c82e2e; color: #fff; border-radius: 20px;">
                                <th style="width: 15%">Vehicle Number</th>
                                <th style="width:20%">Group</th>
                                <th style="width:15%">Tablet</th>
                                <th style="width:20%">Number Phone</th>
                                <th style="width:15%">App ID</th>
                                <th style="width: 15%"></th>
                            </tr>
                        </thead>
                        <tbody id="tbody-position"class="scroll-table" >
                            @foreach($listDataCar as $dataCar) 
                                <tr class="row_data_news">
                                    <td class="get_id_data_company" style="width: 15%">
                                         {{ $dataCar->vehicle_num}}
                                    </td>
                                    <td style="width: 20%">
                                    {{ $dataCar->city }} {{ $dataCar->company_group }}
                                    </td>
                                    <td style="width: 15%">
                                        {{ $dataCar->tablet_id}}
                                    </td>
                                    <td style="width: 20%">
                                        {{ $dataCar->sim_number}}
                                    </td>
                                    <td style="width: 15%">
                                        {{ $dataCar->app_id}}
                                    </td>
                                    <td style="width: 15%">
                                        <span style="font-size: 20px; color: #c82e2e; cursor: pointer;">
                                            <a style="" href="/car/update-car/{{$dataCar->id}}" ><i class="fa-solid fa-pen-to-square"></i></a>
                                        </span>
                                        <span data-id = "{{$dataCar->id}}" class="btn-delete-taxi" style="font-size: 20px; color: black; cursor: pointer;">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


                <div style="display: flex;justify-content: space-between">
                    <div class="card-title col-sm-5" style="display: flex; justify-content: flex-start; align-items: center; margin-top: 1rem;">
                        @if($afficher)
                            <input type="text" id="result_total" value="{{ $result_total }}" style="display: none;">
                            <h5>Showing <span style="color: #c82e2e">{{ count($listDataCar) }}</span> of <span style="color: #c82e2e">{{ $result_total }}</span> results</h5>
                        @endif
                    </div>
                    <div class="card-title col-sm-4" style="display: flex; justify-content: flex-start; align-items: center; margin-top: 1rem;">
                        <div style="margin-right: 0.5rem; display: flex; align-items: center;"><p style="margin-top: 0px; margin-bottom: 0px; font-weight: 700; font-size: 20px;">Afficher: </p></div>
                        <select class="choose-afficher" style="border-radius: 20px; border: 3px solid #c82e2e; padding: 0.1rem 0.5rem;">
                            @if($afficher == 10)
                                <option afficher="10" selected>10</option>
                                <option afficher="20" >20</option>
                                <option afficher="30">30</option>
                            @elseif($afficher == 20)
                                <option afficher="10">10</option>
                                <option afficher="20" selected>20</option>
                                <option afficher="30">30</option>
                            @elseif($afficher == 30)
                                <option afficher="10">10</option>
                                <option afficher="20">20</option>
                                <option afficher="30" selected>30</option>
                            @endif
                        </select>
                    </div>
                    <div  class="card-title col-sm-3" style="display: flex; justify-content: center; align-items: center; margin-top: 1rem;">
                        <input type="text" id="get_page" value="{{ $page }}" style="display: none;">
                        @if($page > 1)
                            <a class="page_navigation" href="/car/all-car?page={{ $page - 1 }}&afficher={{ $afficher }}&filter_company_id={{$filter_company_id}}" style="color: black; text-decoration: none;">
                                <span class="previous_page_navigation" style="font-weight: 700; padding: 0.2rem 0.5rem;  margin: 0.5rem; cursor: pointer;"> <i class="fa-solid fa-angles-left"></i> </span>
                            </a>
                        @endif
                            @for($i = 1; $i <= $total_page; $i++)
                                @if($page == $i) 
                                    <a class="page_navigation" href="{{"/car/all-car?page={$i}&afficher={$afficher}&filter_company_id={$filter_company_id}"}}" style="color: black; text-decoration: none; ">
                                        <span style="background:#e37474; font-weight: 700; padding: 0.1rem 0.5rem; border: 3px solid #a80404; margin: 0.5rem; cursor: pointer; border-radius: 20px"> {{ $i }} </span>
                                    </a>
                                @elseif($page == 1 && $i ==1) 
                                    <a class="page_navigation" href="{{"/car/all-car?page={$i}&afficher={$afficher}&filter_company_id={$filter_company_id}"}}" style="color: black; text-decoration: none; ">
                                        <span style="font-weight: 700; padding: 0.1rem 0.5rem; border: 3px solid #a80404; margin: 0.5rem; cursor: pointer; border-radius: 20px"> {{ $i }} </span>
                                    </a>    
                                @elseif($page == $total_page  && $i == $total_page) 
                                    <a class="page_navigation" href="{{"/car/all-car?page={$i}&afficher={$afficher}&filter_company_id={$filter_company_id}"}}" style="color: black; text-decoration: none; ">
                                        <span style="font-weight: 700; padding: 0.1rem 0.5rem; border: 3px solid #a80404; margin: 0.5rem; cursor: pointer; border-radius: 20px"> {{ $i }} </span>
                                    </a>
                                @elseif($i >= $page-2 && $page != 1 && $i <= $page+2  && $page !=$total_page) 
                                    <a class="page_navigation" href="{{"/car/all-car?page={$i}&afficher={$afficher}&filter_company_id={$filter_company_id}"}}" style="color: black; text-decoration: none; ">
                                        <span style="font-weight: 700; padding: 0.1rem 0.5rem; border: 3px solid #a80404; margin: 0.5rem; cursor: pointer; border-radius: 20px"> {{ $i }} </span>
                                    </a>
                                @elseif(($i <= $page+1  && $page ==1) ||($i >= $page-1  && $page == $total_page) ) 
                                    <a class="page_navigation" href="{{"/car/all-car?page={$i}&afficher={$afficher}&filter_company_id={$filter_company_id}"}}" style="color: black; text-decoration: none; ">
                                        <span style="font-weight: 700; padding: 0.1rem 0.5rem; border: 3px solid #a80404; margin: 0.5rem; cursor: pointer; border-radius: 20px"> {{ $i }} </span>
                                    </a>
                                @else
                                    <a class="page_navigation" href="{{"/car/all-car?page={$i}&afficher={$afficher}&filter_company_id={$filter_company_id}"}}" style="color: black; text-decoration: none; display:none;">
                                        <span style="font-weight: 700; padding: 0.1rem 0.5rem; border: 3px solid #a80404; margin: 0.5rem; cursor: pointer; border-radius: 20px"> {{ $i }} </span>
                                    </a>
                                @endif
                            @endfor
                        @if($page < $total_page)
                            <a class="page_navigation" href="/car/all-car?page={{ $page + 1 }}&afficher={{ $afficher }}&filter_company_id={{$filter_company_id}}" style="color: black; text-decoration: none;">
                                <span class="next_page_navigation" style="font-weight: 700; padding: 0.2rem 0.5rem; margin: 0.5rem; cursor: pointer;"> <i class="fa-solid fa-angles-right"></i> </span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
    <script src="{{ asset('backend/js/taxi/managerTaxi.js') }}"></script>
    <script>
        let chooseAfficher = document.querySelector('.choose-afficher');
        chooseAfficher.addEventListener('change', (e) => {
            let afficher = chooseAfficher.options[chooseAfficher.selectedIndex].getAttribute('afficher');
            let get_page = $('#get_page').val();
            let result_total = $('#result_total').val();

            if(result_total < afficher) {
                window.location.href = "/car/all-car?afficher=" + afficher + "&filter_company_id={{$filter_company_id}}";
            } else {
                window.location.href = "/car/all-car?page=" + get_page + "&afficher=" + afficher + "&filter_company_id={{$filter_company_id}}";
            }
            
        });
        window.addEventListener('load',()=>{
            document.querySelector('#thead-position').style.position='absolute'
        })


    </script>

    


@endsection
