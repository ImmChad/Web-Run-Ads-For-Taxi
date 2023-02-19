@extends('Backend.index')
@section('contentAdmin')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card" >
            <div class="card-body">
                <div style="display: flex;justify-content: space-between">
                    <div class="card-title col-sm-9" style="font-size: 30px; font-weight: 900;  text-shadow: 0px 3px 0px #b2a98f,
                    0px 14px 10px rgba(0,0,0,0.15),
                    0px 24px 2px rgba(0,0,0,0.1),
                    0px 34px 30px rgba(0,0,0,0.1);">The Table List Videos Ads
                    </div>
                    <div>
                        <button class="button-30 btn_add_video_ads" role="button" > <i class="fa-solid fa-upload" style="margin-right: 0.5rem"></i> Add Video </button>
                    </div>
                </div>

                <div  class="row" style="margin-top:20px; height: 500px; ">
                    <div class="col-md-4" style=" height: 500px;  display: flex; justify-content: flex-start; align-items: flex-start; flex-direction: column;">
                        <h3 class="page-title" style="color: #a80404; font-weight: 700; ">
                            Cooperate with: 
                        </h3>
                        <div class="row border-company-list" style="width: 100%; height: 400px; ">
                            <div class="col " style=" padding: 1rem; border: 3px solid rgb(153 13 13); ">
                                @foreach($listVideoAds as $subListVideoAds)
                                    <div class="name_company_display " id_videos_ads="{{ $subListVideoAds->id_videos_ads }}">
                                        @foreach ($subListVideoAds->listCompany as $subListCompanyVideo)
                                            <h3 class="page-title" id_company="{{ $subListCompanyVideo->id_company  }}" style="color: #000000; font-weight: 700; ">
                                                {{ $subListCompanyVideo->name_company  }}
                                            </h3>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-8 nice-scroll-right" style=" height: 500px; border: 1px solid black; overflow-y: scroll;">
                        <table style="margin-top:20px; ;" class="table">
                            <tbody>
                                @foreach($listVideoAds as $subListVideoAds) 
                                    <tr class="row_data_news" id_videos_ads="{{ $subListVideoAds->id_videos_ads }}">
                                        <td class="get_id_data_video" >
                                            <video  class="rounded mx-auto d-block displayVideo" id="displayVideo" id_videos_ads="{{ $subListVideoAds->id_videos_ads }}"  style="width: 300px; height: 150px;  object-fit: cover; display: none; border-radius: 10px !important;"> 
                                                <source src="{{ URL::to($subListVideoAds->url_videos_ads) }}" type="video/mp4" />
                                            </video>
                                        </td>
                                        <td style="vertical-align: unset;  text-align: unset;">
                                            <h4 class="page-title" style="color: #000000; font-weight: 700;  ">Name Video Ads:</h4>
                                            <input type="text" class="form-control input-lifeSound" value="{{ $subListVideoAds->name_videos_ads }}" id="name_videos_ads" placeholder="Enter Name Video Ads ..." style="border-radius: 8px; border: 3px solid #a80404;" disabled>
                                            <input type="text" id="id_videos_ads" value="{{ $subListVideoAds->id_videos_ads }}" style="display: none;">
                                            <h4 class="page-title" style="color: #000000; font-weight: 700;  ">Length:</h4>
                                            <div style="display: flex;">
                                                <span style="padding: 0.3rem; border-radius: 8px; border: 3px solid #a80404; vertical-align: middle; cursor: pointer; ">{{ $subListVideoAds->length_video_ads }} Second <i class="fa-solid fa-caret-down" style="margin-left: 0.2rem; color: #a80404"></i></span>
                                                <span class="btn-detail-video" id_videos_ads="{{ $subListVideoAds->id_videos_ads }}" style="padding: 0.3rem; border-radius: 8px; border: 3px solid #a80404; vertical-align: middle; cursor: pointer; margin: 0px 0.3rem"> <i class="fa-solid fa-pen-to-square" style="color: #a80404; padding: 0rem 0.3rem""></i></span>
                                                <span class="btn-delete-video" id_videos_ads="{{ $subListVideoAds->id_videos_ads }}" style="padding: 0.3rem; border-radius: 8px; border: 3px solid #a80404; vertical-align: middle; cursor: pointer; "><i class="fa fa-trash" style=" color: #a80404; padding: 0rem 0.3rem"></i></span>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
        
                        </table>
                    </div>
                </div>
                <div class="row" >
                    <div class="col" style="padding: 0.5rem; display: flex; justify-content: center; align-items: center;">
                        <input type="text" id="current_page" value="{{ $page }}" style="display: none;">
                        
                        @if($page > 1)
                            <a class="page_navigation" href="/video/all-video?page={{ $page - 1 }}" style="color: black; text-decoration: none;">
                                <span class="previous_page_navigation" style="font-weight: 700; padding: 0.2rem 0.5rem; border: 3px solid #a80404; margin: 0.5rem; cursor: pointer;"> <i class="fa-solid fa-angles-left"></i> </span>
                            </a>
                        @endif
                            @for($i = 1; $i <= $total_page; $i++)
                                @if($page > 2 && $i >= ($page - 1) && $i <= ($page + 1)) 
                                    <a class="page_navigation" href="/video/all-video?page={{ $i }}" style="color: black; text-decoration: none; ">
                                        <span style="font-weight: 700; padding: 0.2rem 0.5rem; border: 3px solid #a80404; margin: 0.5rem; cursor: pointer;"> {{ $i }} </span>
                                    </a>
                                @elseif($page == 1 && $i < 3)
                                    <a class="page_navigation" href="/video/all-video?page={{ $i }}" style="color: black; text-decoration: none; ">
                                        <span style="font-weight: 700; padding: 0.2rem 0.5rem; border: 3px solid #a80404; margin: 0.5rem; cursor: pointer;"> {{ $i }} </span>
                                    </a>
                                @else 
                                    <a class="page_navigation" href="/video/all-video?page={{ $i }}" style="color: black; text-decoration: none;">
                                        <span style="font-weight: 700; padding: 0.2rem 0.5rem; border: 3px solid #a80404; margin: 0.5rem; cursor: pointer;"> {{ $i }} </span>
                                    </a>
                                @endif
                            @endfor
                        @if($page < $total_page)
                            <a class="page_navigation" href="/video/all-video?page={{ $page + 1 }}" style="color: black; text-decoration: none;">
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
        let btnDeteilVideo = document.querySelectorAll('.btn-detail-video');
        if(btnDeteilVideo.length > 0) {
            btnDeteilVideo.forEach((item) => {
                item.addEventListener('click', function(e) {
                    let dataID =  e.currentTarget.getAttribute("id_videos_ads");
                    window.location.href = "update-video/" + dataID + "";
                });
            });
        }

        let btnDeleteVideo = document.querySelectorAll('.btn-delete-video');
        if(btnDeleteVideo.length > 0) {
            btnDeleteVideo.forEach((item) => {
                item.addEventListener('click', function(e) {
                    let dataID =  e.currentTarget.getAttribute("id_videos_ads");
                    window.location.href = "delete-video/" + dataID + "";
                });
            });
        }

        let displayVideo = document.querySelectorAll('.displayVideo');
        displayVideo.forEach((item) => {
            item.addEventListener('click', (e) => {
                openFullscreen(e.currentTarget);
            });
        });

        function openFullscreen(elem) {
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.webkitRequestFullscreen) { /* Safari */
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) { /* IE11 */
                elem.msRequestFullscreen();
            }
        }

        $('.btn_add_video_ads').click(function() {
            window.location.href = "/video/add-video";
        });
        


        

        let rowDataNews = document.querySelectorAll('.row_data_news');
        if(rowDataNews.length > 0) {
            rowDataNews.forEach((item) => {
                item.addEventListener(('click'), (e) => {
                    let id_videos_ads = e.currentTarget.getAttribute("id_videos_ads");
                    rowDataNews.forEach((item) => {
                        item.classList.remove("active");
                        if(item.getAttribute("id_videos_ads") == id_videos_ads) {
                            item.classList.add("active");
                            let nameCompanyDisplay = document.querySelectorAll('.name_company_display');
                            nameCompanyDisplay.forEach((subitem) => {
                                subitem.classList.remove("active");
                                if(subitem.getAttribute("id_videos_ads") == id_videos_ads) {
                                    subitem.classList.add("active");
                                }
                            });
                        }
                    });
                });
            })
            rowDataNews[0].classList.add("active");
            let nameCompanyDisplay = document.querySelectorAll('.name_company_display');
            nameCompanyDisplay[0].classList.add("active");
        }

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


    .row_data_news:nth-child(odd) {
        background-color: unset;
    }
    .row_data_news:nth-child(even) {
        background-color: unset;
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



</style>


@endsection
