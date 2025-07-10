<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Attendance;
use App\Models\ai;
use Illuminate\Support\Facades\Http;




Route::get('/', function () {
    return view('attendance.index');
    return view('welcome');
});
Route::get('/ai', function () {

    $response = Http::withHeaders([
        'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjA2OWZlZGJiLTk2ZDctNGU4MC1iMDA0LWFmZDZjMmU4YmZkZiIsImxhc3RfcGFzc3dvcmRfY2hhbmdlIjoxNzUwNjYwODczLCJleHAiOjE3NTQ3NTcxMDR9.qAQF8XDOU8NRz5vSiFlQfnrj8dhGhJ5uvJqjblQWmr8',
        'Cookie' => 'x-ap=eu-central-1; acw_tc=0a03e56c17521661095906021e3cacb270c127c80eb3a20489a465ab4beae1',
    ])->post('https://chat.qwen.ai/api/v2/chat/completions?chat_id=7ce2a60a-2b40-4ae8-8536-0cd346642de3', [
        'stream' => false,
        'incremental_output' => true,
        'chat_id' => '7ce2a60a-2b40-4ae8-8536-0cd346642de3',
        'chat_mode' => 'normal',
        'model' => 'qwen3-235b-a22b',
        'messages' => [
            [
                'role' => 'user',
                'content' => 'یه جمله انگیزشی بده که خاص، کوبنده و غیرکلیشه‌ای باشه. نه مثل بقیه.',
                'user_action' => 'chat',
                'files' => [],
                'timestamp' => 1752165316,
                'models' => ['qwen3-235b-a22b'],
                'chat_type' => 't2t',
                'feature_config' => [
                    'thinking_enabled' => false,
                    'output_schema' => 'phase'
                ],
                'extra' => [
                    'meta' => [
                        'subChatType' => 't2t'
                    ]
                ],
                'sub_chat_type' => 't2t',
                'parent_id' => 'df0a0c91-53d5-4a04-b5da-b8ac53d6d821'
            ]
        ],
        'timestamp' => 1752165316
    ]);
// Get the response
    $responseData = $response->json();
    $content = $responseData['data']['choices'][0]['message']['content'];
    $ai = new ai(); // Or use your correct namespace
    $ai->key = 'angizeh';    // Assuming you fixed 'kay' to 'key' in migration
    $ai->prompt = 'فقط یک جمله کوتاه انگیزشی بگو';
    $ai->response = $content;
    $ai->save();

    dd($ai);

});

Route::post('attendance/enter', function (Request $request) {
//    return $request;
    //    32.6504751, 51.6936045
    $user_identity = $request->input('name');
    setcookie('user_identity', $user_identity, time() + (60 * 60 * 24 * 365 * 5), "/");
    $userLat = $request->input('latitude');
    $userLng = $request->input('longitude');
    $officeLat = 32.6504751;
    $officeLng = 51.6936045;

    if (!$userLat || !$userLng) {
        return response()->json(['error' => 'مختصات دریافت نشد.'], 422);
    }
    $attendance = Attendance::where('user_identity', $user_identity)
        ->whereNull('exited_at')
        ->latest('entered_at')
        ->first();
    if ($attendance) {
        $attendance->exited_at = now();
        $attendance->exit_location = ['lat' => $userLat, 'lng' => $userLng];
        $attendance->ip_exit = $userLng;
        $attendance->distance_exit = $request->input('distance');
        $attendance->save();
        return redirect()->back()->with('message', [
            'color' => '#3b82f6',
            'text' => 'خروج با موفقیت ثبت شد.',
        ]);
    }
    else{
        $attendance = new Attendance();
        $attendance->user_id = 0;
        $attendance->user_identity = $user_identity ?? '';
        $attendance->distance = $request->input('distance');
        $attendance->ip_address = $request->ip();
        $attendance->entered_at = now();
        $attendance->entry_location = ['lat' => $userLat, 'lng' => $userLng];
        $attendance->office_location = ['lat' => $officeLat, 'lng' => $officeLng];
        $attendance->save();

        return redirect()->back()->with('message', [
            'color' => '#22c55e',
            'text' => 'ورود با موفقیت ثبت شد.',
        ]);
    }
});
