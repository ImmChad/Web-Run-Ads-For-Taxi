package com.vku.run_ads_taxi

import android.content.Context
import android.content.Intent
import android.content.SharedPreferences
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.Button
import android.widget.EditText

class LoginActivity : AppCompatActivity() {
    lateinit var prefs:SharedPreferences
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        prefs = getSharedPreferences("com.vku.run_ads_taxi",Context.MODE_PRIVATE)
        if(prefs.getString("app-ID","").toString().trim().length==0)
        {
            setContentView(R.layout.activity_login)
            var btn_submit =findViewById<Button>(R.id.btn_submit)
            var edt_app_ID =findViewById<EditText>(R.id.edt_app_ID)
            btn_submit.setOnClickListener {
                finish()
                startActivity(Intent(applicationContext,MainActivity::class.java))
                prefs.edit().putString("app-ID",edt_app_ID.text.toString()).commit()
            }
        }
        else
        {
            finish()
            startActivity(Intent(applicationContext,MainActivity::class.java))
        }
    }
}