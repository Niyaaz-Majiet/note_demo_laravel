<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\NotesViewController;
use Illuminate\Support\Facades\Auth;

Route::get('/',function () {
    if(Auth::check()){
        return redirect()->route('notes');
    }

    return redirect("login")->withSuccess('You are not allowed to access');
});

Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');


Route::get('user/update/{id}',[CustomAuthController::class, 'getUser'])->name('user.getUser');
Route::post('user/update',[CustomAuthController::class, 'editUser'])->name('user.editUser');

Route::get('notes',[NotesViewController::class, 'index'])->name('notes');
Route::post('notes',[NotesViewController::class, 'addNote'])->name('notes.addNote');
Route::get('notes/update/{id}',[NotesViewController::class, 'getNote'])->name('notes.getNote');
Route::post('notes/update',[NotesViewController::class, 'editRecord'])->name('notes.editRecord');
Route::get('notes/delete/{id}',[NotesViewController::class, 'removeNote'])->name('notes.delete');