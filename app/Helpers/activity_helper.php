<?php

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

function activityAdmin($activity, $model = null, $model_id = null)
{
    if (Auth::check()) {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'activity' => $activity,
            'model' => $model,
            'model_id' => $model_id,
            'activity_time' => Carbon::now() // simpan jam realtime
        ]);
    }
}
