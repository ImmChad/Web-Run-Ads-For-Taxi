
addAndRemoveCompany();

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