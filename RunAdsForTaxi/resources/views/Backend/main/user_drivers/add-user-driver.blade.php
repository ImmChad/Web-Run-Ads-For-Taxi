@extends('Backend.index')
@section('contentAdmin')
    <div class="page-header">
        <h3 class="page-title" style="color: #a80404; font-weight: 700; margin-left: 1rem">
            Manage Drivers
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="fa-solid fa-users" style="color: #a80404;"></i>
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
                    0px 34px 30px rgba(0,0,0,0.1);">Add Driver</div>
                </div>

                <div class="row">
                    <div class="col">
                        <form>
                            <div class="form-group row">
                                <div class="form-group col-md-5">
                                    <button class="button-30" role="button" disabled>Name Driver </button>
                                </div>
                                <div class="form-group col-md-7">
                                    <input type="text" class="form-control input-lifeSound" id="name_ud" placeholder="Enter Name Driver ...">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-5">
                                    <button class="button-30" role="button" disabled>Tel</button>
                                </div>
                                <div class="form-group col-md-7">
                                    <input type="text" class="form-control input-lifeSound" id="num_phone_ud" placeholder="Enter Telephone Of Drivers ...">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-5">
                                    <button class="button-30" role="button" disabled>Birthday</button>
                                </div>
                                <div class="form-group col-md-7">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text btn_choose_date" id="basic-addon1">
                                                <i class="fa fa-calendar" aria-hidden="true" style="color: black;"></i>
                                            </span>
                                        </div>
                                        <input type="text" id="birthday_ud" class="form-control input-lifeSound" placeholder="Enter birth day driver ... " aria-label="Username" aria-describedby="basic-addon1" >
                            
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" >
                                <div class="form-group col-md-5">
                                    <button class="button-30 uploadImageDriver" role="button"><i class="fa fa-upload" aria-hidden="true" style="margin-right: 0.5rem;"></i> Upload</button>
                                </div>
                                <div class="form-group col-md-7">
                                    <input type="text" class="form-control" id="display_file_image_driver" placeholder="Here is name image" disabled>
                                    <input id="news_image" type="file" name="news_image" accept="image/*" class="file-upload-default">
                                </div>
                            </div>
                            <div class="form-group" style="text-align: center;">
                                <button type="button" class="btn btn-outline-danger btn_add_new_driver"><i class="fa fa-share-square-o" aria-hidden="true" style="margin-right: 0.5rem;"></i>Add Driver</button>
                            </div>
    
                        </form>
                    </div>
                    <div class="col">
                        <img src="/uploads/user_drivers/users_default.png" class="rounded mx-auto d-block displayImageDriver" alt="" style="width: 200px; height: 200px; object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>



    {{-- display calender --}}
    <link  rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css"   />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
    <script >
        $('#birthday_ud').each(function () {
            $(this).datetimepicker();
        });
    </script>

    <script>
        $('.uploadImageDriver').click(function(e) {
            e.preventDefault();
            $('#news_image').click();
        });

        $('#news_image').change(function(e) {
            $('#display_file_image_driver').val(e.currentTarget.files[0].name);
            $('.displayImageDriver').attr('src',URL.createObjectURL(e.currentTarget.files[0]));
        });

        $('.btn_add_new_driver').click(function() {
        
            let name_file_Image = $('#display_file_image_driver').val();
            let name_ud = $('#name_ud').val();
            let num_phone_ud = $('#num_phone_ud').val();
            let birthday_ud = $('#birthday_ud').val();
            let url_avt_ud = $('#news_image')[0].files;
            

            if(name_ud == '' || num_phone_ud == '' || birthday_ud == '' || name_file_Image == '') {
                displayToast('Enter fully, Please !');
            } else {

                var form  = new FormData();
                form.append('name_ud', name_ud);
                form.append('num_phone_ud', num_phone_ud);
                form.append('birthday_ud', birthday_ud);
                form.append('url_avt_ud', url_avt_ud[0]);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{URL::to("/driver/add-new-driver")}}',
                    method: 'post',
                    data: form,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data) {
                        window.location.href = '{{URL::to("/driver/add-driver")}}';
                    },
                    error: function() {
                        displayToast('Can not add data!');
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
