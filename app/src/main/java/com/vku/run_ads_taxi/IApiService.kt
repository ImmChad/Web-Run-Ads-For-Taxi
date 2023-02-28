package com.vku.run_ads_taxi

import com.google.gson.GsonBuilder
import com.vku.run_ads_taxi.models.AdsMedia
import com.vku.run_ads_taxi.models.ResPost
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Retrofit
import retrofit2.converter.gson.GsonConverterFactory
import retrofit2.http.*
interface IApiService {
    companion object
    {
        val HOST_SERVER = "http://192.168.1.130:8000/"
        var gson = GsonBuilder().setDateFormat("yyyy-MM-dd HH:mm:ss").create()
        var apiService = Retrofit.Builder().baseUrl(HOST_SERVER)
            .addConverterFactory(GsonConverterFactory.create(gson))
            .build().create(IApiService::class.java)
    }
    @GET("api/view-ads-video/get-exist-video")
    fun getLatestMedia(
        @Query("app_id") app_id: String,
        @Query("video_md5_encrypt") video_md5_encrypt: String,
        @Query("photo_md5_encrypt") photo_md5_encrypt: String):Call<AdsMedia>
    @FormUrlEncoded
    @POST("api/view-ads-video/human-event")
    fun postHumanEvent(
        @Field("app_id") app_id: String,
        @Field("human_type") human_type: Int):Call<ResPost>
}