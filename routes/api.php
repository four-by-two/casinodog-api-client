<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Wainwright\CasinoDogOperatorApi\Controllers\CasinoDogCallbackController;
use Wainwright\CasinoDogOperatorApi\Controllers\CasinoDogCreateSessionController;
use Wainwright\CasinoDogOperatorApi\Controllers\APIController;
use Wainwright\CasinoDogOperatorApi\Models\OperatorGameslist;
use Wainwright\CasinoDogOperatorApi\Controllers\Playground\PlaygroundPages;
use Wainwright\CasinoDogOperatorApi\Controllers\Playground\ExampleRespinController;
use Wainwright\CasinoDogOperatorApi\Controllers\Playground\iFrameManager;

use Illuminate\Support\Facades\Http;

Route::middleware('api', 'throttle:20,1')->prefix('api/casino-dog-operator-api/')->group(function () {
        Route::get('/createSession', [CasinoDogCreateSessionController::class, 'test_create']);
});

Route::middleware('api', 'throttle:5000,1')->prefix('api/casino-dog-operator-api/')->group(function () {
    Route::get('/callback', [CasinoDogCallbackController::class, 'callback']);
});

Route::middleware('api', 'throttle:300,1')->prefix('api/data/')->group(function () {
    Route::get('/games', [APIController::class, 'games_all']);
});

Route::middleware('api', 'throttle:500,1')->prefix('api/')->group(function () {
    Route::get('/games', [APIController::class, 'games']);
	Route::get('/games/{slug}', [APIController::class, 'games_info']);
	Route::get('/tags', [APIController::class, 'tags']);
    Route::get('/categories', [APIController::class, 'categories']);
	Route::get('/play/{slug}', [APIController::class, 'play']);
	Route::any('settings', function (Request $request) {
		return '';
	});
	Route::any('shops', function (Request $request) {
		return '[]';
	});
});

Route::name('playground')->middleware('api', 'throttle:50,1')->prefix('api/playground/')->group(function () {
    Route::get('/', [PlaygroundPages::class, 'view_index']);
    Route::get('/gameslist', [PlaygroundPages::class, 'view_gameslist']);
    Route::get('/viewer', [PlaygroundPages::class, 'view_gameframe']);
    Route::get('/iframe.js', [iFrameManager::class, 'load']);
	//Route::get('/respin-viewer', [ExampleRespinController::class, 'show']);
	});

//Route::middleware('api', 'throttle:25,1')->post('api/playground/toggle_respin', [ExampleRespinController::class, 'toggle_respin']);
