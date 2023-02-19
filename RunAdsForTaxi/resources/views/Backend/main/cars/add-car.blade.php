@extends('Backend.index')
@section('contentAdmin')
    <div class="page-header">
        <h3 class="page-title" style="color: #a80404; font-weight: 700; margin-left: 1rem">
            Manage Car
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="fa-solid fa-car" style="color: #a80404;"></i>
            </span> 
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="mdi mdi-timetable"></i>
                    <span><?php
                    $today = date('d/m/Y');
                    echo $today;
                    ?></span>
                </li>
            </ul>
        </nav>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card" style="border: 2px solid black;">
            <div class="card-body">
                <div style="display: flex;justify-content: space-between">
                    <div class="card-title col-sm-9" style="font-size: 30px; font-weight: 900;  text-shadow: 0px 3px 0px #b2a98f,
                    0px 14px 10px rgba(0,0,0,0.15),
                    0px 24px 2px rgba(0,0,0,0.1),
                    0px 34px 30px rgba(0,0,0,0.1);">Add Car</div>
                </div>

                <div class="row">
                    <div class="col">
                        <form>
                            <div class="form-group row">
                                <div class="form-group col-md-5">
                                    <button class="button-30" role="button" disabled>Vehicle Num</button>
                                </div>
                                <div class="form-group col-md-7">
                                    <input type="text" class="form-control input-lifeSound" id="vehical_num" placeholder="Enter Vehical Num ...">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-5">
                                    <button class="button-30" role="button" disabled>Choose Company</button>
                                </div>
                                <div class="form-group col-md-7">
                                    <select class="form-control input-lifeSound list-company" name="company">
                                        <option id_company="0" name_company="null">-- Choose Company --</option>
                                        @foreach($dataCompany as $subDataCompany) 
                                            <option id_company="{{ $subDataCompany->id_company }}" name_company="{{ $subDataCompany->name_company }}">{{ $subDataCompany->name_company }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <input type="text" class="form-control" id="name_brand" placeholder="Tên sản phẩm"> --}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-5">
                                    <button class="button-30" role="button" disabled>Choose Own Driver</button>
                                </div>
                                <div class="form-group col-md-7">
                                    <select class="form-control input-lifeSound list-driver" name="driver">
                                        <option id_ud="0" name_ud="null">-- Choose Driver --</option>
                                        @foreach($dataDriver as $subDataDriver) 
                                            <option id_ud="{{ $subDataDriver->id_ud }}" name_ud="{{ $subDataDriver->name_ud }}">{{ $subDataDriver->name_ud }} - (Age: {{ $subDataDriver->age }})</option>
                                        @endforeach
                                    </select>
                                    {{-- <input type="text" class="form-control" id="name_brand" placeholder="Tên sản phẩm"> --}}
                                </div>
                            </div>
                            <div class="form-group" style="text-align: center;">
                                <button type="button" class="btn btn-outline-danger btn_add_new_car"><i class="fa fa-share-square-o" aria-hidden="true" style="margin-right: 0.5rem;"></i>Add Car</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
    <script>
        $('.btn_add_new_car').click(function() {
        
            let listCompany = document.querySelector('.list-company');
            let listDriver = document.querySelector('.list-driver');


            let id_company = listCompany.options[listCompany.selectedIndex].getAttribute('id_company');
            let id_ud = listDriver.options[listDriver.selectedIndex].getAttribute('id_ud');
            let vehical_num = $('#vehical_num').val();
            

            if(vehical_num == '' || id_company == 0) {
                displayToast('Enter fully, Please !');
            } else {

                var form  = new FormData();
                form.append('vehical_num', vehical_num);
                form.append('id_company', id_company);
                form.append('id_ud', id_ud);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{URL::to("/car/add-new-car")}}',
                    method: 'post',
                    data: form,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data) {
                        window.location.href = '{{URL::to("/car/add-car")}}';
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
