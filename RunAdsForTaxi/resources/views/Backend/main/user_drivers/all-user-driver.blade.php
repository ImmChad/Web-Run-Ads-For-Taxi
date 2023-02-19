@extends('Backend.index')
@section('contentAdmin')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card" >
            <div class="card-body">
                <div style="display: flex;justify-content: space-between">
                    <div class="card-title col-sm-9" style="font-size: 30px; font-weight: 900;  text-shadow: 0px 3px 0px #b2a98f,
                    0px 14px 10px rgba(0,0,0,0.15),
                    0px 24px 2px rgba(0,0,0,0.1),
                    0px 34px 30px rgba(0,0,0,0.1);">The Table List Drivers</div>
                </div>

                <table style="margin-top:20px; border: 1px solid black;" class="table table-bordered">
                    <thead>
                        <tr style="background-color: #a80404; color: #fff;">
                            <th>#ID</th>
                            <th>The Driver's Name</th>
                            <th>Tel</th>
                            <th>Age</th>
                            <th>Avatar</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listDataDriver as $subListDataDriver) 
                            <tr class="row_data_news">
                                <td class="get_id_data_driver">{{ $subListDataDriver->id_ud }}</td>
                                <td>{{ $subListDataDriver->name_ud }}</td>
                                <td>{{ $subListDataDriver->num_phone_ud }}</td>
                                
                                <td> {{ $subListDataDriver->age }}</td>
                                <td>
                                    <img style="object-fit: cover; border-radius: 0px" width="70px" height="70px"
                                        src="{{ URL::to($subListDataDriver->url_avt_ud) }}"
                                        alt="">
                                </td>

                                <td>
                                    <button type="button" class="btn btn btn-outline-success btn-detail-driver">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-delete-driver">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
                <div class="row" >
                    <div class="col" style="display: flex; justify-content: center; align-items: center;">
                        <input type="text" id="current_page" value="{{ $page }}" style="display: none;">
                        
                        @if($page > 1)
                            <a class="page_navigation" href="/driver/all-driver?page={{ $page - 1 }}" style="color: black; text-decoration: none;">
                                <span class="previous_page_navigation" style="font-weight: 700; padding: 0.2rem 0.5rem; border: 3px solid #a80404; margin: 0.5rem; cursor: pointer;"> <i class="fa-solid fa-angles-left"></i> </span>
                            </a>
                        @endif
                            @for($i = 1; $i <= $total_page; $i++)
                                @if($page > 2 && $i >= ($page - 1) && $i <= ($page + 1)) 
                                    <a class="page_navigation" href="/driver/all-driver?page={{ $i }}" style="color: black; text-decoration: none; ">
                                        <span style="font-weight: 700; padding: 0.2rem 0.5rem; border: 3px solid #a80404; margin: 0.5rem; cursor: pointer;"> {{ $i }} </span>
                                    </a>
                                @elseif($page == 1 && $i < 3)
                                    <a class="page_navigation" href="/driver/all-driver?page={{ $i }}" style="color: black; text-decoration: none; ">
                                        <span style="font-weight: 700; padding: 0.2rem 0.5rem; border: 3px solid #a80404; margin: 0.5rem; cursor: pointer;"> {{ $i }} </span>
                                    </a>
                                @else 
                                    <a class="page_navigation" href="/driver/all-driver?page={{ $i }}" style="color: black; text-decoration: none;">
                                        <span style="font-weight: 700; padding: 0.2rem 0.5rem; border: 3px solid #a80404; margin: 0.5rem; cursor: pointer;"> {{ $i }} </span>
                                    </a>
                                @endif
                            @endfor
                        @if($page < $total_page)
                            <a class="page_navigation" href="/driver/all-driver?page={{ $page + 1 }}" style="color: black; text-decoration: none;">
                                <span class="next_page_navigation" style="font-weight: 700; padding: 0.2rem 0.5rem; border: 3px solid #a80404; margin: 0.5rem; cursor: pointer;"> <i class="fa-solid fa-angles-right"></i> </span>
                            </a>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
    <script>
        $('.btn-detail-driver').click(function() {
            let dataID = $(this).closest('.row_data_news').children('.get_id_data_driver').text();

            window.location.href = "update-driver/" + dataID + "";
        })

        $('.btn-delete-driver').click(function() {
            let dataID = $(this).closest('.row_data_news').children('.get_id_data_driver').text();
            window.location.href = "delete-driver/" + dataID + "";
        });
    </script>

    


@endsection
