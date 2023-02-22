


let btnUploadVideo = document.querySelector('.btn-upload-video');
btnUploadVideo.addEventListener('click', (e) => {
    e.currentTarget.closest('.input-ads').querySelector('#news_video').click();
});

$('#news_video').change(function(e) {
    $('#video_path').val(e.currentTarget.files[0].name);
    $('#displayVideo').attr('src',URL.createObjectURL(e.currentTarget.files[0]));
});




let  btnAddVideo = document.querySelector('.btn-add-video');
btnAddVideo.addEventListener('click', (e) => {

    let video_name = $('#video_name').val();
    let video_description = $('#video_description').val();
    let video_thumbnail =$('#video_thumbnail').val();
    let video_path = $('#news_video')[0].files;
    let video_length = "";

    let name_video_path = $('#video_path').val();

    if(name_video_path != '' && video_name.trim() != '') {

        if(video_path[0].size >= 100000000) {
            displayToast('The video file bigger 100mb !')
        } else {
            if(isImage(video_thumbnail) == false) {
                video_thumbnail = '';
            }

            if(document.getElementById("displayVideo").duration >= 60) {
                video_length = (document.getElementById("displayVideo").duration / 60).toFixed(2) + " minutes";
            } else {    
                video_length = Math.round(document.getElementById("displayVideo").duration ) + " seconds";
            }


            
            var form  = new FormData();
            form.append('video_name', video_name);
            form.append('video_description', video_description);
            form.append('video_length', video_length);
            form.append('video_thumbnail', video_thumbnail);
            form.append('video_path', video_path[0]);
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/video/add-video-in-media',
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
                    window.location.href = "/video/all-video";
                },
                error: function() {
                    displayToast('Can not update data!');
                }
            });
        }
    } else {
        displayToast('Enter full, please!')
    }
    
});





// btn coppy video path
let btnCoppy = document.querySelectorAll('.btn-coppy');
btnCoppy.forEach((item) => {
    item.addEventListener('click', (e) => {
        let video_path = e.currentTarget.getAttribute('video_path');
        navigator.clipboard.writeText(video_path);
        displayToast('Copied');
    });
});

// btn delete video
let btnDeleteVideo = document.querySelectorAll('.btn-delete-video');
btnDeleteVideo.forEach((item) => {
    item.addEventListener('click', (e) => {
        let video_id = e.currentTarget.getAttribute('video_id');


        let popUpAds = document.querySelector('.pop-up-ads');
        popUpAds.classList.add('active');
        
        let newHTML = `
            <div class="col-lg-6 div-edit-layout" style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                <div class="card " style="border: 4px solid #c82e2e; border-radius: 25px; width: 100%;">
                    <div class="card-body">
                        <div style="display: flex;justify-content: space-between">
                            <div class="card-title col-sm-7" style="font-size: 30px; font-weight: 900;">WARNING DELETE</div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <form>
                                    <div class="form-group row">
                                        <div class="form-group col-md-12">
                                            <h4 style="font-size: 20px; font-weight: 900;">Confirm delete: </h4>
                                            <input type="password" class="input-ads" id="password_admin" placeholder="Enter your password ..." >
                                        </div>
                                    </div>
                                    <div class="form-group" style="text-align: center;">
                                        <button type="button" class="button-ads btn_confirm_delete">Delete</button>
                                        <button type="button" class="button-ads btn_cancer_delete">Cancer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        document.querySelector('.pop-up-ads').insertAdjacentHTML('beforeend', newHTML);

        // set event click CONFIRM DELETE
        let btnConfirmDelete = document.querySelector('.btn_confirm_delete');
        btnConfirmDelete.addEventListener('click', (e) => {

            console.log(video_id);

            let password_admin = $('#password_admin').val();

            var form  = new FormData();
            form.append('video_id', video_id);
            form.append('password_admin', password_admin);
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/video/delete-video-in-media',
                method: 'post',
                data: form,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data) {
                    window.location.href = "/video/all-video";
                },
                error: function(data) {
                    displayToast(data.responseText);
                    console.log(data.responseText);
                }
            });
        });

         // set event click CONFIRM DELETE
        let btnCancerDelete = document.querySelector('.btn_cancer_delete');
        btnCancerDelete.addEventListener('click', (e) => {
            popUpAds.classList.remove('active');
            let divEditLayout = popUpAds.querySelectorAll('.div-edit-layout');
            divEditLayout.forEach((item) => {
                item.remove();
            });
        });
        
        
        //  Set event click closes in pop up
        let exitPopUpAds = popUpAds.querySelector('.exit-pop-up-ads');
        exitPopUpAds.addEventListener('click', (e) => {
            popUpAds.classList.remove('active');
            let divEditLayout = popUpAds.querySelectorAll('.div-edit-layout');
            divEditLayout.forEach((item) => {
                item.remove();
            });
        });
    });
});
















// check if a Url is image
function isImage(url) {
    return /\.(jpg|jpeg|png|webp|avif|gif|svg)$/.test(url);
}


function openFullscreen(elem) {
    if (elem.requestFullscreen) {
        elem.requestFullscreen();
    } else if (elem.webkitRequestFullscreen) { /* Safari */
        elem.webkitRequestFullscreen();
    } else if (elem.msRequestFullscreen) { /* IE11 */
        elem.msRequestFullscreen();
    }
}