@extends('Backend.index')
@section('contentAdmin')
    <div  style="display: flex; justify-content: center; align-items: center; width: 100%; height: 100%;">
        <div class="col-lg-6" style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
            <div class="card " style="border: 4px solid #c82e2e; border-radius: 25px; width: 100%;">
                <div class="card-body">
                    <div style="display: flex;justify-content: space-between">
                        <div class="card-title col-sm-7" style="font-size: 30px; font-weight: 900;">Add Groups</div>
                        <div class="col-sm-5">
                            <button class="button-ads btn-return-list">Return group list</button>
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col">
                            <form>
                                <div class="form-group row">
                                    <div class="form-group col-md-12">
                                        <h4 style="font-size: 20px; font-weight: 900;">City name: </h4>
                                        <input type="text" class="input-ads" id="company_group" placeholder="Enter city name ..." >
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
                                        {{-- <button class="button-30 display-group" list_company_group="adsfdsfdsf" style="cursor: pointer;"><i class="fa fa-times" aria-hidden="true" style="margin-right: 0.5rem;"></i>TEST 1</button> --}}
                                        
                                    </div>
                                </div>
                                <div class="form-group" style="text-align: center;">
                                    <button type="button" class="button-ads btn_add_new_company">Add</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
    <script src="{{ asset('backend/js/company/addCompany.js') }}"></script>


    <script>
        $('.btn-return-list').click(function() {
            window.location.href = "/company/all-company/";
        });

        $('.btn_add_new_company').click(function() {
        
            let company_group = $('#company_group').val();
            // list group
            let listGroup = [];
            let displayGroup = document.querySelectorAll('.display-group');
            displayGroup.forEach((item) => {
                let subListGroup = new Object();
                subListGroup.group_name = item.getAttribute('list_company_group');
                listGroup[listGroup.length] = subListGroup; 
            });
            

            if(company_group == '' || listGroup.length == 0) {
                displayToast('Enter fully, Please !');
            } else {

                var form  = new FormData();
                form.append('company_group', company_group);
                form.append('listGroup', JSON.stringify(listGroup));  

                console.log(listGroup);
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{URL::to("/company/add-new-company")}}',
                    method: 'post',
                    data: form,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data) {
                        window.location.href = '{{URL::to("/company/add-company")}}';
                    },
                    error: function() {
                        displayToast('Can not add data!');
                    }
                });
            }

        });
        

    </script>

    <style>
        /* CSS */
        .button-30 {
            border-radius: 20px;
            /* padding: 15px 0; */
            align-items: center;
            border-radius: 20px;
            border: 3px solid #c82e2e;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            /* font-family: "JetBrains Mono",monospace; */
            height: 48px;
            padding-left: 16px;
            padding-right: 16px;
            font-size: 18px;
            color: #c82e2e;
            background-color: #ffb6b6;
        }


        .button-ads:hover {
            color: #c82e2e;
            background-color: #ffb6b6;
        }

        
        .scroll-add-company::-webkit-scrollbar {
            width: 8px;
        }

        .scroll-add-company::-webkit-scrollbar-track {
            /* background-color: rgb(253, 162, 162); */
        }

        .scroll-add-company::-webkit-scrollbar-thumb {
            background-color: #c82e2e ;
            border-radius: 6px;
        }


    </style>


@endsection
