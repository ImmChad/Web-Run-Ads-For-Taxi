
loadSelectField1()
function loadSelectField1()
{
var viewSelectFields = document.querySelectorAll('.select-update-field')
viewSelectFields.forEach(viewSelectField=>{

    document.addEventListener('click',(event)=>{
        showDropdownSelect(viewSelectField.contains(event.target) && !event.target.classList.contains('item-select-update-field'), viewSelectField.querySelector('.drop-list-select'))
    })

    var valueSelectedField = viewSelectField.querySelector('.value-select-update-field')
    viewSelectField.querySelector('.value-select-update-field').addEventListener('click', (event)=>
        {
            showDropdownSelect(true,viewSelectField.querySelector('.drop-list-select'))
        })

    var itemSelectFields = viewSelectField.querySelectorAll('.item-select-update-field')
    itemSelectFields.forEach(item=>{
        item.addEventListener('click',(event)=>{
            showDropdownSelect(false,viewSelectField.querySelector('.drop-list-select'))
            valueSelectedField.textContent = item.textContent
            valueSelectedField.setAttribute('data-value',item.getAttribute('data-value'))

        })
    })
})

}
function showDropdownSelect(isShow,viewDropSelect)
{ 
    if(isShow)
    {
        viewDropSelect.style.display = "block"
    }
    else
    {
        viewDropSelect.style.display = "none"
    }
}

let chooseGroupCompany = document.querySelectorAll('.choose-group-company');
chooseGroupCompany.forEach((item) => {
    item.addEventListener('click', (e) => {
        chooseGroupCompany.forEach((del) => {
            del.classList.remove('active');
        });
        e.currentTarget.classList.add('active');
    });
});


// BUTTON BROWSE VIDEO
let btnBrowseVideo = document.querySelector('.btn-browse-video');
btnBrowseVideo.addEventListener('click', (e) => {
    let video_path = $('#video_path').val();
    document.querySelector('.preview-video').setAttribute('src', "http://localhost:8000/" + video_path);

});

// BUTTON BROWSE IMAGE
let btnBrowseImage = document.querySelector('.btn-browse-image');
btnBrowseImage.addEventListener('click', (e) => {
    let photo_path = $('#photo_path').val();
    document.querySelector('.preview-img').setAttribute('src', "http://localhost:8000/" + photo_path);

});


