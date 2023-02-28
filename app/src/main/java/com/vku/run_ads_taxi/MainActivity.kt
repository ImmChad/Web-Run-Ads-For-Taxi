package com.vku.run_ads_taxi

import android.annotation.SuppressLint
import android.app.DownloadManager
import android.content.*
import android.content.pm.ActivityInfo
import android.content.pm.PackageManager
import android.graphics.BitmapFactory
import android.media.MediaPlayer
import android.net.*
import android.net.ConnectivityManager.NetworkCallback
import android.os.*
import android.view.View
import android.widget.*
import androidx.appcompat.app.AppCompatActivity
import com.google.android.material.color.utilities.Score.score
import com.google.gson.Gson
import com.google.gson.reflect.TypeToken
import com.vku.run_ads_taxi.models.AdsMedia
import com.vku.run_ads_taxi.models.AdsPhoto
import com.vku.run_ads_taxi.models.AdsVideo
import com.vku.run_ads_taxi.models.ResPost
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response
import java.io.File
import java.util.*
import java.util.concurrent.TimeUnit


class MainActivity : AppCompatActivity() {
    val KEY_PREF_LIST_VIEW_ADS_VIDEO = "listViewAdsVideo"
    val KEY_PREF_APP_ID = "app-ID"
    val KEY_PREF_CHANGE_TIME = "change_time"
    val KEY_PREF_NAME_VIDEO = "name_video"
    val KEY_PREF_NAME_PHOTO = "name_"
    val KEY_PREF_PHOTO_MD5_ENCRYPT = "photo_md5_encrypt"
    val KEY_PREF_VIDEO_MD5_ENCRYPT = "video_md5_encrypt"
    val ONLY_SHOW_VIDEO = "only_show_video"
    val ONLY_SHOW_PHOTO = "only_show_photo"
    val ONLY_SHOW_LOADING = "only_show_loading"
    val KEY_INTENT_CHECKED_LATEST_ADS_MEDIA= "checked_latest_ads_media"
    val REQUEST_PERMISSION_CODE = 79
    //    Check Network change state
    val networkCallback: NetworkCallback = object : NetworkCallback() {
        override fun onAvailable(network: Network) {
            var manager =
                applicationContext?.getSystemService(Context.CONNECTIVITY_SERVICE) as ConnectivityManager
            if(Utils.isConnectedInternet(applicationContext,network))
            {
                mainCheckStorageAdsMedia()
            }
        }
        override fun onLost(network: Network) {
            // network unavailable
        }
    }
    val eventDownloaded = object :BroadcastReceiver(){
        @SuppressLint("Range")
        override fun onReceive(context: Context?, intent: Intent?) {
            if(intent != null && context != null)
            {
                var action = intent.action
                if(action.equals(DownloadManager.ACTION_DOWNLOAD_COMPLETE))
                {
                    var query = DownloadManager.Query()
                    query.setFilterById(intent.getLongExtra(DownloadManager.EXTRA_DOWNLOAD_ID,0))
                    var manager = context.getSystemService(Context.DOWNLOAD_SERVICE) as DownloadManager
                    var cursor = manager.query(query)
                    if(cursor.moveToFirst())
                    {
                        if(cursor.count>0)
                        {
                            var status = cursor.getInt(cursor.getColumnIndex(DownloadManager.COLUMN_STATUS))
                            if(status == DownloadManager.STATUS_SUCCESSFUL)
                            {
                                getAdsVideoDir()?.listFiles()?.forEach { file ->
                                    if(file.exists() &&  listAdsVideoDownloading.any{
                                        adsVideo: AdsVideo ->  file.name != adsVideo.video_path.split("/").last()
                                        })
                                    {
                                        file.delete()
                                    }
                                }

                                finish()
                                var intent = Intent(applicationContext,MainActivity::class.java)
                                intent.putExtra(KEY_INTENT_CHECKED_LATEST_ADS_MEDIA,true)
                                startActivity(intent)
                            }
                            else
                            {

                            }
                        }
                    }

                }
            }
        }

        override fun peekService(myContext: Context?, service: Intent?): IBinder {
            return super.peekService(myContext, service)
        }
    }

    var listAdsVideoDownloading = mutableListOf<AdsVideo>()
    var listAdsPhotoDownloading = mutableListOf<AdsPhoto>()
    var loopVideo = 0;
    var isMuted = false
    lateinit var videoView: VideoView
    lateinit var prefs: SharedPreferences
    lateinit var adsMedia:AdsMedia
    lateinit var adsVideoActiviting: AdsVideo

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)
        prefs = getSharedPreferences("com.vku.run_ads_taxi", Context.MODE_PRIVATE)
