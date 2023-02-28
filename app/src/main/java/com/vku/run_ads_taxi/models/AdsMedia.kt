package com.vku.run_ads_taxi.models

class AdsMedia {
    var change_time = 0
    lateinit var video:AdsVideo
    lateinit var photo: AdsPhoto
    var isLogin = ""
    constructor(change_time: Int, video: AdsVideo, photo: AdsPhoto,isLogin:String) {
        this.change_time = change_time
        this.video = video
        this.photo = photo
        this.isLogin = isLogin
    }
}