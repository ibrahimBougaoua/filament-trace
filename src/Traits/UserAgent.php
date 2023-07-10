<?php

namespace IbrahimBougaoua\FilamentTrace\Traits;

use Illuminate\Support\Facades\Http;
use Request;

trait UserAgent
{
    public static function getUserLocation()
    {
        $response = Http::get(config('filament-trace.geolocation.service').config('filament-trace.geolocation.key').'/'.Request::ip());

        return $response->json();
    }

    public static function getUserDeviceInfo()
    {
        $userAgent = request()->header('User-Agent');

        return $userAgent;
    }

    public static function getDeviceFromUserAgent()
    {
        $devices = config('filament-trace.devices');

        foreach ($devices as $keyword) {
            if (stripos(UserAgent::getUserDeviceInfo(), $keyword) !== false) {
                return 'Mobile';
            }
        }

        return 'Desktop';
    }

    public static function getSystemFromUserAgent()
    {
        $systems = config('filament-trace.systems');

        foreach ($systems as $system => $keyword) {
            if (stripos(UserAgent::getUserDeviceInfo(), $keyword) !== false) {
                return $system;
            }
        }

        return 'Unknown System';
    }

    public static function getBrowserFromUserAgent()
    {
        $browsers = config('filament-trace.browsers');

        foreach ($browsers as $browser => $keyword) {
            if (stripos(UserAgent::getUserDeviceInfo(), $keyword) !== false) {
                return $browser;
            }
        }

        return 'Unknown Browser';
    }
}
