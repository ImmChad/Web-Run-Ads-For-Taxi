@extends('Backend.index')
@section('contentAdmin')
    <div class="page-header">
        <h3 class="page-title" style="color: #a80404; font-weight: 700; margin-left: 1rem">
            Manage Video Ads
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="fa-solid fa-audio-description" style="color: #a80404;"></i>
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
                    0px 34px 30px rgba(0,0,0,0.1);">Add Video Ads</div>
                </div>

                <div class="row">
                    <div class="col-md-7">
                        <form>
                            <div class="form-group row">
                                <div class="form-group col-md-5">
                                    <button class="button-30" role="button" disabled>Name Video Ads </button>
                                </div>
                                <div class="form-group col-md-7">
                                    <input type="text" class="form-control input-lifeSound" id="name_videos_ads" placeholder="Enter Name Video Ads ...">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-5">
                                    <button class="button-30" role="button" disabled>Date debut</button>
                                </div>
                                <div class="form-group col-md-7">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text btn_choose_date" id="basic-addon1">
                                                <i class="fa fa-calendar" aria-hidden="true" style="color: black;"></i>
                                            </span>
                                        </div>
                                        <input type="text" id="date_debut" class="form-control input-lifeSound" placeholder="Enter date debut ... " aria-label="Username" aria-describedby="basic-addon1" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-5">
                                    <button class="button-30" role="button" disabled>Choose Company Cooperate</button>
                                </div>
                                <div class="form-group col-md-7">
                                    <select class="form-control input-lifeSound choose-company" name="company">
                                        <option id_company="0" name_company="All Company">-- All Company --</option>
                                        @foreach($dataCompany as $sub_dataCompany) 
                                            <option id_company="{{ $sub_dataCompany->id_company }}" name_company="{{ $sub_dataCompany->name_company }}">{{ $sub_dataCompany->name_company }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <input type="text" class="form-control" id="name_brand" placeholder="Tên sản phẩm"> --}}
                                </div>
                                <div class="form-group col-md-12">
                                    {{-- <h2 class="product-title">&nbsp;</h2> --}}
                                    <div class="custom-company" style="margin-bottom: 1rem;">
                                        <button class="button-30" role="button" disabled>With: </button>
                                        <button class="button-30 display-btn-company"  name_company="All Company" id_company="0" style="cursor: pointer;" ><i class="fa fa-times" aria-hidden="true" style="margin-right: 0.5rem;"></i>All Company</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" >
                                <div class="form-group col-md-5">
                                    <button class="button-30 uploadVideo" role="button"><i class="fa fa-upload" aria-hidden="true" style="margin-right: 0.5rem;"></i> Upload</button>
                                </div>
                                <div class="form-group col-md-7">
                                    <input type="text" class="form-control" id="display_file_video" placeholder="Here is name image" disabled>
                                    <input id="news_image" type="file" name="news_image" accept="video/mp4" class="file-upload-default">
                                </div>
                            </div>
                            <div class="form-group" style="text-align: center;">
                                <button type="button" class="btn btn-outline-danger btn_add_new_video"><i class="fa fa-share-square-o" aria-hidden="true" style="margin-right: 0.5rem;"></i>Add Video Ads</button>
                            </div>
    
                        </form>
                    </div>
                    <div class="col-md-5">
                        <video  class="rounded mx-auto d-block displayVideo" id="displayVideo"  style="width: 200px;  object-fit: cover;" controls> 
                            <source src="/uploads/video_ads/video_ads_default.png" type="video/mp4" />
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    




    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>

    <script src="{{ asset('backend/js/addVideoAds.js') }}"></script>


    {{-- display calender --}}
    <link  rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css"   />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
    <script >
        $('#date_debut').each(function () {
            $(this).datetimepicker();
        });
    </script>

    <script>

        function getExtension(filename) {
            var parts = filename.split('.');
            return parts[parts.length - 1];
        }

        $('.uploadVideo').click(function(e) {
            e.preventDefault();
            $('#news_image').click();
        });

        $('#news_image').change(function(e) {
            $('#display_file_video').val(e.currentTarget.files[0].name);
            $('.displayVideo').attr('src',URL.createObjectURL(e.currentTarget.files[0]));
        });

        $('.btn_add_new_video').click(function() {
        
            // list group
            let listCompany = [];
            let btnCompany = document.querySelectorAll('.display-btn-company');
            btnCompany.forEach((item) => {
                let subListCompany = new Object();
                subListCompany.id_company = item.getAttribute('id_company');
                subListCompany.name_company = item.getAttribute('name_company');

                listCompany[listCompany.length] = subListCompany;
            });


            let name_videos_file = $('#display_file_video').val();
            let name_videos_ads = $('#name_videos_ads').val();
            let date_debut = $('#date_debut').val();
            let url_videos_ads = $('#news_image')[0].files;
            var vid = document.getElementById("displayVideo");
            // time duration video
            console.log(vid.duration);

            
            

            if(name_videos_ads == '' ||  date_debut == '' || name_videos_file == '') {
                displayToast('Enter fully, Please !');
            } else if(listCompany.length == 0 ) {
                displayToast('Choose Company Cooperate, Please!');
            }else {

                var ext = getExtension(url_videos_ads[0].name);
                if(ext.toLowerCase() == 'mp4') {
                    var form  = new FormData();
                    form.append('name_videos_ads', name_videos_ads);
                    form.append('date_debut', date_debut);
                    form.append('length_video_ads', vid.duration);
                    form.append('listCompany', JSON.stringify(listCompany));  
                    form.append('url_videos_ads', url_videos_ads[0]);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{URL::to("/video/add-new-video")}}',
                        xhr: function() {
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener("progress", function(evt) {
                                if (evt.lengthComputable) {
                                    var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                                    $('.loading_proccess').addClass( "active");
                                    $('.loading_proccess .text_percent_process').text(percentComplete+'%');
                                }
                            }, false);
                            return xhr;
                        },
                        method: 'post',
                        data: form,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(data) {
                            $('.loading_proccess').removeClass("active");
                            window.location.href = '{{URL::to("/video/add-video")}}';
                        },
                        error: function() {
                            displayToast('Can not add data!');
                        }
                    });
                } else {
                    displayToast('Here is not file mp4!');
                }

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
