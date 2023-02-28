package com.vku.run_ads_taxi

import android.content.Context
import android.net.ConnectivityManager
import android.net.Network
import android.net.NetworkCapabilities

class Utils {
    companion object
    {
        fun isConnectedInternet(context: Context):Boolean
        {
            var manager = context.getSystemService(Context.CONNECTIVITY_SERVICE) as ConnectivityManager
            var network = manager.activeNetwork
            if (network != null) {
                var networkCapabilities = manager.getNetworkCapabilities(network)
                if (
                    networkCapabilities != null && networkCapabilities.hasTransport(
                        NetworkCapabilities.TRANSPORT_CELLULAR
                    )
                ) {
                    return true
                } else if (networkCapabilities != null && networkCapabilities.hasTransport(
                        NetworkCapabilities.TRANSPORT_WIFI
                    )
                ) {
                    return true
                }
            }
            return false
        }
        fun isConnectedInternet(context: Context,network: Network):Boolean
        {
            var manager = context.getSystemService(Context.CONNECTIVITY_SERVICE) as ConnectivityManager
            if (network != null) {
                var networkCapabilities = manager.getNetworkCapabilities(network)
                if (
                    networkCapabilities != null && networkCapabilities.hasTransport(
                        NetworkCapabilities.TRANSPORT_CELLULAR
                    )
                ) {
                    return true
                } else if (networkCapabilities != null && networkCapabilities.hasTransport(
                        NetworkCapabilities.TRANSPORT_WIFI
                    )
                ) {
                    return true
                }
            }
            return false
        }
    }

}