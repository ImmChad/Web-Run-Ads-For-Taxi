@extends('Backend.index')
@section('contentAdmin')
    <style>
        
        .section-update-taxi
        {
            width: 95%;
            height: 85%;
            padding: 10px 0px;
            
        }
        .header-update-taxi {
            display: flex;
            height: 20%;
            align-items: center;
            margin: 0px 40px;
            position: relative;
            margin-top: -10px;
        }
        .body-update-taxi
        {
            height: 85%;
            box-shadow: 1px 1px 8px 1px grey;
            min-width: 100%;
            border-radius: 12px;
        }
        .btn-update-taxi
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
        .name-taxi
        {
            color: black;
            font-weight: bold;
            font-size: 40px;
            margin-left: 20px;
            
        }
        .btn-navigate-main-taxi *,.btn-navigate-main-taxi *:hover
        {
            font-weight: bold;
            cursor: pointer;
            text-decoration: none; 
            color: #c82e2e!important;
        }
        .form-update-taxi {
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
            height: 100px;
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
        }
        .ipt-update-field
        {
            outline: none;
            border-radius: 20px;
            border: 2px solid #c82e2e;
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



        .item-select-update-field
        {

            cursor: pointer;
            width: max-content;

        }
    </style>
    <div class="section-update-taxi">
        {{-- <div class="row header-update-taxi">
            <div class="btn-navigate-main-taxi">
                <i class="fa-solid fa-circle-left"></i>
                <a href="/car/all-car">BACK</a>
            </div>
            <div class="name-taxi">
                Taxi {{$dataCar->vehicle_num}}
            </div>
            <div class="btn-update-taxi ">
                UPDATE
            </div>
        </div> --}}
        <div class="card-title" style="display: flex;justify-content: space-between">
            <div class=" col-sm-2" style="font-size: 18px;  font-weight: 900; display: flex; justify-content: center; align-items: center; ">
                <div class="btn-navigate-main-taxi">
                    <i class="fa-solid fa-circle-left"></i>
                    <a >BACK</a>
                </div>
            </div>
            <div class=" col-sm-7" style="font-size: 30px; font-weight: 900;">
                Taxi {{$dataCar->vehicle_num}}
            </div>
            <div class="col-sm-5">
                <div class="btn-update-taxi ">
                    UPDATE
                </div>
            </div>
        </div>
        <div class="body-update-taxi ">
            <div class="form-update-taxi">
                <div class="section-info-base">
                    <div class="part-input">
                        <div class="label-ipt-field label-ipt-media">
                            Vehicle Number    
                        </div>
                        <div class="form-ipt-field form-ipt-text">
                            <input class="ipt-update-field ipt-url-img" value="{{$dataCar->vehicle_num}}" type="text">
                        </div>
                    </div>
                    <div class="part-input">
                        <div class="label-ipt-field label-ipt-media">
                            Group     
                        </div>
                        <div class="form-ipt-field form-ipt-select">
                        <div class="ipt-update-field select-update-field">
                                    <div class="value-select-update-field" data-value="{{$dataCar->company_id}}">
                                    {{$dataCar->dataGroupCompany->dataParent->company_group}}-{{$dataCar->dataGroupCompany->company_group}}
                                    </div>
                                    <div class="btn-drop-select">
                                        <i class="fa-solid fa-caret-down"></i>
                                    </div>
                                    <div class="drop-list-select">
                                        @foreach($dataAllCompanyMinimum as $itemCompanyMinimum)
                                        <div class="item-select-update-field" data-value="{{$itemCompanyMinimum->company_id}}">
                                        {{$itemCompanyMinimum->dataParent->company_group}}-{{$itemCompanyMinimum->company_group}}
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                        </div>
                        </div>
                        <div class="part-input">
                        <div class="label-ipt-field label-ipt-media">
                            Tablet   
                        </div>
                        <div class="form-ipt-field form-ipt-text">
                            <input class="ipt-update-field ipt-url-img" value="{{$dataCar->tablet_id}}"type="text">
                        </div>
                        </div>
                        <div class="part-input">
                        <div class="label-ipt-field label-ipt-media">
                            Number Phone   
                        </div>
                        <div class="form-ipt-field form-ipt-text">
                            <input class="ipt-update-field ipt-url-img" value="{{$dataCar->sim_number}}"type="text">
                        </div>
                        </div>
                        <div class="part-input">
                        <div class="label-ipt-field label-ipt-media">
                            App ID    
                        </div>
                        <div class="form-ipt-field form-ipt-text">
                            <input class="ipt-update-field ipt-url-img" value="{{$dataCar->app_id}}"type="text">
                        </div>
                    </div>
                </div>
                <div class="section-info-media">
                    <div class="form-update-video">
                        <video class ="preview-video"src="https://drive.google.com/uc?export=view&id=1ncjsdmFYV9WKawcEfYAYvce4rf8lsgL_" controls muted></video>
                    <div class="right-form-update-media">
                        <div class="part-input">
                                <div class="label-ipt-field label-ipt-media">Update Video</div>
                                <div class="form-ipt-field form-ipt-media">
                                    <input class="ipt-update-field ipt-url-video" type="text">
                                    <div class="btn-apply-media">Apply</div>
                                </div>
                        </div>
                        
                        <div class="part-input">
                                <div class="label-ipt-field label-ipt-media">Select Time Rest</div>
                                <div class="form-ipt-field form-ipt-media">
                                    <div class="ipt-update-field select-update-field">
                                        <div class="value-select-update-field" data-value="15">
                                            15 minutes
                                        </div>
                                        <div class="btn-drop-select">
                                            <i class="fa-solid fa-caret-down"></i>
                                        </div>
                                        <div class="drop-list-select">
                                            <div class="item-select-update-field" data-value="15">15 minutes</div>
                                            <div class="item-select-update-field" data-value="10">10 minutes</div>
                                            <div class="item-select-update-field" data-value="5">5 minutes</div>
                                            <div class="item-select-update-field" data-value="3">3 minutes</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-update-image">
                        <img class="preview-img" src="https://i.ytimg.com/vi/kC4Sj8NIq-g/maxresdefault.jpg" alt="" srcset="">
                            <div class="right-form-update-media">
                                <div class="part-input">
                                    <div class="label-ipt-field label-ipt-media">Update Photo     
                                    </div>
                                    <div class="form-ipt-field form-ipt-media">
                                        <input class="ipt-update-field ipt-url-img" type="text">
                                        <div class="btn-apply-media">Apply</div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
    <script>

        $('.btn-navigate-main-taxi').click(function() {
            window.location.href = "/car/all-car";
        });
        
        $('.btn_update_car').click(function() {
        
            let listCompany = document.querySelector('.list-company');
            let listDriver = document.querySelector('.list-driver');

            let id_car = $('#id_car').val();
            let id_company = listCompany.options[listCompany.selectedIndex].getAttribute('id_company');
            let id_ud = listDriver.options[listDriver.selectedIndex].getAttribute('id_ud');
            let vehical_num = $('#vehical_num').val();
            

            if(vehical_num == '' || id_company == 0) {
                displayToast('Enter fully, Please !');
            } else {

                var form  = new FormData();
                form.append('id_car', id_car);
                form.append('vehical_num', vehical_num);
                form.append('id_company', id_company);
                form.append('id_ud', id_ud);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{URL::to("/car/update-new-car")}}',
                    method: 'post',
                    data: form,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        window.location.href = '{{URL::to("car/all-car")}}';
                    },
                    error: function(data) {
                        displayToast(data.responseText);
                        console.log(data.responseText);
                    }
                });
            }

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


@endsection
