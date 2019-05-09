<?php


namespace app\view\partials;


class WeatherPartial
{
    public static function show()
    {
        echo <<<EOL
<div id="weather" class="box"> 
    <div class="first">
        <div id="city"></div>
        <div>
            <img id="icon" src="#" alt="">
        </div>
        <p id="description"></p>
    </div>
    <div class="second">
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