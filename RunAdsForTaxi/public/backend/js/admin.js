// Toggle the side navigation
window.addEventListener('load',(event)=>{

    


    loadSelectField()
})
function loadSelectField()
{
var viewSelectFields = document.querySelectorAll('.select-update-field')
viewSelectFields.forEach(viewSelectField=>{

    document.addEventListener('click',(event)=>{
        showDropdownSelect(viewSelectField.contains(event.target) && !event.target.classList.contains('item-select-update-field'),viewSelectField.querySelector('.drop-list-select') )
    })

    var valueSelectedField = viewSelectField.querySelector('.value-select-update-field')
    viewSelectField.querySelector('.value-select-update-field').addEventListener('click',(event)=>
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
$("#sidenavToggler").click(function(e) {
e.preventDefault();
$("body").toggleClass("sidenav-toggled");
$(".navbar-sidenav .nav-link-collapse").addClass("collapsed");
$(".navbar-sidenav .sidenav-second-level, .navbar-sidenav .sidenav-third-level").removeClass("show");
});


// pagination notification
let clickProfileAdmin = document.querySelector('.click-profile-admin');
clickProfileAdmin.addEventListener('click', (e) => {
window.location.href = "/update-profile-admin";
});
















function displayToast(mess) {
document.querySelector('.toast .text.text-2').textContent = mess;
document.querySelector('.toast').classList.add('active');
document.querySelector('.progress').classList.add('active');


let time = setTimeout(() => {
    document.querySelector('.toast').classList.remove("active");
    document.querySelector('.progress').classList.remove("active");
}, 5000); //1s = 1000 milliseconds

document.querySelector(".toast .close").addEventListener("click", () => {
    document.querySelector('.toast').classList.remove("active");
    
    setTimeout(() => {
        document.querySelector('.progress').classList.remove("active");
    }, 300);

    clearTimeout(time);
});
}