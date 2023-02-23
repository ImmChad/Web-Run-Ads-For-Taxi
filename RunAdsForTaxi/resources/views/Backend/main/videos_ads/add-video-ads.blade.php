@extends('Backend.index')
@section('contentAdmin')


    <div class="section-update-video">
        {{-- <div class="row header-update-video">
            <div class="btn-navigate-main-video">
                <i class="fa-solid fa-circle-left"></i>
                <a href="/car/all-car">BACK</a>
            </div>
            <div class="name-video">
                video {{$dataCar->vehicle_num}}
            </div>
            <div class="btn-update-video ">
                UPDATE
            </div>
        </div> --}}
        <div class="card-title" style="display: flex;justify-content: space-between">
            <div class=" col-sm-7" style="font-size: 30px; font-weight: 900;">
                Video management
            </div>
            <div class="col-sm-5" style="display: flex; justify-content: flex-end;">
                <button class="button-ads btn-all-media" style="margin-right: 0.5rem;">
                    All Media
                </button>
                <button class="button-ads btn-update-ads">
                    UPDATE
                </button>
            </div>
        </div>
        <div class="body-update-video ">
            <div class="form-update-all">
                <div class="section-info-base">
                    <div class="row" style="font-size: 22px; font-weight: 900; margin-bottom: 0.5rem;">
                        Choose a group of taxi:
                    </div>
                    <div class="row" style="height: 350px; width: 250px; justify-content: center;">
                        <div class="col-md-12" style="width: 100%; height: 100%; border: 5px solid #c82e2e; border-radius: 20px; padding: 0px !important; overflow: hidden;">
                            <div class="scroll-div-all-group" style="display: flex; width: 100%; height: 100%; flex-direction: column; justify-content: flex-start; align-items: flex-start;   font-size: 20px; overflow-y: scroll;">
                                <span class="choose-group-company active" style="width: 100%; font-weight: 700; color: #c82e2e; cursor: pointer;" company_id="0">&nbsp;All</span>
                                @foreach($dataCompany as $subListDataCompany) 
                                    @if($subListDataCompany->parent_id == 0)
                                        <span class="choose-group-company" style="width: 100%; font-weight: 700; color: #c82e2e; cursor: pointer;" company_id="{{ $subListDataCompany->company_id }}">&nbsp;{{ $subListDataCompany->company_group }}</span>
                                    @else 
                                        <span class="choose-group-company" style="width: 100%; font-weight: 450; color: #c82e2e; cursor: pointer;" company_id="{{ $subListDataCompany->company_id }}">&nbsp;&nbsp; {{ $subListDataCompany->company_group }}</span>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section-info-media">
                    <div class="form-update-video">
                        {{-- <video class ="preview-video"src="https://drive.google.com/uc?export=view&id=1ncjsdmFYV9WKawcEfYAYvce4rf8lsgL_" controls muted></video> --}}
                        <video class ="preview-video" src="#" controls muted></video>

                        <div class="right-form-update-media">
                            <div class="part-input">
                                <div class="label-ipt-field label-ipt-media">Update Video</div>
                                <div class="form-ipt-field form-ipt-media" >
                                    <input class="ipt-update-field ipt-url-video" id="video_path" type="text" placeholder="Enter link video ..." disabled>
                                    <div class="btn-apply-media btn-browse-video">Browse</div>

                                </div>
                            </div>
                            
                            <div class="part-input">
                                <div class="label-ipt-field label-ipt-media">Select Time Rest</div>
                                <div class="form-ipt-field form-ipt-media">
                                    <div class="ipt-update-field select-update-field">
                                        <div class="value-select-update-field" data-value="15" style="display: flex; justify-content: center; align-items: center;">
                                            15 minutes
                                        </div>
                                        <div class="btn-drop-select" style="display: flex; justify-content: center; align-items: center;">
                                            <i class="fa-solid fa-caret-down"></i>
                                        </div>
                                        <div class="drop-list-select">
                                            <div class="item-select-update-field" data-value="15">15 minutes</div>
                                            <div class="item-select-update-field" data-value="10">10 minutes</div>
                                            <div class="item-select-update-field" data-value="5">5 minutes</div>
                                            <div class="item-select-update-field" data-value="3">3 minutes</div>
                                            <div class="item-select-update-field" data-value="1">1 minutes</div>
                                        </div>
                                    </div>

                                    <div class="btn-apply-media btn-choose-video">Choose Video</div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-update-image">
                        {{-- <img class="preview-img" src="https://i.ytimg.com/vi/kC4Sj8NIq-g/maxresdefault.jpg" alt="" srcset=""> --}}
                        <img class="preview-img" src="#" alt="" srcset="">
                            <div class="right-form-update-media" style="    display: flex;
                                flex-direction: column;
                                align-items: flex-end;">
                                <div class="part-input">
                                    <div class="label-ipt-field label-ipt-media">Update Photo     
                                    </div>
                                    <div class="form-ipt-field form-ipt-media">
                                        <input class="ipt-update-field ipt-url-img" id="photo_path" type="text" placeholder="Enter link image ..." disabled>
                                        <div class="btn-apply-media btn-browse-image">Browse</div>
                                    </div>
                                </div>
                                <div class="button-ads  btn-choose-image" style="height: 35px; font-size: 15px;">Choose photo</div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>

    <script src="{{ asset('backend/js/video/addVideoAds.js') }}"></script>

    <script>
        
        $('.btn-all-media').click(function() {
            window.location.href = "/video/all-video";
        });
        

    </script>

    <style>
        #news_image {
            display: none;
        }
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


    </style>

    <style>
            
        .section-update-video
        {
            width: 95%;
            height: 85%;
            padding: 10px 0px;
            
        }
        .header-update-video {
            display: flex;
            height: 20%;
            align-items: center;
            margin: 0px 40px;
            position: relative;
            margin-top: -10px;
        }
        .body-update-video
        {
            height: 85%;
            box-shadow: 1px 1px 8px 1px grey;
            min-width: 100%;
            border-radius: 12px;
        }
        .btn-update-video
        {
            background: #c82e2e;
            color: white;
            font-weight: bold;
            border-radius: 20px;
            width: max-content;
            position: absolute;
            right: 0;
            padding: 5px 20px;
            font-size: 20px;
            cursor: pointer;
        }
        .name-video
        {
            color: black;
            font-weight: bold;
            font-size: 40px;
            margin-left: 20px;
            
        }
        .btn-navigate-main-video *,.btn-navigate-main-video *:hover
        {
            font-weight: bold;
            cursor: pointer;
            text-decoration: none; 
            color: #c82e2e!important;
        }
        .form-update-all {
            display: flex;
            justify-content: space-between;
            height: 100%;
            padding: 40px;
        }
        
        .form-ipt-field,.ipt-update-field
        {
            font-weight: 600;
        }
        .section-info-base
        {
            width: 30%;
            height: 100%;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
        }
        .section-info-media
        {
            width: 70%;
            min-height: 70%;
        }
        .preview-img,.preview-video
        {
            width: 270px;
            height: 165px;
            background: black;
            border-radius: 20px;
        }

        .preview-img {
            object-fit: cover;
        }

        .form-update-image,.form-update-video
        {
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            margin-top: 20px;
        }
        .right-form-update-media
        {
        }
        .part-input
        {
            margin-bottom: 10px;
        }
        .label-ipt-media {
            font-weight: bold;
            font-size: 24px;
            margin-bottom: 5px;
        }
        .form-ipt-media
        {
            display:flex;
            position: relative;
            height: 35px;
        }
        .btn-apply-media
        {
            background: #c82e2e;
            color: white;
            font-weight: bold;
            border-radius: 20px;
            width: max-content;
            padding: 1px 20px;
            vertical-align: middle;
            position: absolute;
            height: 100%;
            right: 0;
            cursor:pointer;
            display: flex;
            align-items: center;
        }
        .ipt-update-field
        {
            outline: none;
            border-radius: 20px;
            border: 3px solid #c82e2e;
            padding: 0 20px;
        }
        .form-ipt-media .ipt-update-field
        {
            min-width: 400px;
        }
        .form-ipt-text .ipt-update-field
        {
            min-width: 300px;
        }
        .select-update-field
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
        }

        .drop-list-select::-webkit-scrollbar
        {   
            width: 6px;
        }
        .drop-list-select::-webkit-scrollbar-track {
            /* background-color: rgb(253, 162, 162); */
        }

        .drop-list-select::-webkit-scrollbar-thumb {
            background-color: #c82e2e ;
            border-radius: 6px;
        }


        .item-select-update-field
        {

            cursor: pointer;
            width: max-content;

        }


        .scroll-div-all-group::-webkit-scrollbar {
            display: none;
        }

        .choose-group-company.active {
            background-color: #c82e2e;
            color: #fff !important;
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

        .row_data_news {
            cursor: pointer;
        }


    </style>

@endsection