// BUTTON CHOOSE VIDEO
let btnChooseVideo = document.querySelector('.btn-choose-video');
btnChooseVideo.addEventListener('click', (e) => {
    let popUpAds = document.querySelector('.pop-up-ads');
    popUpAds.classList.add('active');



    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/video/get-all-video-in-media',
        method: 'post',
        data: '',
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(data) {

            let newHTML = `
                <div class="col-lg-8 div-edit-layout" style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                    <div class="card " style="border: 4px solid #c82e2e; border-radius: 25px; width: 100%;">
                        <div class="card-body">
                            <div style="display: flex;justify-content: space-between">
                                <div class="card-title col-sm-7" style="font-size: 30px; font-weight: 900;">CHOOSE VIDEO</div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="col-md-12 nice-scroll-right" style=" height: 500px; overflow-y: hidden;">
                                        <div class="table-parent-div" style="box-shadow: rgb(17 17 26 / 10%) 0px 1px 0px; width: 100%; height: 100%;">
                                            <table style="width: 100%;  margin-bottom: 0px;" class="table table-bordered">
                                                <thead style="background-color: #c82e2e; color: #fff; ">
                                                    <tr>
                                                        <th>
                                                            Video name
                                                        </th>
                                                        <th>
                                                            Created at
                                                        </th>
                                                        <th>
                                                            Video path
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="scroll-table">
                                                    ${data.map((el) => { 
                                                        return `
                                                            <tr class="row_data_news" video_path="${el.video_path}" video_id="${el.id}">
                                                                <td class="get_id_data_company">
                                                                    ${el.video_name}
                                                                </td>
                                                                <td>
                                                                    ${el.created_at}
                                                                </td>
                                                                <td class="get_video_path" video_path="${el.video_path}">
                                                                    ...${(el.video_path).slice(-20)} 
                                                                </td>
                                                            </tr>`
                                                    }).join("")}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            document.querySelector('.pop-up-ads').insertAdjacentHTML('beforeend', newHTML);


            let row_data_news = document.querySelectorAll('.row_data_news');
            row_data_news.forEach((item) => {
                item.addEventListener('click', (e) => {
                    $('#video_path').val(e.currentTarget.getAttribute('video_path'));
                    $('.btn-update-ads').attr('video_id', e.currentTarget.getAttribute('video_id'));


                    popUpAds.classList.remove('active');
                    let divEditLayout = popUpAds.querySelectorAll('.div-edit-layout');
                    divEditLayout.forEach((item) => {
                        item.remove();
                    });
                });
            });
        },
        error: function(data) {
            displayToast(data.responseText);
            console.log(data.responseText);
        }
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

// BUTTON CHOOSE IMAGE
let btnChooseImage = document.querySelector('.btn-choose-image');
btnChooseImage.addEventListener('click', (e) => {
    let popUpAds = document.querySelector('.pop-up-ads');
    popUpAds.classList.add('active');



    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/video/get-all-image-in-media',
        method: 'post',
        data: '',
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(data) {

            let newHTML = `
                <div class="col-lg-8 div-edit-layout" style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                    <div class="card " style="border: 4px solid #c82e2e; border-radius: 25px; width: 100%;">
                        <div class="card-body">
                            <div style="display: flex;justify-content: space-between">
                                <div class="card-title col-sm-7" style="font-size: 30px; font-weight: 900;">CHOOSE PHOTO</div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="col-md-12 nice-scroll-right" style=" height: 500px; overflow-y: hidden;">
                                        <div class="table-parent-div" style="box-shadow: rgb(17 17 26 / 10%) 0px 1px 0px; width: 100%; height: 100%;">
                                            <table style="width: 100%;  margin-bottom: 0px;" class="table table-bordered">
                                                <thead style="background-color: #c82e2e; color: #fff; ">
                                                    <tr>
                                                        <th>
                                                            Photo name
                                                        </th>
                                                        <th>
                                                            Created at
                                                        </th>
                                                        <th>
                                                            Photo path
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="scroll-table">
                                                    ${data.map((el) => { 
                                                        return `
                                                            <tr class="row_data_news" photo_path="${el.photo_path}" photo_id="${el.id}">
                                                                <td class="get_id_data_company">
                                                                    ${el.photo_name}
                                                                </td>
                                                                <td>
                                                                    ${el.created_at}
                                                                </td>
                                                                <td class="get_photo_path" photo_path="${el.photo_path}">
                                                                    ...${(el.photo_path).slice(-20)} 
                                                                </td>
                                                            </tr>`
                                                    }).join("")}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            document.querySelector('.pop-up-ads').insertAdjacentHTML('beforeend', newHTML);


            let row_data_news = document.querySelectorAll('.row_data_news');
            row_data_news.forEach((item) => {
                item.addEventListener('click', (e) => {
                    $('#photo_path').val(e.currentTarget.getAttribute('photo_path'));
                    $('.btn-update-ads').attr('photo_id', e.currentTarget.getAttribute('photo_id'))


                    popUpAds.classList.remove('active');
                    let divEditLayout = popUpAds.querySelectorAll('.div-edit-layout');
                    divEditLayout.forEach((item) => {
                        item.remove();
                    });
                });
            });
        },
        error: function(data) {
            displayToast(data.responseText);
            console.log(data.responseText);
        }
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


// UPDATE VIDEO MANAGEMENT
let btnUpdateAds = document.querySelector('.btn-update-ads');
btnUpdateAds.addEventListener('click', (e) => {
    let video_path = $('#video_path').val();
    let photo_path = $('#photo_path').val();


    let video_id = e.currentTarget.getAttribute('video_id');
    let photo_id = e.currentTarget.getAttribute('photo_id');
    let change_time = $('.value-select-update-field').attr('data-value');
    let company_id = "";
    let chooseGroupCompany = document.querySelectorAll('.choose-group-company');
    chooseGroupCompany.forEach((item) => {
        if(item.classList.contains('active')) {
            company_id = item.getAttribute('company_id');
            // console.log(company_id);
        }
    });

    if(video_id != null && photo_id != null) {
        var form  = new FormData();
        form.append('video_id', video_id);
        form.append('photo_id', photo_id);
        form.append('change_time', change_time);
        form.append('company_id', company_id);
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/video/update-company-video-image',
            method: 'post',
            data: form,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data) {
                window.location.href = "/video/add-video";
            },
            error: function() {
                displayToast('Can not update data!');
            }
        });
    } else {
        displayToast('Choose video and photo, Please!');
    }







});





