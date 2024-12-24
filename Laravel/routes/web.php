<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\MazeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UtilityController;
use App\Http\Controllers\DiabetesController;
use App\Http\Controllers\GuessGameController;
use App\Http\Controllers\TicTacToeController;
use App\Http\Controllers\SpamDetectionController;
use App\Http\Controllers\EcommerceDetectionController;
Route::get('/contact', [ContactController::class, 'showForm']);
Route::post('/send-email', [ContactController::class, 'sendEmail'])->name('send.email');

Route::get('/', function () {
    return view('welcome');
});



Route::get('checkout', [PaymentController::class, 'processPayment'])->name('check');


Route::get('/checkoutt', [PaymentController::class, 'checkout'])->name('checkout');
Route::post('/checkout/process', [PaymentController::class, 'processPayment'])->name('checkout.process');
Route::get('/payment/success', function () {
    return view('success');
})->name('checkout.success');
Route::get('/payment/failed', function () {
    return view('payment-failed');
})->name('checkout.cancel');
Route::get('checkout-success', [PaymentController::class, 'success'])->name('checkout.success');
Route::get('checkout-cancel', [PaymentController::class, 'cancel'])->name('checkout.cancel');

Route::get('kareem',function(){
    return view('predict');
});
Route::post('/predict', [DiabetesController::class, 'predict'])->name('diabetes.predict');


///////////////////////   Model_based {{ guess_game }}  /////////////////////////////////////


Route::get('/guess_game', [GameController::class, 'startGame'])->name('game.start');
Route::post('/game/guess', [GameController::class, 'makeGuess'])->name('game.guess');


//////////////////////////////////////////  simple  {{  tic-tac-toe  }}   ////////////////////////////////////////


Route::get('/tic-tac-toe', [TicTacToeController::class, 'index'])->name('tic-tac-toe.index');
Route::post('/tic-tac-toe/move', [TicTacToeController::class, 'makeMove'])->name('tic-tac-toe.move');

//////////////////////////////////////////  GoalBased  {{  Maze  }}   ////////////////////////////////////////


Route::get('/maze', [MazeController::class, 'showMaze']);
Route::post('/move', [MazeController::class, 'movePlayer']);
Route::post('/restart', [MazeController::class, 'restartGame']);  // إعادة التشغيل


//////////////////////////////////////////  UtilityBased     ////////////////////////////////////////


Route::get('/utility', [UtilityController::class, 'getGameState']);
Route::post('/utility_move', [UtilityController::class, 'moveAgent']);



//////////////////////////   SpamDetectionController   /////////////////////

Route::get('/spam-detection', [SpamDetectionController::class, 'showForm'])->name('spam-detection');
Route::post('/spam-detection', [SpamDetectionController::class, 'detectSpam'])->name('detect-spam');


////////////////////////       EcommerceDetectionController              ///////////////////////////  ///////////

Route::get('/ecommerce-detection', function () {
    return view('ecommerce.ecommerce_detection');  // لعرض النموذج
});

Route::post('/detect-spam', [EcommerceDetectionController::class, 'detectSpam'])->name('detect-ecommerce');

