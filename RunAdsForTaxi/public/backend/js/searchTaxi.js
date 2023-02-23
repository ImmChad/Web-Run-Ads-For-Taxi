window.addEventListener('load',(event)=>{
    var iptSearchTaxi = document.querySelector('.ipt-search-taxi');
    iptSearchTaxi.addEventListener('focus',(event)=>{
        setIsShowResultTaxi(true)
    })
    iptSearchTaxi.addEventListener('keyup',(event)=>{
        var textVehicleNumber = event.currentTarget.value.trim()
        if(textVehicleNumber.length>0)
        {
            requestSearchTaxi_byVehicleNumber(textVehicleNumber)

        }
        
    })
    document.addEventListener('click',(event)=>{
        var viewResultTaxi = document.querySelector('.section-search-search-taxi')
        setIsShowResultTaxi(viewResultTaxi.contains(event.target))
    })
})
function setIsShowResultTaxi(isShow)
{
    if(isShow)
    {
        document.querySelector('.dropdown-result-taxi').style.display = 'block'
    }
    else
    {
        document.querySelector('.dropdown-result-taxi').style.display = 'none'
    }
}
function loadResultTaxi(result)
{
    var viewListResultTaxi = document.querySelector('.list-result-taxi')
    
    var dataListTaxi = result.data
    viewListResultTaxi.innerHTML=`
    ${
        dataListTaxi.map(itemTaxi=>{
            return `
                <a href="/car/update-car/${itemTaxi.id}" class="item-result-taxi">
                    <i class="fa-solid fa-car"></i>
                    ${itemTaxi.vehicle_num}
                </a>
            `
        }).join('')
    }`
    
}
function requestSearchTaxi_byVehicleNumber(textVehicleNumber)
{
    var form = new FormData()
    form.append('textVehicleNumber',textVehicleNumber)
    $.ajax(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'/car/search-vehicle-number',
            type:'POST',
            data:form,
            processData: false,
            contentType: false, 
            success:function(result)
            {
                loadResultTaxi(result)
            }
        }
    )
}