//        initPrefsListViewAdsVideo()
        initVideoView()
        requestedOrientation = ActivityInfo.SCREEN_ORIENTATION_LANDSCAPE
    }
    override fun onResume() {
        super.onResume()
        registerReceiver(eventDownloaded, IntentFilter(DownloadManager.ACTION_DOWNLOAD_COMPLETE))
//        register NetworkCallback with OS
        val connectivityManager =
            application.getSystemService(CONNECTIVITY_SERVICE) as ConnectivityManager

        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.N) {
            connectivityManager.registerDefaultNetworkCallback(networkCallback)
        } else {
            val request = NetworkRequest.Builder()
                .addCapability(NetworkCapabilities.NET_CAPABILITY_INTERNET).build()
            connectivityManager.registerNetworkCallback(request, networkCallback)
        }
    }

    override fun onPause() {
        super.onPause()
        unregisterReceiver(eventDownloaded)
    }
    fun loadShow_with_OptionView(option:String)
    {
        var container_video = findViewById<RelativeLayout>(R.id.container_video)
        var container_photo = findViewById<RelativeLayout>(R.id.container_photo)
        var container_loading = findViewById<LinearLayout>(R.id.container_loading)
        when(option)
        {
            ONLY_SHOW_LOADING->{
                container_video.visibility = View.GONE
                container_loading.visibility = View.VISIBLE
                container_photo.visibility = View.GONE
            }
            ONLY_SHOW_PHOTO->{
                container_video.visibility = View.GONE
                container_loading.visibility = View.GONE
                container_photo.visibility = View.VISIBLE
            }
            ONLY_SHOW_VIDEO->{
                container_video.visibility = View.VISIBLE
                container_loading.visibility = View.GONE
                container_photo.visibility = View.GONE
            }
        }
    }
    fun getLoopValid_withDurationVideo(duration:Long):Int
    {
        if(TimeUnit.MILLISECONDS.toMinutes(duration)<=1)
            return 0
        if(TimeUnit.MILLISECONDS.toMinutes(duration)<=2)
            return 2
        if(TimeUnit.MILLISECONDS.toMinutes(duration)<=3)
            return 1
        else
            return 0
    }
    fun initVideoView() {
        this.videoView = findViewById<VideoView>(R.id.video_view)
        val loopMax = getLoopValid_withDurationVideo(videoView.duration.toLong())
        var fileVideos = getAdsVideoDir()?.listFiles()

        if(fileVideos != null && fileVideos!!.size>0)
        {

                    this.videoView.setVideoURI(Uri.fromFile(fileVideos.last()))


            this.videoView.setOnPreparedListener {
                loadShow_with_OptionView(ONLY_SHOW_VIDEO)
                initControlVideo(it)
                videoView.setOnCompletionListener {

                    if(loopVideo<loopMax)
                    {
                        it.start()
                        loopVideo++
                    }else
                    {
                        var ads_photo = findViewById<ImageView>(R.id.ads_photo);
                        var photoDir = getAdsPhotoDir()?.listFiles()
                        var btn_control = findViewById<ImageButton>(R.id.btn_control)
                        var change_time = prefs.getInt(KEY_PREF_CHANGE_TIME,0)
                        var btn_skip_photo = findViewById<Button>(R.id.btn_skip_photo)
                        var run_after_change_time = object :Runnable{
                            override fun run() {
                                videoView.start()
                                loadShow_with_OptionView(ONLY_SHOW_VIDEO)
                                requestPostHumanEvent(3)
                            }
                        }
                        var handler = Handler(Looper.getMainLooper())
                        handler.postDelayed(
                            run_after_change_time,15*1000
                        )

                        loadShow_with_OptionView(ONLY_SHOW_PHOTO)
                        it.pause()

                        ads_photo.setImageBitmap(BitmapFactory.decodeFile(photoDir?.last()?.absolutePath))
                        requestPostHumanEvent(2)
                        btn_skip_photo.setOnClickListener {
                            handleClickBtnSkipPhoto(handler,btn_control)
                        }

                        loopVideo = 0
                    }

                }
            }
        }
        else
        {
            loadShow_with_OptionView(ONLY_SHOW_LOADING)
        }

    }
    fun initControlVideo(mediaPlayer:MediaPlayer) {
        var seekbar_video_view = findViewById<SeekBar>(R.id.seekbar_video_view)
        if(this.videoView != null)
        {
            seekbar_video_view.max = this.videoView.duration
            Handler(Looper.getMainLooper()).postDelayed(
                {
                    object : Runnable {
                        override fun run() {
                            seekbar_video_view.setProgress(videoView.currentPosition)
                            Handler(Looper.getMainLooper()).postDelayed(
                                this, 500
                            )
                        }
                    }.run()
                }, 100
            )

            var btn_control = findViewById<ImageButton>(R.id.btn_control)
            btn_control.setOnClickListener {
                if (videoView.isPlaying) {
                    handleClickBtnPause(btn_control)
                } else {
                    handleClickBtnPlay(btn_control)
                }
            }
            var btn_volume = findViewById<ImageButton>(R.id.btn_volume)
            btn_volume.setOnClickListener {
                if(!isMuted)
                {
                    mediaPlayer.setVolume(0.toFloat(),0.toFloat())
                    btn_volume.setImageResource(R.drawable.baseline_volume_off_24)
                }
                else
                {
                    mediaPlayer.setVolume(100.toFloat(),100.toFloat())
                    btn_volume.setImageResource(R.drawable.baseline_volume_up_24)
                }
                isMuted = !isMuted

            }
        }

    }
    fun initPrefsListViewAdsVideo() {
        var strInitJsonEnCode = Gson().toJson(mutableListOf<AdsMedia>()).toString()
        if (prefs.getString(
                this.KEY_PREF_LIST_VIEW_ADS_VIDEO,
                strInitJsonEnCode
            ) == strInitJsonEnCode
        ) {
            prefs.edit().putString(this.KEY_PREF_LIST_VIEW_ADS_VIDEO, strInitJsonEnCode).commit()
        }
    }
    fun addPrefsListViewAdsVideo(viewAdsVideo: AdsMedia) {
        var listViewAdsVideo = getPrefsListViewAdsVideo()
        listViewAdsVideo.add(viewAdsVideo)
        setPrefsListViewAdsVideo(listViewAdsVideo)
    }

    fun getPrefsListViewAdsVideo(): MutableList<AdsMedia> {
        var str_jsonencode = prefs.getString(this.KEY_PREF_LIST_VIEW_ADS_VIDEO, "")
        var type = object : TypeToken<MutableList<AdsMedia>>() {}.type
        var listViewAdsVideo = Gson().fromJson<MutableList<AdsMedia>>(str_jsonencode, type)
        return listViewAdsVideo
    }

    fun setPrefsListViewAdsVideo(listViewAdsVideo: MutableList<AdsMedia>) {

        prefs.edit().putString(this.KEY_PREF_LIST_VIEW_ADS_VIDEO, Gson().toJson(listViewAdsVideo))
            .commit()

    }


    fun handleClickBtnSkipPhoto(handler:Handler,btn_control: ImageButton)
    {
        loadShow_with_OptionView(ONLY_SHOW_VIDEO)
        requestPostHumanEvent(3)
        handleClickBtnPause(btn_control)

//          clear set time out
        handler.removeCallbacksAndMessages(null)

    }
    fun handleClickBtnPlay(btn_control: ImageButton) {
//        addPrefsListViewAdsVideo(AdsMedia(0, 1, 3, strDateNow))
        videoView.start()
        requestPostHumanEvent(1)
        btn_control.setImageResource(R.drawable.baseline_pause_circle_24)
    }

    fun handleClickBtnPause(btn_control: ImageButton) {
        videoView.pause()
        requestDataLatestMedia()
        requestPostHumanEvent(0)

        btn_control.setImageResource(R.drawable.baseline_play_circle_24)
    }
    fun requestPostHumanEvent(human_type:Int)
    {
        IApiService.apiService.postHumanEvent(
            prefs.getString(KEY_PREF_APP_ID,"").toString()
            , human_type).enqueue(object :Callback<ResPost>{
            override fun onResponse(call: Call<ResPost>, response: Response<ResPost>) {
                var resPost = response.body()
            }

            override fun onFailure(call: Call<ResPost>, t: Throwable) {
                println("API FAIL postHumanEvent()")
            }
        })
    }





    fun checkPermission(): Boolean {
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
            if (checkSelfPermission(android.Manifest.permission.WRITE_EXTERNAL_STORAGE) == PackageManager.PERMISSION_DENIED) {
                return false
            }
            return true
        }
        return true
    }

    fun requestDataLatestMedia()
    {

        if(!intent.getBooleanExtra(KEY_INTENT_CHECKED_LATEST_ADS_MEDIA,false))
        {
            Handler(Looper.getMainLooper()).post {
                loadShow_with_OptionView(ONLY_SHOW_LOADING)
            }

            IApiService.apiService.getLatestMedia(
                prefs.getString(KEY_PREF_APP_ID,"").toString()
                ,prefs.getString(KEY_PREF_VIDEO_MD5_ENCRYPT,"").toString()
                ,prefs.getString(KEY_PREF_PHOTO_MD5_ENCRYPT,"").toString()
            ).enqueue(
                object :Callback<AdsMedia>{
                    override fun onResponse(call: Call<AdsMedia>, response: Response<AdsMedia>) {
                        var adsMedia = response.body()
                        if(adsMedia != null)
                        {
                            if(adsMedia.isLogin != null)
                            {
                                prefs.edit().putInt(KEY_PREF_CHANGE_TIME,adsMedia.change_time).commit()
//                            get media from API
                                var listAdsVideoDownload = listOf(adsMedia.video)
                                var listAdsPhotoDownload = listOf(adsMedia.photo)
//                            get media from device
                                var listFileAdsVideo = getAdsVideoDir()?.listFiles()
                                var listFileAdsPhoto = getAdsPhotoDir()?.listFiles()

                                if (listFileAdsVideo == null) {
                                    downloadVideos(listAdsVideoDownload)
                                } else {
                                    listAdsVideoDownload=filterVideoExistedDevice_Downloading(listFileAdsVideo,listAdsVideoDownload)
                                }
                                if (listFileAdsPhoto == null) {
                                    downloadPhotos(listAdsPhotoDownload)
                                } else {
                                    listAdsPhotoDownload=filterPhotoExistedDevice_Downloading(listFileAdsPhoto,listAdsPhotoDownload)
                                }
                                downloadVideos(listAdsVideoDownload)
                                downloadPhotos(listAdsPhotoDownload)
                                if(listAdsVideoDownloading.size>0 || listAdsPhotoDownload.size>0)
                                {
                                    loadShow_with_OptionView(ONLY_SHOW_LOADING)
                                    var txv_title_loading = findViewById<TextView>(R.id.txv_title_loading)
                                    txv_title_loading.text = "Downloading Ads Media "
                                    loadShow_with_OptionView(ONLY_SHOW_LOADING)
                                }
                                else
                                {
                                    loadShow_with_OptionView(ONLY_SHOW_VIDEO)
                                }
                            }
                            else
                            {
                                startActivity(Intent(applicationContext,LoginActivity::class.java))
                                prefs.edit().putString("app-ID","").commit()
                                finish()
                            }

                        }
                    }
                    override fun onFailure(call: Call<AdsMedia>, t: Throwable) {
                        requestDataLatestMedia()
                    }
                }
            )
        }
        else
        {
            intent.removeExtra(KEY_INTENT_CHECKED_LATEST_ADS_MEDIA)
            loadShow_with_OptionView(ONLY_SHOW_VIDEO)
        }
    }
    fun filterVideoExistedDevice_Downloading(listVideoDevice: Array<File>, listAdsVideoDownload:List<AdsVideo>):List<AdsVideo>
    {
        var listAdsVideoDownload = listAdsVideoDownload
        if (listVideoDevice.size > 0) {
            listVideoDevice.forEach { fileVideo ->
                if(listAdsVideoDownloading.any { adsVideo: AdsVideo ->
                        var nameVideo = adsVideo.video_path.split("/").toTypedArray().last().toString()
                        if(fileVideo.name == nameVideo )
                        {
                            listAdsVideoDownloading.remove(adsVideo)
                        }
                        return@any fileVideo.name == nameVideo  })
                {

                }
                listAdsVideoDownload =
                    listAdsVideoDownload.filter{ adsVideo: AdsVideo ->
                        var nameVideo= adsVideo.video_path.split("/").toTypedArray().last().toString()

                        return@filter nameVideo!= fileVideo.name
                    }
            }
        }
        return  listAdsVideoDownload
    }
    fun filterPhotoExistedDevice_Downloading(listPhotoDevice:Array<File>,listAdsPhotoDownload:List<AdsPhoto>):List<AdsPhoto>
    {
        var listAdsPhotoDownload = listAdsPhotoDownload
        if (listPhotoDevice.size > 0) {
            listPhotoDevice.forEach { photo ->
                if(listAdsPhotoDownloading.any { adsPhoto: AdsPhoto ->
                        var namePhoto = adsPhoto.photo_path.split("/").toTypedArray().last().toString()
                        if(photo.name == namePhoto )
                        {
                            listAdsPhotoDownloading.remove(adsPhoto)
                        }
                        return@any photo.name == namePhoto  })
                {

                }
                listAdsPhotoDownload =
                    listAdsPhotoDownload.filter{ adsPhoto: AdsPhoto ->
                        var namePhoto = adsPhoto.photo_path.split("/").toTypedArray().last().toString()
                        return@filter namePhoto!= photo.name
                    }
            }
        }
        return listAdsPhotoDownload
    }

    override fun onRequestPermissionsResult(
        requestCode: Int,
        permissions: Array<out String>,
        grantResults: IntArray
    ) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults)
        if (requestCode == REQUEST_PERMISSION_CODE) {
            if (grantResults.size > 0 && grantResults[0] == PackageManager.PERMISSION_GRANTED) {
                requestDataLatestMedia()
            } else {

            }
        }
    }



    fun mainCheckStorageAdsMedia() {
        if (checkPermission()) {
            requestDataLatestMedia()
        } else {
            requestPermissions(
                arrayOf(android.Manifest.permission.WRITE_EXTERNAL_STORAGE),
                REQUEST_PERMISSION_CODE
            )

        }
    }

    fun getAdsVideoDir(): File? {
        var downloadDir =
            applicationContext.getExternalFilesDirs(Environment.DIRECTORY_DOWNLOADS)[0].listFiles()
                .filter { file: File? -> file?.name == "ads-videos" && file.isDirectory }

        if (downloadDir.size == 1) {
            var videoDir = downloadDir[0]
            if (videoDir.exists()) {
                return videoDir
            }
        }
        return null
    }

    fun getAdsPhotoDir(): File? {
        var downloadDir =
            applicationContext.getExternalFilesDirs(Environment.DIRECTORY_DOWNLOADS)[0].listFiles()
                .filter { file: File? -> file?.name == "ads-photos" && file.isDirectory }

        if (downloadDir.size == 1) {
            var photoDir = downloadDir[0]
            if (photoDir.exists()) {
                return photoDir
            }
        }
        return null
    }

    fun startDownloadVideo(url: String = "", nameVideo: String = ".mp4") {
        var nameVideo = url.split("/").toTypedArray().last().toString()
        var request = DownloadManager.Request(Uri.parse(url))
        request.setAllowedNetworkTypes(DownloadManager.Request.NETWORK_WIFI or DownloadManager.Request.NETWORK_MOBILE)
        request.setDestinationInExternalFilesDir(
            applicationContext,
            Environment.DIRECTORY_DOWNLOADS,
            "ads-videos/${nameVideo}"
        )
        request.setTitle("Download Videos Ads")
        var downloadManager = getSystemService(Context.DOWNLOAD_SERVICE) as DownloadManager
        if (downloadManager != null) {
            downloadManager.enqueue(request)
        }

    }
    fun startDownloadPhoto(url: String = "", namePhoto: String = ".png") {
        var namePhoto = url.split("/").toTypedArray().last().toString()
        var request = DownloadManager.Request(Uri.parse(url))
        request.setAllowedNetworkTypes(DownloadManager.Request.NETWORK_WIFI or DownloadManager.Request.NETWORK_MOBILE)
        request.setDestinationInExternalFilesDir(
            applicationContext,
            Environment.DIRECTORY_DOWNLOADS,
            "ads-photos/${namePhoto}"
        )
        request.setTitle("Download Photo Ads")
        var downloadManager = getSystemService(Context.DOWNLOAD_SERVICE) as DownloadManager
        if (downloadManager != null) {
            downloadManager.enqueue(request)
        }

    }

    fun downloadVideos(adsVideos: List<AdsVideo>) {
        adsVideos.forEach { adsVideo: AdsVideo ->

            if(listAdsVideoDownloading.indexOf(adsVideo)<0)
            {
                listAdsVideoDownloading.add(adsVideo)
                startDownloadVideo("${IApiService.HOST_SERVER}${adsVideo.video_path}", adsVideo.video_name)
            }

        }

    }

    fun downloadPhotos(adsPhotos: List<AdsPhoto>) {
        adsPhotos.forEach { adsPhoto: AdsPhoto ->

            if(listAdsPhotoDownloading.indexOf(adsPhoto)<0)
            {
                listAdsPhotoDownloading.add(adsPhoto)
                startDownloadPhoto("${IApiService.HOST_SERVER}${adsPhoto.photo_path}", adsPhoto.photo_name)
            }

        }

    }

}