

















let btnUpdateGroup = document.querySelectorAll('.btn-update-group');
btnUpdateGroup.forEach((item) => {
    item.addEventListener('click', (e) =>  {
        let popUpAds = document.querySelector('.pop-up-ads');
        popUpAds.classList.add('active');

        if(e.currentTarget.getAttribute('parent_id') != 0 ) {
            let newHTML = `
                <div class="col-lg-6 div-edit-layout" style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                    <div class="card " style="border: 4px solid #c82e2e; border-radius: 25px; width: 100%;">
                        <div class="card-body">
                            <div style="display: flex;justify-content: space-between">
                                <div class="card-title col-sm-7" style="font-size: 30px; font-weight: 900;">Edit Groups</div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <form>
                                        <div class="form-group row">
                                            <div class="form-group col-md-12">
                                                <h4 style="font-size: 20px; font-weight: 900;">City name: </h4>
                                                <input type="text" class="input-ads" id="company_group" placeholder="Enter city name ..." value="`+ e.currentTarget.getAttribute('company_group') +`" >
                                                <input type="text" id="company_id" style="display: none;" value="`+ e.currentTarget.getAttribute('company_id') +`" >
                                            </div>
                                        </div>
                                        <div class="form-group" style="text-align: center;">
                                            <button type="button" class="button-ads btn_update_new_company">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            document.querySelector('.pop-up-ads').insertAdjacentHTML('beforeend', newHTML);
        } else {
            let newHTML = `
                <div class="col-lg-6 div-edit-layout" style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                    <div class="card " style="border: 4px solid #c82e2e; border-radius: 25px; width: 100%;">
                        <div class="card-body">
                            <div style="display: flex;justify-content: space-between">
                                <div class="card-title col-sm-7" style="font-size: 30px; font-weight: 900;">Edit Groups</div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <form>
                                        <div class="form-group row">
                                            <div class="form-group col-md-12">
                                                <h4 style="font-size: 20px; font-weight: 900;">City name: </h4>
                                                <input type="text" class="input-ads" id="company_group" placeholder="Enter city name ..." value="`+ e.currentTarget.getAttribute('company_group') +`" >
                                                <input type="text" id="company_id" style="display: none;" value="`+ e.currentTarget.getAttribute('company_id') +`" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="form-group col-md-12">
                                                <h4 style="font-size: 20px; font-weight: 900;">Add Group: </h4>
                                                <div class="input-ads" style="display: flex;justify-content: space-between; padding-right: 0px;">
                                                    <input type="text" class="text-name-group" style="width: 100%; color: #c82e2e; font-weight: 700; border: none; background: transparent; outline: none;"  type="text" id="num_sim" placeholder="Enter group of company ..." autocomplete="off">
                                                    <button class="btn-name-group" style=" width: 150px; font-size: 18px; font-weight: 700; border: 3px solid #c82e2e; background: #c82e2e; outline: none; border-radius: 17px; color: white; cursor: pointer;">
                                                        Add group
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row scroll-add-company" style="max-height: 100px; overflow-y: scroll;">
                                            <div class="form-group col-md-12 company-contains">
                                                
                                                
                                            </div>
                                        </div>

                                        <div class="form-group" style="text-align: center;">
                                            <button type="button" class="button-ads btn_update_new_company">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            document.querySelector('.pop-up-ads').insertAdjacentHTML('beforeend', newHTML);
            addAndRemoveCompany();
        }
        

        //  Set event click closes in pop up
        let exitPopUpAds = popUpAds.querySelector('.exit-pop-up-ads');
        exitPopUpAds.addEventListener('click', (e) => {
            popUpAds.classList.remove('active');
            let divEditLayout = popUpAds.querySelectorAll('.div-edit-layout');
            divEditLayout.forEach((item) => {
                item.remove();
            });
        });


        //  Set event click update in pop up
        let btnUpdateNewCompany = document.querySelector('.btn_update_new_company');
        btnUpdateNewCompany.addEventListener('click', (e) => {
        
            let company_id = $('#company_id').val();
            let company_group = $('#company_group').val();
            // list group
            let listGroup = [];
            let displayGroup = document.querySelectorAll('.display-group');
            displayGroup.forEach((item) => {
                let subListGroup = new Object();
                subListGroup.group_name = item.getAttribute('list_company_group').trim();
                listGroup[listGroup.length] = subListGroup; 
            });
            

            if(company_group.trim() == '') {
                displayToast('Enter fully, Please !');
            } else {
                // console.log(company_group);
                // console.log(listGroup);

                var form  = new FormData();
                form.append('company_id', company_id);
                form.append('company_group', company_group);
                form.append('listGroup', JSON.stringify(listGroup));
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/company/update-new-company',
                    method: 'post',
                    data: form,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data) {
                        window.location.href = "/company/all-company";
                    },
                    error: function() {
                        displayToast('Can not update data!');
                    }
                });
            }

        });
    });
});

let btnDeleteGroup = document.querySelectorAll('.btn-delete-group');
btnDeleteGroup.forEach((item) => {
    item.addEventListener('click', (e) => {
        let company_id = e.currentTarget.getAttribute('company_id');

        // window.location.href = "/company/delete-company/" + company_id +"";

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
            form.append('company_id', company_id);
            form.append('password_admin', password_admin);
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/company/delete-company',
                method: 'post',
                data: form,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data) {
                    window.location.href = "/company/all-company";
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














// ===>>> function thêm xóa company
function addAndRemoveCompany() {
    let btnNameGroup = document.querySelector('.btn-name-group');
    let textNameGroup = document.querySelector('.text-name-group');
    
    btnNameGroup.addEventListener('click', (e) => {
        e.preventDefault();
        
        let textName = textNameGroup.value;

        let companyContains = document.querySelector('.company-contains');
        if(textName.trim() != "" ) {
            if(companyContains.children.length > 0) {
                let displayGroup = document.querySelectorAll('.display-group');
                let count = 0;
    
                displayGroup.forEach((item) => {
                    if(item.getAttribute('list_company_group') == textName) {
                        count = count + 1;
                    } 
                });
                if(count > 0) {
                    displayToast('It has been choosed!');
                } else {
                    let newHTML = `
                        <button class="button-30 display-group" list_company_group="`+textName+`" style="cursor: pointer;"><i class="fa fa-times" aria-hidden="true" style="margin-right: 0.5rem;"></i>`+textName+`</button>
                    `;
                    document.querySelector('.company-contains').insertAdjacentHTML('beforeend', newHTML);
                    deleteCompany();
                }
            } else {
                let newHTML = `
                <button class="button-30 display-group" list_company_group="`+textName+`" style="cursor: pointer;"><i class="fa fa-times" aria-hidden="true" style="margin-right: 0.5rem;"></i>`+textName+`</button>
                `;
                document.querySelector('.company-contains').insertAdjacentHTML('beforeend', newHTML);
                deleteCompany();
            }
        } else {
            displayToast("Enter full, Please!")
        }


    });

}

function deleteCompany() {
    let displayGroup = document.querySelectorAll('.display-group');
    displayGroup[displayGroup.length-1].addEventListener('click', function(e) {
        e.currentTarget.remove();
    });
}