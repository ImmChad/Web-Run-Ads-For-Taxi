var loop = 0
var id_timeOut;
localStorage.removeItem('app-ID');
window.addEventListener('load',(event)=>{

    var form = document.querySelector('form')
    form.addEventListener('submit',(event)=>{
        var app_id = form.querySelector('#ipt-app-id').value
        event.preventDefault()
        requestDataMediaAdsLatest_withAppID(app_id)
    })
    var btnPlay = document.querySelector('.btn-play')
    var btnMute = document.querySelector('.btn-mute')
    var btnSkipImage = document.querySelector('.btn-skip-image')


    requestDataMediaAdsLatest_withAppID(localStorage.getItem('app-ID'))
    loadBtnPlay(btnPlay)
    // loadBtnMuted(btnMute)
    loadBtnSkipImageBtn(btnSkipImage)
})

function isShowViewMedia(isShow)
{
    if(isShow)
    {
        document.querySelector('.media').style.display = "block"
    }
    else
    {
         document.querySelector('.media').style.display = "none"
    }
}

function isShowViewLogin(isShow)
{
    if(isShow)
    {
        document.querySelector('.login').style.display = "flex"
    }
    else
    {
         document.querySelector('.login').style.display = "none"
    }
}
function loadViewMedia(photo_path,video_path,change_time)
{

    var video = document.querySelector('video')
    var img = document.querySelector('img')
    var control = document.querySelector('.control');
    var btnSkipImage = document.querySelector('.btn-skip-image')
    img.src = photo_path
    video.src = video_path

    // video after 5 minute show image
    var num_loop = 1
    video.addEventListener('loadeddata',(event)=>{
        var minutes_length =event.currentTarget.duration/60
        if (minutes_length<1) {
            num_loop = 0
        }
        else if(minutes_length<2)
        {
            num_loop = 2
        }
        else if(minutes_length<3)
        {
            num_loop = 1
        }
    })


    video.addEventListener('ended',(event)=>{
        
        if(loop<num_loop)
        {
            loop++
            video.currentTime = 0
            video.play()
        }
        else
        {
            requestEventHuman(
                {app_id:localStorage.getItem('app-ID'),human_time:new Date().toLocaleString(),human_type:2}
            )
            img.style.display = "block"
            control.style.display= 'none'
            btnSkipImage.style.display="block";
            id_timeOut = setTimeout(()=>{
                skipImage()
            },change_time * 60* 1000)
            
        }

    })
    video.setAttribute('change-time',change_time)
}
function skipImage()
{
    var video = document.querySelector('video')
    var img = document.querySelector('img')
    var control = document.querySelector('.control');
    var btnSkipImage = document.querySelector('.btn-skip-image')
    btnSkipImage.style.display="none";
    img.style.display = "none"
    control.style.display= 'flex'
    video.play()
    loop = 0
    clearTimeout(id_timeOut);
    requestEventHuman(
        {app_id:localStorage.getItem('app-ID'),human_time:new Date().toLocaleString(),human_type:3}
    )
}
function requestDataMediaAdsLatest_withAppID(app_id)
{
    if(app_id && app_id.trim().length>0)
    {
        var xhr = new XMLHttpRequest()
        xhr.withCredentials = true;
        xhr.onreadystatechange = ()=>
        {
            if(xhr.readyState ==4 && xhr.status ==200)
            {
                var data = JSON.parse(xhr.responseText)
                loadViewMedia(data.photo.photo_path,data.video.video_path,data.change_time)
                isShowViewMedia(data.isLogin.trim().length>0)
                localStorage.setItem('app-ID',data.isLogin)
            }
        }
        xhr.open('GET',`/api/view-ads-video/get-exist-video?app_id=${app_id}`,false)
        xhr.send()
    }
    isShowViewLogin(!(app_id && app_id.trim().length>0))

    
}
function requestEventHuman(
    {
        app_id,
        human_type,
        human_time,
    }
)
{
    if(app_id.trim().length>0)
    {
        var form = new FormData()
        form.entries(

        )
        form.append('app_id',app_id)
        form.append('human_type',human_type)
        form.append('human_time',human_time)

        var xhr = new XMLHttpRequest()
        xhr.withCredentials = true;
        xhr.onreadystatechange = ()=>
        {
            if(xhr.readyState ==4 && xhr.status ==200)
            {
                var data = JSON.parse(xhr.responseText)
                console.log(data);
            }
        }
        xhr.open('POST',`http://localhost:8000/api/view-ads-video/human-event`,false)
        // xhr.setRequestHeader("Access-Control-Allow-Origin", "http://localhost:3000");
        xhr.send(form)
    }
    isShowViewLogin(!app_id.trim().length>0)

    
}
function loadBtnPlay(elementBtn)
{
    var video = document.querySelector('video')

    elementBtn.addEventListener('click',(event)=>{
        var isPaused= event.currentTarget.getAttribute('is-paused')
        if(isPaused==='true')
        {
            video.play()
            requestEventHuman(
                {app_id:localStorage.getItem('app-ID'),human_time:new Date().toLocaleString(),human_type:1}
            )
            event.currentTarget.setAttribute('is-paused',false)
        }
        else
        {
            requestEventHuman(
                {app_id:localStorage.getItem('app-ID'),human_time:new Date().toLocaleString(),human_type:0}
            )
            video.pause() 
            event.currentTarget.setAttribute('is-paused',true)
        }

    })
}
function loadBtnSkipImageBtn(elementBtn)
{
    
    elementBtn.addEventListener('click',(event)=>{
        skipImage();
    })
}
// function loadBtnMuted(elementBtn)
// {
//     var video = document.querySelector('video')
//     elementBtn.addEventListener('click',(event)=>{
//         var isMuted = event.currentTarget.getAttribute('is-muted')
//         if(isMuted ==='true')
//         {
//             video.muted =false 
//             event.currentTarget.setAttribute('is-muted',false)
//         }
//         else
//         {
//             video.muted =true  
//             event.currentTarget.setAttribute('is-muted',true)
//         }

//     })
// }
    