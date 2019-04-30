<?php

namespace Resources\views\partials;
class WeatherPartial
{
    public static function show()
    {
        echo <<<EOL
<div id="weather">
    <div class="top">
        <div id="city"></div>
        <div>
            <img id="icon" src="#" alt="">
        </div>
        <p id="description"></p>
    </div>
    <div class="bottom">
        <div id="temp">
            <span id="value"></span>
            <span id="unit"></span>
        </div>
        <div id="up-container"><span id="up"></span>
            <i class="fas fa-arrow-up"></i>
        </div>
        <div id="down-container"><span id="down"></span>
            <i class="fas fa-arrow-down"></i>
        </div>
    </div>
</div>
EOL;

    }
}