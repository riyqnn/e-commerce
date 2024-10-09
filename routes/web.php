<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;


use App\Http\Controllers\frontend\IndexController;
use App\Http\Controllers\frontend\LanguageController;
use App\Models\User;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/login', [AdminController::class, 'loginForm']);
	Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});


Route::middleware(['auth:admin'])->group(function() {
    
    // Route untuk dashboard admin
    Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');

    // Route untuk profil admin
    Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
    Route::get('/admin/profile', [AdminProfileController::class, 'adminProfile'])->name('admin.profile');
    Route::get('/admin/profile/edit', [AdminProfileController::class, 'adminProfileEdit'])->name('admin.profile.edit');
    Route::post('/admin/profile/update', [AdminProfileController::class, 'adminProfileUpdate'])->name('admin.profile.update');
    Route::get('/admin/change/password', [AdminProfileController::class, 'adminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminProfileController::class, 'adminPasswordUpdate'])->name('admin.password.update');

    // Route untuk admin
    Route::prefix('admin')->group(function() {

        // Route untuk brand
        Route::prefix('brand')->group(function() {
            Route::get('/view', [BrandController::class, 'viewBrand'])->name('all.brand');
            Route::post('/store', [BrandController::class, 'brandStore'])->name('brand.store');
            Route::get('/edit/{id}', [BrandController::class, 'brandEdit'])->name('brand.edit');
            Route::post('/update', [BrandController::class, 'brandUpdate'])->name('brand.update');
            Route::get('/delete/{id}', [BrandController::class, 'brandDelete'])->name('brand.delete');
        });

        // Route untuk kategori
        Route::prefix('category')->group(function() {
            Route::get('/view', [CategoryController::class, 'viewCategory'])->name('all.category');
            Route::post('/store', [CategoryController::class, 'categoryStore'])->name('category.store');
            Route::get('/edit/{id}', [CategoryController::class, 'categoryEdit'])->name('category.edit');
            Route::post('/update/{id}', [CategoryController::class, 'categoryUpdate'])->name('category.update');
            Route::get('/delete/{id}', [CategoryController::class, 'categoryDelete'])->name('category.delete');

            // Route untuk subkategori
            Route::prefix('sub')->group(function() {
                Route::get('/view', [SubCategoryController::class, 'viewSubCategory'])->name('all.subcategory');
                Route::post('/store', [SubCategoryController::class, 'subCategoryStore'])->name('subcategory.store');
                Route::get('/edit/{id}', [SubCategoryController::class, 'subCategoryEdit'])->name('subcategory.edit');
                Route::post('/update/{id}', [SubCategoryController::class, 'subCategoryUpdate'])->name('subcategory.update');
                Route::get('/delete/{id}', [SubCategoryController::class, 'subCategoryDelete'])->name('subcategory.delete');
            });

            // Route untuk sub-subkategori
            Route::prefix('sub/sub')->group(function() {
                Route::get('/view', [SubCategoryController::class, 'subSubCategoryView'])->name('all.subsubcategory');
                Route::post('/store', [SubCategoryController::class, 'subSubCategoryStore'])->name('subsubcategory.store');
                Route::get('/edit/{id}', [SubCategoryController::class, 'subSubCategoryEdit'])->name('subsubcategory.edit');
                Route::post('/update/{id}', [SubCategoryController::class, 'subSubCategoryUpdate'])->name('subsubcategory.update');
                Route::get('/delete/{id}', [SubCategoryController::class, 'subSubCategoryDelete'])->name('subsubcategory.delete');
            });

        
        });

        // Route untuk produk
        Route::prefix('products')->group(function() {
            Route::get('/add', [ProductController::class, 'addProduct'])->name('add-product');
            Route::get('/manage', [ProductController::class, 'manageProduct'])->name('manage-product');
            Route::post('/store', [ProductController::class, 'storeProduct'])->name('product-store');
            Route::get('/edit/{id}', [ProductController::class, 'editProduct'])->name('product.edit');
            Route::post('/update/data/{id}', [ProductController::class, 'updateDataProduct'])->name('product.data.update');
            Route::post('/update/images', [ProductController::class, 'updateDataImages'])->name('images.update');
            Route::post('/update/thambnail/{id}', [ProductController::class, 'updateThambnail'])->name('thambnail.update');
            Route::get('/imgs/delete/{id}', [ProductController::class, 'imgsDelete'])->name('product.imgs.delete');
            Route::get('/active/{id}', [ProductController::class, 'productActive'])->name('product.active');
            Route::get('/inactive/{id}', [ProductController::class, 'productInActive'])->name('product.inactive');
            Route::get('/delete/{id}', [ProductController::class, 'productDelete'])->name('product.delete');
        });

        // Route untuk slider
        Route::prefix('slider')->group(function() {
            Route::get('/view', [SliderController::class, 'viewSlider'])->name('manage.slider');
            Route::post('/store', [SliderController::class, 'StoreSlider'])->name('slider.store');
            Route::get('/edit/{id}', [SliderController::class, 'sliderEdit'])->name('slider.edit');
            Route::post('/update/{id}', [SliderController::class, 'sliderUpdate'])->name('slider.update');
            Route::get('/active/{id}', [SliderController::class, 'sliderActive'])->name('slider.active');
            Route::get('/inactive/{id}', [SliderController::class, 'sliderInActive'])->name('slider.inactive');
            Route::get('/delete/{id}', [SliderController::class, 'sliderDelete'])->name('slider.delete');
        });
    });

});


Route::get('/category/subcategory/ajax/{category_id}', [SubCategoryController::class, 'getSubCategoryAjax']);
Route::get('/category/subsubcategory/ajax/{subcategory_id}', [SubCategoryController::class, 'getSubSubCategoryAjax']);








//Route ALL FRONTEND

Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $id = Auth::user()->id;
    $user = User::find($id);
    return view('dashboard',compact('user'));
})->name('dashboard');

Route::get('/',[IndexController::class, 'index']);
Route::get('/user/logout',[IndexController::class, 'userLogout'])->name('user.logout');
Route::get('/user/profile/edit',[IndexController::class, 'userProfileEdit'])->name('user.profile.edit');
Route::post('/user/profile/update',[IndexController::class, 'userProfileUpdate'])->name('user.profile.update');
Route::get('/user/change/password',[IndexController::class, 'changePassword'])->name('change.password');
Route::post('/user/update/password',[IndexController::class, 'userUpdatePassword'])->name('user.update.password');


Route::get('/language/ind',[LanguageController::class,'ind'])->name('language.ind');

Route::get('/language/en',[LanguageController::class,'en'])->name('language.en');

Route::get('/detail/{id}/{slug}',[IndexController::class,'detail']);