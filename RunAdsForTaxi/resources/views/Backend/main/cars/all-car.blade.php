@extends('Backend.index')
@section('contentAdmin')
    <style>
        a,a:hover{
            outline:none;
            color:#c82e2e
        }
    </style>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card" style="border: 0px solid black;">
            <div class="card-body">
                <div style="display: flex;justify-content: space-between">
                    <div class="card-title col-sm-9" style="font-size: 30px; font-weight: 900;">The List Taxi</div>

                    <div style="display: flex; justify-content: center; align-items: center;">
                        <button class="button-ads" style="text-transform: uppercase ">
                            Add a taxi
                        </button>
                    </div>
                </div>

                <div style="border-radius: 20px; overflow: hidden;">
                    <table style=" margin-bottom: 0px; " class="table table-bordered">
                        <thead>
                            <tr style="background-color: #c82e2e; color: #fff; border-radius: 20px;">
                                <th style="width: 15%">Vehicle Number</th>
                                <th style="width:20%">Group</th>
                                <th style="width:15%">Tablet</th>
                                <th style="width:20%">Number Phone</th>
                                <th style="width:15%">App ID</th>
                                <th style="width: 15%"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="table-parent-div" style="box-shadow: rgb(17 17 26 / 10%) 0px 1px 0px;">
                    <table style="" class="table table-bordered">
                        <tbody class="scroll-table">
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
                                        <span style="font-size: 20px; color: black; cursor: pointer;">
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
                            <a class="page_navigation" href="/car/all-car?page={{ $page - 1 }}&afficher={{ $afficher }}" style="color: black; text-decoration: none;">
                                <span class="previous_page_navigation" style="font-weight: 700; padding: 0.2rem 0.5rem;  margin: 0.5rem; cursor: pointer;"> <i class="fa-solid fa-angles-left"></i> </span>
                            </a>
                        @endif
                            @for($i = 1; $i <= $total_page; $i++)
                                @if($page == $i) 
                                    <a class="page_navigation" href="/car/all-car?page={{ $i }}&afficher={{ $afficher }}" style="color: black; text-decoration: none; ">
                                        <span style="background:#e37474; font-weight: 700; padding: 0.1rem 0.5rem; border: 3px solid #a80404; margin: 0.5rem; cursor: pointer; border-radius: 20px"> {{ $i }} </span>
                                    </a>
                                @elseif($page == 1 && $i ==1) 
                                    <a class="page_navigation" href="/car/all-car?page={{ $i }}&afficher={{ $afficher }}" style="color: black; text-decoration: none; ">
                                        <span style="font-weight: 700; padding: 0.1rem 0.5rem; border: 3px solid #a80404; margin: 0.5rem; cursor: pointer; border-radius: 20px"> {{ $i }} </span>
                                    </a>    
                                @elseif($page == $total_page  && $i == $total_page) 
                                    <a class="page_navigation" href="/car/all-car?page={{ $i }}&afficher={{ $afficher }}" style="color: black; text-decoration: none; ">
                                        <span style="font-weight: 700; padding: 0.1rem 0.5rem; border: 3px solid #a80404; margin: 0.5rem; cursor: pointer; border-radius: 20px"> {{ $i }} </span>
                                    </a>
                                @elseif($i >= $page-2 && $page != 1 && $i <= $page+2  && $page !=$total_page) 
                                    <a class="page_navigation" href="/car/all-car?page={{ $i }}&afficher={{ $afficher }}" style="color: black; text-decoration: none; ">
                                        <span style="font-weight: 700; padding: 0.1rem 0.5rem; border: 3px solid #a80404; margin: 0.5rem; cursor: pointer; border-radius: 20px"> {{ $i }} </span>
                                    </a>
                                @elseif(($i <= $page+1  && $page ==1) ||($i >= $page-1  && $page == $total_page) ) 
                                    <a class="page_navigation" href="/car/all-car?page={{ $i }}&afficher={{ $afficher }}" style="color: black; text-decoration: none; ">
                                        <span style="font-weight: 700; padding: 0.1rem 0.5rem; border: 3px solid #a80404; margin: 0.5rem; cursor: pointer; border-radius: 20px"> {{ $i }} </span>
                                    </a>
                                @else
                                    <a class="page_navigation" href="/car/all-car?page={{ $i }}&afficher={{ $afficher }}" style="color: black; text-decoration: none; display:none;">
                                        <span style="font-weight: 700; padding: 0.1rem 0.5rem; border: 3px solid #a80404; margin: 0.5rem; cursor: pointer; border-radius: 20px"> {{ $i }} </span>
                                    </a>
                                @endif
                            @endfor
                        @if($page < $total_page)
                            <a class="page_navigation" href="/car/all-car?page={{ $page + 1 }}&afficher={{ $afficher }}" style="color: black; text-decoration: none;">
                                <span class="next_page_navigation" style="font-weight: 700; padding: 0.2rem 0.5rem; margin: 0.5rem; cursor: pointer;"> <i class="fa-solid fa-angles-right"></i> </span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
    <script>
        $('.btn-detail-company').click(function() {
            let dataID = $(this).closest('.row_data_news').children('.get_id_data_company').text();

            window.location.href = "update-company/" + dataID + "";
        })

        $('.btn-delete-company').click(function() {
            let dataID = $(this).closest('.row_data_news').children('.get_id_data_company').text();
            window.location.href = "delete-company/" + dataID + "";
        });


        let chooseAfficher = document.querySelector('.choose-afficher');
        chooseAfficher.addEventListener('change', (e) => {
            let afficher = chooseAfficher.options[chooseAfficher.selectedIndex].getAttribute('afficher');
            let get_page = $('#get_page').val();
            let result_total = $('#result_total').val();

            if(result_total < afficher) {
                window.location.href = "/car/all-car?afficher=" + afficher + "";
            } else {
                window.location.href = "/car/all-car?page=" + get_page + "&afficher=" + afficher + "";
            }
            
        });



    </script>

    


@endsection
