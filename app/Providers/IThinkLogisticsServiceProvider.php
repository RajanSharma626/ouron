<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class IThinkLogisticsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
   public function register()
    {
        // Bind the logistics service to the app container
        $this->app->singleton('IThinkLogistics', function () {
            return new class {
                protected $apiUrl = "https://api.ithinklogistics.com/api_v3/charges";
                protected $apiKey = "YOUR_API_KEY"; // Replace with actual API Key

                public function getDeliveryCharges($pincode, $weight, $cod = false)
                {
                    $response = Http::post($this->apiUrl, [
                        'api_key'          => $this->apiKey,
                        'pickup_pincode'   => "SOURCE_PINCODE", // Your warehouse location
                        'delivery_pincode' => $pincode,
                        'weight'           => $weight, // Weight in grams
                        'cod'              => $cod ? 1 : 0, // 1 for COD, 0 for Prepaid
                    ]);

                    return $response->successful() ? $response->json() : null;
                }
            };
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
