<?php

use App\Http\Controllers\PrintController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Models\MovementStudent;
use App\Models\Student;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Hash;

Route::get('/', [WebController::class, 'viewLogin'])->name('login')->middleware('guest');
Route::post('/', [WebController::class, 'auth'])->name('authenticate');

Route::get('/register', [WebController::class, 'viewRegister'])->name('register');
Route::post('/register', [WebController::class, 'register'])->name('registerPost');
Route::post('/verify/email', [WebController::class, 'verifyEmail'])->name('verifyEmail');



//Routas de Pre escricao
Route::get('/user/registration', [WebController::class, 'viewForm'])->name('registration')->middleware(['auth']);
//Rota que lista faculdades
Route::post('/user/registration/faculties', [WebController::class, 'faculties'])->middleware(['auth']);
//Rota que lista os cursos
Route::post('/user/registration/courses', [WebController::class, 'courses'])->middleware(['auth']);
//Rota de Linhas de pesguisa
Route::post('/user/registration/sewing-lines', [WebController::class, 'sewingLines'])->middleware(['auth']);


//Rotas para acessar distritos dos enderecos
Route::post('/address/districts', [WebController::class, 'districts'])->middleware(['auth']);


//Rota para criar uma inscricao
Route::post('/user/student/registration', [WebController::class, 'createStudent'])->middleware(['auth']);
Route::get('user/home', [WebController::class, 'home'])->name('home')->middleware(['auth']);
Route::get('user/perfil', [WebController::class, 'perfil'])->name('perfil')->middleware(['auth']);

Route::post('/user/password/update', [WebController::class, 'passwordUpdate'])->middleware(['auth']);
Route::post('/user/contact/update', [WebController::class, 'contactUpdate'])->middleware(['auth']);

Route::post('/logout', function(){
	auth()->logout();
	request()->session()->invalidate();
	return redirect()->route('login');
})->name('logout');


#Rotas para gestores do Registo academico
Route::get('/manager/home/{student_code?}', [WebController::class, 'homeManager'])->name('home-manager')->middleware('auth:manager');
Route::get('/manager/perfil', [WebController::class, 'perfilManager'])->name('perfil-manager')->middleware('auth:manager');
Route::post('/manager/password/update', [WebController::class, 'passwordUpdateManager'])->middleware(['auth:manager']);
//Visualizacao do perfil do estudante inscrito
Route::get('/manager/student/{code}', [WebController::class, 'studentManager'])->middleware('auth:manager');

//Rota de pagamento dentro do sistema
Route::post('/manager/student/payment', [WebController::class, 'studentMovement'])->middleware('auth:manager');
Route::post('/manager/student/aprovated', [WebController::class, 'studentAprovated'])->middleware('auth:manager');

//Impressao de Recipo de comprovativo de pagamento
Route::get('manager/student/receipt-payment/{number}', [PrintController::class, 'receiptPayment'])->middleware('auth:manager');

Route::get('/printer/recipient-inscription/{code}', [PrintController::class, 'print']);
