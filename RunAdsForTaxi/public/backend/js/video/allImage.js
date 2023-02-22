

let btnUploadImage = document.querySelector('.btn-upload-image');
btnUploadImage.addEventListener('click', (e) => {
    $('#news_image').click();
});





$('#news_image').change(function(e) {
    $('#photo_path').val(e.currentTarget.files[0].name);
});




let  btnAddImage = document.querySelector('.btn-add-image');
btnAddImage.addEventListener('click', (e) => {

    let photo_name = $('#photo_name').val();
    let photo_description = $('#photo_description').val();
    let photo_path = $('#news_image')[0].files;

    let name_photo_path = $('#photo_path').val();


    if(name_photo_path != '' && photo_name.trim() != '') {
        var form  = new FormData();
            form.append('photo_name', photo_name);
            form.append('photo_description', photo_description);
            form.append('photo_path', photo_path[0]);
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/video/add-image-in-media',
                method: 'post',
                data: form,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data) {
                    window.location.href = "/video/all-image";
                },
                error: function() {
                    displayToast('Can not update data!');
                }
            });
    } else {
        displayToast('Enter full, please!')
    }
    
});





// btn coppy video path
let btnCoppy = document.querySelectorAll('.btn-coppy');
btnCoppy.forEach((item) => {
    item.addEventListener('click', (e) => {
        let video_path = e.currentTarget.getAttribute('photo_path');
        navigator.clipboard.writeText(video_path);
        displayToast('Copied');
    });
});

// btn delete video
let btnDeletePhoto = document.querySelectorAll('.btn-delete-photo');
btnDeletePhoto.forEach((item) => {
    item.addEventListener('click', (e) => {
        let photo_id = e.currentTarget.getAttribute('photo_id');


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

            let password_admin = $('#password_admin').val();

            var form  = new FormData();
            form.append('photo_id', photo_id);
            form.append('password_admin', password_admin);
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/video/delete-image-in-media',
                method: 'post',
                data: form,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data) {
                    window.location.href = "/video/all-image";
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
















