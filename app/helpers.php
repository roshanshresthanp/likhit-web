<?php

use App\Models\Setting;

function settingInfo($column)
{   
        return Setting::find(1)->$column;
}
