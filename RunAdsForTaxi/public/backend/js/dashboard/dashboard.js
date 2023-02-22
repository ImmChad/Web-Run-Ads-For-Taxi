


let chooseTime = document.querySelectorAll('.choose-time');
chooseTime.forEach((item) => {
    item.addEventListener('click', (e) => {
        document.getElementById('action').style.left = e.target.offsetLeft + 'px';
        let position = e.currentTarget.getAttribute('get_time');

        document.querySelectorAll('.choose-time-to-filter').forEach((item) => {
            item.classList.remove('active');
        });
        document.querySelectorAll('.choose-time-to-filter')[position].classList.add('active');

    });
});




document.addEventListener('click',(event)=>{
    var section_result_search = document.querySelector('.section-ipt-search')

    if(!section_result_search.contains(event.target))
    {
        var list_result_search = document.querySelector('.dropdown-result-search')
        list_result_search.style.display = "none";

    }
})
window.addEventListener('load',(event)=>{

    loadEventClickItem_DropdownSearchDashboard();
    loadEventIptSearch();
    loadEventBtnSubmitDashboard();
})

function loadEventClickItem_DropdownSearchDashboard()
{
    var list_result_search = document.querySelectorAll('.dropdown-result-search .item-result-search');
    list_result_search.forEach(
        item=>{
            item.addEventListener('click',()=>{
                var label = item.querySelector('.label-item-search').textContent.trim()
                var value = item.querySelector('.value-item-search').textContent.trim()
                var ipt_search_dashboard = document.querySelector('#ipt-search-dashboard');
                ipt_search_dashboard.value =  `${value}` ;
                if(item.getAttribute('data-type')=='taxi')
                {
                    ipt_search_dashboard.setAttribute('taxi-id',item.getAttribute('data-id'))
                    ipt_search_dashboard.setAttribute('company-id',-1)

                }
                else if(item.getAttribute('data-type')=='company')
                {
                    ipt_search_dashboard.setAttribute('company-id',item.getAttribute('data-id'))
                    ipt_search_dashboard.setAttribute('taxi-id',-1)

                }
            })

        }
    )
}

function loadEventBtnSubmitDashboard()
{
    var btn_submit_search_dashboard = document.querySelector('#btn-submit-search-dashboard');
    var ipt_search_dashboard = document.querySelector('#ipt-search-dashboard');

    btn_submit_search_dashboard.addEventListener('click',(event)=>{
        let itemDate = document.querySelector('.choose-time-to-filter.active');
        let start_date = itemDate.getAttribute('start_date');
        let end_date = itemDate.getAttribute('end_date');
        console.log(start_date + ", " + end_date);
        event.preventDefault()
        requestDataStatistics(
            {
                text_search: ipt_search_dashboard.value,
                start_time: start_date,
                end_time: end_date,
            }
        )
        // location.href = `/dashboard/?taxi-id=${ipt_search_dashboard.getAttribute('taxi-id')}&company-id=${ipt_search_dashboard.getAttribute('company-id')}`.trim()
    })
}

function loadEventIptSearch() {
    var ipt_search_dashboard = document.querySelector('#ipt-search-dashboard');
    ipt_search_dashboard.addEventListener('keyup',(event)=>{
        var list_result_search = document.querySelectorAll('.dropdown-result-search .item-result-search');
    list_result_search.forEach(
        
        item=>{
            var value_item = item.querySelector('.value-item-search').textContent.trim();
            var value_search = event.currentTarget.value.trim()
            if(value_search.length>0)
            {
                // console.log(value_item,value_search,value_item.indexOf(value_search));
                if(value_item.toLowerCase().indexOf(value_search.toLowerCase())>=0)
                    {
                        item.style.display = "block"
                    }
                    else
                    {
                        item.style.display = "none"
                    }
            }
            else
            {
                item.style.display = "block"
            }
        }
    )
    })
    ipt_search_dashboard.addEventListener('focus',(event)=>{
        document.querySelector('.dropdown-result-search').style.display = 'block'
    })
}
function requestDataStatistics(
    {
        text_search,
        start_time,
        end_time,
    }={}
) {
    var form = new FormData()
    form.append('text-search',text_search)
    form.append('start-time',start_time)
    form.append('end-time',end_time)
    fetch("/dashboard/get-data-statistics",{
        method: 'POST',
        mode: 'cors',
        body:form
    }).then(res=>res.json()).then(result=>{
        console.log(result);
        
        let resultTime = document.querySelectorAll('.result-time');
        resultTime[0].textContent = result.total_play_video;
        resultTime[1].textContent = convertTime_to_Text(result.total_length_time_run);
        resultTime[2].textContent = convertTime_to_Text(result.total_length_time_pause_image);

    })
}
function convertTime_to_Text(obj_time)
{
    if(obj_time.hours==0 && obj_time.minutes == 0)
    {
        return `${obj_time.seconds}s`
    }
    else if(obj_time.hours==0 &&  obj_time.minutes > 0) {

        return `${(obj_time.minutes + obj_time.seconds/60).toFixed(2)}'`
    }
    else if(obj_time.hours>0 )
    {
        return `${(obj_time.hours + obj_time.minutes/60).toFixed(2)}h`
    }
}



