
addAndRemoveCompany();
deleteCompany();

// ===>>> function thêm xóa company
function addAndRemoveCompany() {
    let chooseCompany = document.querySelector('.choose-company');
    // let displaySpanProductCategory = document.querySelectorAll('.displaySpanProductCategory');
    chooseCompany.addEventListener('change', function() {
        const customCompany = document.querySelector('.custom-company');
        let name_company = chooseCompany.options[chooseCompany.selectedIndex].getAttribute('name_company');
        let id_company = chooseCompany.options[chooseCompany.selectedIndex].getAttribute('id_company');
        // console.log(id_category_product + ': ' + name_category_product);
        
        if(id_company != 0) {
            if(customCompany.children.length > 1) {
                let displayBtnCompany = document.querySelectorAll('.display-btn-company');
                let count = 0;
                displayBtnCompany.forEach((item) => {
                    if(item.getAttribute('id_company') == 0) {
                        item.remove();
                    } else if(item.getAttribute('id_company') == id_company) {
                        count = count + 1;
                    } 
                });
                if(count > 0) {
                    displayToast('It has been choosed!');
                } else {
                    let newHTML = `
                        <button class="button-30 display-btn-company"  name_company="`+name_company+`" id_company="`+ id_company +`" style="cursor: pointer;" ><i class="fa fa-times" aria-hidden="true" style="margin-right: 0.5rem;"></i>`+ name_company +` </button>
                    `;
                    document.querySelector('.custom-company').insertAdjacentHTML('beforeend', newHTML);
                    deleteCompany();
                }
            } else {
                let newHTML = `
                    <button class="button-30 display-btn-company"  name_company="`+name_company+`" id_company="`+ id_company +`" style="cursor: pointer;" ><i class="fa fa-times" aria-hidden="true" style="margin-right: 0.5rem;"></i>`+ name_company +` </button>
                `;
                document.querySelector('.custom-company').insertAdjacentHTML('beforeend', newHTML);
                deleteCompany();
            }
        } else {
            if(customCompany.children.length > 1) {
                let displayBtnCompany = document.querySelectorAll('.display-btn-company');
                displayBtnCompany.forEach((item) => {
                    item.remove();
                });
                let newHTML = `
                    <button class="button-30 display-btn-company"  name_company="`+name_company+`" id_company="`+ id_company +`" style="cursor: pointer;" ><i class="fa fa-times" aria-hidden="true" style="margin-right: 0.5rem;"></i>`+ name_company +` </button>
                `;
                document.querySelector('.custom-company').insertAdjacentHTML('beforeend', newHTML);
                deleteCompany();
            }
        }
    });
}
function deleteCompany() {
    let displayBtnCompany = document.querySelectorAll('.display-btn-company');
    displayBtnCompany[displayBtnCompany.length-1].addEventListener('click', function(e) {
        e.currentTarget.remove();
    });
}