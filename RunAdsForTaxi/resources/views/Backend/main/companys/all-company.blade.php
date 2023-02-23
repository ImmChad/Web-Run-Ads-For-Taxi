@extends('Backend.index')
@section('contentAdmin')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card" style="border: 0px solid black;">
            <div class="card-body">
                <div style="display: flex;justify-content: space-between">
                    <div class="card-title col-sm-9" style="font-size: 30px; font-weight: 900;">The List Groups</div>

                    <div style="display: flex; justify-content: center; align-items: center;">
                        <button class="button-ads" style="text-transform: uppercase">
                            Add a group
                        </button>
                    </div>
                </div>

                <div style="border-radius: 20px; overflow: hidden;">
                    <table style=" margin-bottom: 0px; " class="table table-bordered">
                        <thead>
                            <tr style="background-color: #c82e2e; color: #fff; border-radius: 20px;">
                                <th style="width: 40%">Name of the groups 
                                    <i class="fa-solid fa-up-down"  style="margin: 0rem 0.2rem; color: #fff"></i>
                                    {{-- <i class="fa-solid fa-arrow-down-z-a" style="margin: 0rem 0.2rem; color: #fff"></i> --}}
                                </th>
                                <th style="width: 40%">Parent group</th>
                                <th style="width: 20%"></th>
                            </tr>
                        </thead>
                        <tbody class="scroll-table" style="display: none;">
                            @foreach($listDataCompany as $subListDataCompany) 
                                <tr class="row_data_news">
                                    <td class="get_id_data_company">
                                        @if($subListDataCompany->parent_id == 0)
                                            {{ $subListDataCompany->company_group }}
                                        @else 
                                            <i class="fa-solid fa-arrow-right" style="margin-left: 0.5rem"></i> {{ $subListDataCompany->company_group }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($subListDataCompany->parent_id == 0)
                                            <i class="fa-solid fa-minus"></i>
                                        @else 
                                            {{ $subListDataCompany->parent_group}}
                                        @endif
                                    </td>
                                    
                                    <td>
                                        <span class="btn-update-group" style="cursor: pointer; font-size: 25px; color: #c82e2e;" parent_id="{{ $subListDataCompany->parent_id }}" company_id="{{ $subListDataCompany->company_id }}">
                                            <i class="fa-solid fa-pen-to-square" ></i>
                                        </span>
                                        <span class="btn-delete-group" style="cursor: pointer; font-size: 25px; color: rgb(0, 0, 0);"  parent_id="{{ $subListDataCompany->parent_id }}" company_id="{{ $subListDataCompany->company_id }}">
                                            <i class="fa fa-trash"></i>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="table-parent-div" style="box-shadow: rgb(17 17 26 / 10%) 0px 1px 0px;">
                    <table style="" class="table table-bordered">
                        <tbody class="scroll-table">
                            @foreach($listDataCompany as $subListDataCompany) 
                                <tr class="row_data_news">
                                    <td class="get_id_data_company" style="width: 40%">
                                        @if($subListDataCompany->parent_id == 0)
                                            <span style="font-weight: 700;">{{ $subListDataCompany->company_group }}</span>
                                        @else 
                                            <i class="fa-solid fa-arrow-right" style="margin-left: 0.5rem"></i> {{ $subListDataCompany->company_group }}
                                        @endif
                                    </td>
                                    <td style="width: 40%">
                                        @if($subListDataCompany->parent_id == 0)
                                            <i class="fa-solid fa-minus"></i>
                                        @else 
                                            {{ $subListDataCompany->parent_group}}
                                        @endif
                                    </td>
                                    
    
                                    <td style="width: 20%">
                                        <span class="btn-update-group" style="font-size: 20px; color: red; cursor: pointer;" company_id="{{ $subListDataCompany->company_id }}" parent_id="{{ $subListDataCompany->parent_id }}" company_group="{{ $subListDataCompany->company_group }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </span>
                                        <span class="btn-delete-group" style="font-size: 20px; color: black; cursor: pointer;" company_id="{{ $subListDataCompany->company_id }}" parent_id="{{ $subListDataCompany->parent_id }}" company_group="{{ $subListDataCompany->company_group }}">
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

                            <h5>Showing <span style="color: #c82e2e">{{ count($listDataCompany) }}</span> of <span style="color: #c82e2e">{{ $result_total }}</span> results</h5>
                        @endif
                    </div>
                    <div class="card-title col-sm-4" style="display: flex; justify-content: flex-start; align-items: center; margin-top: 1rem;">
                        <div style="margin-right: 0.5rem; display: flex; align-items: center;"><p style="margin-top: 0px; margin-bottom: 0px; font-weight: 700; font-size: 20px;">Display: </p></div>
                        <select class="choose-afficher" style="border-radius: 20px; border: 3px solid #c82e2e; padding: 0.1rem 0.5rem;">
                            @if($afficher == 10)
                                <option class="option_afficher" afficher="10" selected>10</option>
                                <option class="option_afficher" afficher="20" >20</option>
                                <option class="option_afficher" afficher="30">30</option>
                            @elseif($afficher == 20)
                                <option class="option_afficher" afficher="10">10</option>
                                <option class="option_afficher" afficher="20" selected>20</option>
                                <option class="option_afficher" afficher="30">30</option>
                            @elseif($afficher == 30)
                                <option class="option_afficher" afficher="10">10</option>
                                <option class="option_afficher" afficher="20">20</option>
                                <option class="option_afficher" afficher="30" selected>30</option>
                            @endif
                        </select>
                    </div>

                    <div  class="card-title col-sm-3" style="display: flex; justify-content: center; align-items: center; margin-top: 1rem;">
                        <input type="text" id="get_page" value="{{ $page }}" style="display: none;">
                        @if($page > 1)
                            <a class="page_navigation" href="/company/all-company?page={{ $page - 1 }}&afficher={{ $afficher }}" style="color: black; text-decoration: none;">
                                <span class="previous_page_navigation" style="font-weight: 700; padding: 0.2rem 0.5rem;  margin: 0.5rem; cursor: pointer;"> <i class="fa-solid fa-angles-left"></i> </span>
                            </a>
                        @endif
                            @for($i = 1; $i <= $total_page; $i++)
                                @if($page == $i) 
                                    <a class="page_navigation" href="/company/all-company?page={{ $i }}&afficher={{ $afficher }}" style="color: black; text-decoration: none; ">
                                        <span style="background:#e37474; font-weight: 700; padding: 0.1rem 0.5rem; border: 3px solid #a80404; margin: 0.5rem; cursor: pointer; border-radius: 20px"> {{ $i }} </span>
                                    </a>
                                @elseif($page == 1 && $i == 1) 
                                    <a class="page_navigation" href="/company/all-company?page={{ $i }}&afficher={{ $afficher }}" style="color: black; text-decoration: none; ">
                                        <span style="font-weight: 700; padding: 0.1rem 0.5rem; border: 3px solid #a80404; margin: 0.5rem; cursor: pointer; border-radius: 20px"> {{ $i }} </span>
                                    </a>    
                                @elseif($page == $total_page  && $i == $total_page) 
                                    <a class="page_navigation" href="/company/all-company?page={{ $i }}&afficher={{ $afficher }}" style="color: black; text-decoration: none; ">
                                        <span style="font-weight: 700; padding: 0.1rem 0.5rem; border: 3px solid #a80404; margin: 0.5rem; cursor: pointer; border-radius: 20px"> {{ $i }} </span>
                                    </a>
                                @elseif(($i >= $page-1 && $page != 1) && ($i <= $page+1  && $page != $total_page)) 
                                    <a class="page_navigation" href="/company/all-company?page={{ $i }}&afficher={{ $afficher }}" style="color: black; text-decoration: none; ">
                                        <span style="font-weight: 700; padding: 0.1rem 0.5rem; border: 3px solid #a80404; margin: 0.5rem; cursor: pointer; border-radius: 20px"> {{ $i }} </span>
                                    </a>
                                @elseif(($i <= $page+2  && $page ==1 ) || ($i >= $page-2  && $page == $total_page) ) 
                                    <a class="page_navigation" href="/company/all-company?page={{ $i }}&afficher={{ $afficher }}" style="color: black; text-decoration: none; ">
                                        <span style="font-weight: 700; padding: 0.1rem 0.5rem; border: 3px solid #a80404; margin: 0.5rem; cursor: pointer; border-radius: 20px"> {{ $i }} </span>
                                    </a>
                                @else
                                    <a class="page_navigation" href="/company/all-company?page={{ $i }}&afficher={{ $afficher }}" style="color: black; text-decoration: none; display:none;">
                                        <span style="font-weight: 700; padding: 0.1rem 0.5rem; border: 3px solid #a80404; margin: 0.5rem; cursor: pointer; border-radius: 20px"> {{ $i }} </span>
                                    </a>
                                @endif
                            @endfor
                        @if($page < $total_page)
                            <a class="page_navigation" href="/company/all-company?page={{ $page + 1 }}&afficher={{ $afficher }}" style="color: black; text-decoration: none;">
                                <span class="next_page_navigation" style="font-weight: 700; padding: 0.2rem 0.5rem; margin: 0.5rem; cursor: pointer;"> <i class="fa-solid fa-angles-right"></i> </span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
    <script src="{{ asset('backend/js/company/allCompany.js') }}"></script>


    <script>
        $('.button-ads').click(function() {
            window.location.href = "/company/add-company/";
        })


        let chooseAfficher = document.querySelector('.choose-afficher');
        chooseAfficher.addEventListener('change', (e) => {
            let afficher = chooseAfficher.options[chooseAfficher.selectedIndex].getAttribute('afficher');
            let get_page = $('#get_page').val();
            let result_total = $('#result_total').val();

            if(result_total < afficher) {
                window.location.href = "/company/all-company?afficher=" + afficher + "";
            } else {
                window.location.href = "/company/all-company?page=" + get_page + "&afficher=" + afficher + "";
            }
            
        });
    </script>

    <style>
        .option_afficher:hover, .option_afficher:focus  {
            background-color: rgba(0, 0, 0, 0.997);
        }

        .option_afficher {
            color: black;
            font-weight: 600;
        }

         /* CSS */
        .button-30 {
            border-radius: 20px;
            /* padding: 15px 0; */
            align-items: center;
            border-radius: 20px;
            border: 3px solid #c82e2e;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            /* font-family: "JetBrains Mono",monospace; */
            height: 48px;
            padding-left: 16px;
            padding-right: 16px;
            font-size: 18px;
            color: #c82e2e;
            background-color: #ffb6b6;
        }
        .button-ads:hover {
            color: #c82e2e;
            background-color: #ffb6b6;
        }
        .scroll-add-company::-webkit-scrollbar {
            width: 8px;
        }
        .scroll-add-company::-webkit-scrollbar-track {
            /* background-color: rgb(253, 162, 162); */
        }
        .scroll-add-company::-webkit-scrollbar-thumb {
            background-color: #c82e2e ;
            border-radius: 6px;
        }
    </style>
    


@endsection
