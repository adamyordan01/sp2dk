<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\LetterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaxpayerController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\UserController;

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

Auth::routes(['register' => false]);



Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('position/get-positions', [PositionController::class, 'getPosition'])->name('position.get-positions');
    Route::get('position/get-sections', [SectionController::class, 'getSection'])->name('section.get-sections');
    Route::post('/section/delete', [SectionController::class, 'destroy'])->name('section.destroy');

    Route::post('/position/delete', [PositionController::class, 'destroy'])->name('position.destroy');

    Route::resource('position', PositionController::class)->except('destroy');
    
    Route::resource('section', SectionController::class)->except('destroy');
    
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    Route::get('/taxpayer/index', [TaxpayerController::class, 'index'])->name('taxpayer.index');
    Route::get('/taxpayer/form-import', [TaxpayerController::class, 'formImport'])->name('taxpayer.form-import');
    Route::post('/taxpayer/import', [TaxpayerController::class, 'import'])->name('taxpayer.import');
    Route::get('/taxpayer/form-update-import', [TaxpayerController::class, 'formUpdateImport'])->name('taxpayer.form-update-import');
    Route::post('/taxpayer/import-update', [TaxpayerController::class, 'importUpdate'])->name('taxpayer.import-update');
    Route::get('/taxpayer/create', [TaxpayerController::class, 'create'])->name('taxpayer.create');
    Route::post('/taxpayer/store', [TaxpayerController::class, 'store'])->name('taxpayer.store');
    Route::get('taxpayer/edit/{taxpayer}', [TaxpayerController::class, 'edit'])->name('taxpayer.edit');
    Route::patch('/taxpayer/{taxpayer}', [TaxpayerController::class, 'update'])->name('taxpayer.update');
    // Route::delete('/taxpayer/{taxpayer}', [TaxpayerController::class, 'destroy'])->name('taxpayer.destroy');
    Route::post('/taxpayer/delete', [TaxpayerController::class, 'destroy'])->name('taxpayer.destroy');
    Route::get('/taxpayer/data', [TaxpayerController::class, 'taxpayerData'])->name('taxpayer.data');
    Route::post('taxpayer/delete/selected', [TaxpayerController::class, 'taxpayerDeleteSelected'])->name('taxpayer.delete.selected');

    
    Route::get('/letter/index', [LetterController::class, 'index'])->name('letter.index');
    Route::get('/letter/form-import', [LetterController::class, 'formImport'])->name('letter.form-import');
    Route::post('/letter/all/import', [LetterController::class, 'importAllLetter'])->name('letter.import.all');
    Route::post('/letter/import', [LetterController::class, 'import'])->name('letter.import');
    // Route::get('/letter/form-send-to-suki', [LetterController::class, 'formSendToSuki'])->name('letter.form-send-to-suki');
    Route::post('/letter/send-to-suki', [LetterController::class, 'sendToSuki'])->name('letter.sendtosuki');
    Route::post('/letter/send-to-pos', [LetterController::class, 'sendToPos'])->name('letter.sendtopos');
    Route::post('/letter/back-from-pos', [LetterController::class, 'backFromPos'])->name('letter.backfrompos');
    Route::post('/letter/import-lhp2dk', [LetterController::class, 'importLhp2dk'])->name('letter.importlhp2dk');
    Route::get('/letter/create', [LetterController::class, 'create'])->name('letter.create');
    Route::post('/letter/store', [LetterController::class, 'store'])->name('letter.store');
    Route::get('/letter/edit/{letter}', [LetterController::class, 'edit'])->name('letter.edit');
    Route::get('/letter/show/{letter}', [LetterController::class, 'show'])->name('letter.show');
    Route::patch('/letter/{letter}', [LetterController::class, 'update'])->name('letter.update');
    // Route::delete('/letter/{letter}', [LetterController::class, 'destroy'])->name('letter.destroy');
    Route::post('/letter/delete', [LetterController::class, 'destroy'])->name('letter.destroy');
    Route::post('letter/delete/selected', [LetterController::class, 'letterDeleteSelected'])->name('letter.delete.selected');
    Route::get('/letter/data', [LetterController::class, 'letterData'])->name('letter.data');
    Route::get('/letter/export', [LetterController::class, 'export'])->name('letter.export');
    Route::get('/letter/export/ar', [LetterController::class, 'exportAr'])->name('letter.export-ar');
    Route::get('/letter/export/kk', [LetterController::class, 'exportKk'])->name('letter.export-kk');
    
    Route::get('/user/index', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::patch('/user/update/{user}', [UserController::class, 'update'])->name('user.update');
    // Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::post('/user/delete', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/user/get-users', [UserController::class, 'getUsers'])->name('user.get-users');

    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::get('change-password/index', [ChangePasswordController::class, 'index'])->name('change-password.index');
    Route::patch('change-password/update', [ChangePasswordController::class, 'update'])->name('change-password.update');

    Route::get('template/index', [TemplateController::class, 'index'])->name('template.index');

    Route::get('template/download/wajib-pajak', function() {
        $file = public_path()."/template import/Format Import Wajib Pajak.xlsx";
        $header = array('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        return Response::download($file, "Format Import Wajib Pajak.xlsx", $header);
    })->name('template.download.wajib-pajak');

    Route::get('template/download/kirim-suki', function() {
        $file = public_path()."/template import/Format Import Kirim Suki.xlsx";
        $header = array('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        return Response::download($file, "Format Import Kirim Suki.xlsx", $header);
    })->name('template.download.kirim-suki');

    Route::get('template/download/kirim-pos', function() {
        $file = public_path()."/template import/Format Import Kirim Pos.xlsx";
        $header = array('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        return Response::download($file, "Format Import Kirim Pos.xlsx", $header);
    })->name('template.download.kirim-pos');

    Route::get('template/download/kempos', function() {
        $file = public_path()."/template import/Format Import Kempos.xlsx";
        $header = array('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        return Response::download($file, "Format Import Kempos.xlsx", $header);
    })->name('template.download.kempos');

    Route::get('template/download/sp2dk', function() {
        $file = public_path()."/template import/Format Import SP2DK.xlsx";
        $header = array('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        return Response::download($file, "Format Import SP2DK.xlsx", $header);
    })->name('template.download.sp2dk');

    Route::get('template/download/lhp2dk', function() {
        $file = public_path()."/template import/Format Import LHP2DK.xlsx";
        $header = array('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        return Response::download($file, "Format Import LHP2DK.xlsx", $header);
    })->name('template.download.lhp2dk');

    Route::get('template/download/all-sp2dk', function() {
        $file = public_path()."/template import/Seluruh SP2DK.xlsx";
        $header = array('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        return Response::download($file, "Seluruh SP2DK.xlsx", $header);
    })->name('template.download.all-sp2dk');

    Route::get('guide/index', [GuideController::class, 'index'])->name('guide.index');

});

Route::get('/', function () {
    return view('auth.login');
});



