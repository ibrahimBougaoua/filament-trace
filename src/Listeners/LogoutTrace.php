<?php

namespace IbrahimBougaoua\FilamentTrace\Listeners;

use IbrahimBougaoua\FilamentTrace\Traits\UserAgent;
use Illuminate\Auth\Events\Logout;
use IbrahimBougaoua\FilamentTrace\Models\Logger;

class LogoutTrace
{
    public $location;

    public function __construct()
    {
        $this->location = UserAgent::getUserLocation();
    }

    public function handle(Logout $event)
    {
        Logger::create([
            "name" => $event->user->name,
            "country_code" => $this->location["country_code"],
            "country_name" => $this->location["country_name"],
            "city" => $this->location["city"],
            "postal" => $this->location["postal"],
            "latitude" => $this->location["latitude"],
            "longitude" => $this->location["longitude"],
            "IPv4" => $this->location["IPv4"],
            "state" => $this->location["state"],
            "browser" => UserAgent::getBrowserFromUserAgent(),
            "system" => UserAgent::getSystemFromUserAgent(),
            "device" => UserAgent::getDeviceFromUserAgent(),
            "action" => "Log Out",
        ]);
    }
}