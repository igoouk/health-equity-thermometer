<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserSessionController;
use App\Http\Controllers\VerificationMailController;
use App\Models\Question;
use App\Models\Country;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

require __DIR__.'/auth.php';
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	session(['user-id' => null]);
	session(['current-level' => null]);
	session(['selected-options' => null]);
	session(['quiz-completed' => null]);
	session(["demographics-saved" => null]);
    return view('pages/welcome');
})->name("home");
Route::get('/no-access', function () {
    return view('pages/no-access');
})->name("no-access");
Route::middleware('verifiedUser')->middleware('isOnCorrectLevel')->get('/quiz/{level}', function (Request $request, $level) {
	return view('pages/quiz', ['questions' => Question::getQuestion($level), 'currentLevel' => $level]);   
})->name("quiz");

Route::middleware('verifiedUser')->middleware('validateUserResult')->get('/result/{resultID?}', function (Request $request, $resultID = null) {
    return view('pages/result',['result' => ResultController::getLatestResultPerUser($resultID), 'userSession' => UserSessionController::getLatestUserSession()]);
})->name("result");

Route::middleware('verifiedUser')->get('/welcome-back', function () {
    return view('pages/welcome-back');
})->name("welcome-back");

Route::middleware('verifiedUser')->middleware('validateUserResult')->get('/previous-results', function () {
    return view('pages/previous-results',['previousResults' => ResultController::getPreviousResults()]);
})->name("previous-results");



Route::middleware('verifiedUser')->middleware('hasTestStarted')->get('/demographics', function () {
	session(['selected-options' => null]);
	session(['quiz-completed' => null]);
    return view('pages/demographics', ['countries' => Country::all(), 'resultCount' => ResultController::getResultCount()]);
})->name("demographics");
//TEST})->name("demographics");


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::post('send-code', [VerificationMailController::class, 'sendCode']);
Route::post('verify-code', [VerificationMailController::class, 'verifyCode']);
Route::post('check-answer', [QuestionController::class, 'checkAnswer']);
Route::post('get-states', [StateController::class, 'getStates']);
Route::post('save-demographics', [UserController::class, 'saveDemographics']);
Route::post('use-previous-demographics', [UserController::class, 'usePreviousDemographics']);



Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

//Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
		Route::get('icons', ['as' => 'pages.icons', 'uses' => 'App\Http\Controllers\PageController@icons']);
		Route::get('maps', ['as' => 'pages.maps', 'uses' => 'App\Http\Controllers\PageController@maps']);
		Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'App\Http\Controllers\PageController@notifications']);
		Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'App\Http\Controllers\PageController@rtl']);
		Route::get('tables', ['as' => 'pages.tables', 'uses' => 'App\Http\Controllers\PageController@tables']);
		Route::get('typography', ['as' => 'pages.typography', 'uses' => 'App\Http\Controllers\PageController@typography']);
		Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'App\Http\Controllers\PageController@upgrade']);
		Route::get('userlist', ['as' => 'pages.user-list', 'uses' => 'App\Http\Controllers\PageController@userlist']);
		Route::get('userdetail/{id}', ['as' => 'pages.user-detail', 'uses' => 'App\Http\Controllers\PageController@userdetail']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

