@extends('Backend.index')
@section('contentAdmin')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card" style="border: 4px solid #c82e2e; border-radius: 20px;">
            <div class="card-body">
                <div style="display: flex;justify-content: space-between">
                    <div style="display: flex;justify-content: space-between; width: 100%">
                        <div class="card-title col-sm-7" style="font-size: 30px; font-weight: 900;">All images</div>
                        <div class="col-sm-5" style="display: flex; justify-content: flex-end;">
                            <button class="button-ads btn-navigation-video" style="margin-right: 0.5rem;">All video</button>
                            <button class="button-ads btn-back">Back</button>
                        </div>
                    </div>
                </div>
                
                <div  class="row" style="margin-top:20px; height: 500px;">
                    <div class="col-md-4" style=" height: 500px;  display: flex; justify-content: flex-start; align-items: flex-start; flex-direction: column;">
                        <div class="form-group row" style="width: 100%">
                            <div class="form-group col-md-12">
                                <h4 style="font-size: 20px; font-weight: 900;">Image name: </h4>
                                <input type="text" class="input-ads" id="photo_name" style="height: 40px;" placeholder="Enter photo name ..." >
                            </div>
                        </div>
                        <div class="form-group row" style="width: 100%">
                            <div class="form-group col-md-12">
                                <h4 style="font-size: 20px; font-weight: 900;">Image description: </h4>
                                <textarea class="input-ads scroll-text-area" id="photo_description" style="height: 70px; resize: none;" ></textarea>
                            </div>
                        </div>
                        <div class="form-group row" style="width: 100%">
                            <div class="form-group col-md-12">
                                <h4 style="font-size: 20px; font-weight: 900;">Add image: </h4>
                                <div class="input-ads" style="display: flex;justify-content: space-between; padding-right: 0px; height: 40px;">
                                    <input type="text" class="text-name-group" style=" width: 100%; color: #c82e2e; font-weight: 700; border: none; background: transparent; outline: none;"  type="text" id="photo_path" placeholder="Enter link image ..." autocomplete="off" disabled>
                                    <input id="news_image" type="file" name="news_image" accept="image/*" class="file-upload-default" style="display: none;">
                                    <button class="btn-name-group btn-upload-image" style=" width: 150px; font-size: 15px; font-weight: 700; border: 3px solid #c82e2e; background: #c82e2e; outline: none; border-radius: 17px; color: white; cursor: pointer;">
                                        Upload
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" style="width: 100%">
                            <div class="form-group col-md-12">
                                <button class="btn-name-group btn-add-image" style=" width: 100%; height: 40px; font-size: 15px; font-weight: 700; border: 3px solid #c82e2e; background: #c82e2e; outline: none; border-radius: 17px; color: white; cursor: pointer;">
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 nice-scroll-right" style=" height: 500px; overflow-y: hidden;">
                        <div class="table-parent-div" style="box-shadow: rgb(17 17 26 / 10%) 0px 1px 0px; width: 100%; height: 100%;">
                            <table style="width: 100%;  margin-bottom: 0px;" class="table table-bordered">
                                <thead style="background-color: #c82e2e; color: #fff; ">
                                    <tr>
                                        <th>
                                            Image name
                                        </th>
                                        <th>
                                            Created at
                                        </th>
                                        <th>
                                            Image path
                                        </th>
                                        <th>

                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="scroll-table">
                                    @foreach($dataPhoto as $subDataPhoto) 
                                        <tr class="row_data_news">
                                            <td class="get_id_data_company">
                                                {{ $subDataPhoto->photo_name }}
                                            </td>
                                            <td>
                                                {{ $subDataPhoto->created_at }}
                                            </td>
                                            <td>
                                                ...{{ substr($subDataPhoto->photo_path, -20)  }}
                                            </td>
                                            <td >
                                                <span class="btn-coppy" style="font-size: 20px; color: red; cursor: pointer;" photo_path="{{ $subDataPhoto->photo_path }}">
                                                    <i class="fa-solid fa-copy"></i>
                                                </span>
                                                <span class="btn-delete-photo" style="font-size: 20px; color: rgb(0, 0, 0); cursor: pointer;" photo_id="{{ $subDataPhoto->id }}">
                                                    <i class="fa-solid fa-trash"></i>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
    <script src='{{ asset('backend/js/video/allImage.js') }}'></script>



    <script>
        $('.btn-back').click(function() {
            window.location.href = "/video/add-video";
        });

        $('.btn-navigation-video').click(function() {
            window.location.href = "/video/all-video";
        });


        

    </script>

    

    <style>
        /* CSS */
        .button-30 {
            align-items: center;
            appearance: none;
            background-color: #FCFCFD;
            border-radius: 4px;
            border-width: 0;
            box-shadow: rgba(45, 35, 66, 0.4) 0 2px 4px,rgba(45, 35, 66, 0.3) 0 7px 13px -3px,#D6D6E7 0 -3px 0 inset;
            box-sizing: border-box;
            color: #36395A;
            cursor: pointer;
            display: inline-flex;
            font-family: "JetBrains Mono",monospace;
            height: 48px;
            justify-content: center;
            line-height: 1;
            list-style: none;
            overflow: hidden;
            padding-left: 16px;
            padding-right: 16px;
            position: relative;
            text-align: left;
            text-decoration: none;
            transition: box-shadow .15s,transform .15s;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            white-space: nowrap;
            will-change: box-shadow,transform;
            font-size: 18px;
        }

        .button-30:focus {
            box-shadow: #D6D6E7 0 0 0 1.5px inset, rgba(45, 35, 66, 0.4) 0 2px 4px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
        }

        .button-30:hover {
            box-shadow: rgba(45, 35, 66, 0.4) 0 4px 8px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
            transform: translateY(-2px);
        }

        .button-30:active {
            box-shadow: #D6D6E7 0 3px 7px inset;
            transform: translateY(2px);
        }


        .row_data_news {
            cursor: pointer;
        }

        .row_data_news.active {
            background-color: #7b0000c7;
        }
        .row_data_news.active h4, .row_data_news.active i, .row_data_news.active span {
            color: #fff !important;
        }
        .row_data_news.active input, .row_data_news.active span {
            border: 3px solid #ffffff !important;
        }

        .name_company_display {
            display: none;
        }
        .name_company_display.active {
            display: block;
        }


        .scroll-text-area::-webkit-scrollbar {
            display: none;
        }

        .table-bordered thead tr th:nth-child(1) {
            border-radius: 20px 0px 0px 20px;
        }
        .table-bordered thead tr th:last-child {
            border-radius: 0px 20px 20px 0px;
        }
        
        .table-parent-div::-webkit-scrollbar-track-piece:start {
            margin-top: 50px;
        }


    </style>


@endsection
