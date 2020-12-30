<?php
    
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
    
    Route::get('setlocale/{locale}', 'IndexController@changeLanguage');
    
    Route::get('/', 'IndexController@index');
    
    Route::get('about-us', 'PageController@aboutUs')->name('about-us');
    Route::get('testimonials', 'TestimonialController@index')->name('testimonials');
    Route::get('documents', 'DocumentController@index')->name('documents');
    Route::get('reference-objects', 'GalleryController@index')->name('galleries');
    Route::get('reference-objects/{gallery}', 'GalleryController@show')->name('gallery');
    
    Route::get('categories', 'CategoryController@index')->name('categories');
    Route::get('search', 'SearchController@index')->name('search');
    
    Route::get('categories/{category}', 'CategoryController@show')->name('category.show');
    
    Route::get('news', 'NewsController@index')->name('news');
    Route::get('news/{article}', 'NewsController@show')->name('article');
    
    Route::get('prices', 'PriceController@index')->name('prices');
    
    Route::get('contacts', 'ContactController@index')->name('contacts');
    
    Route::post('subscribe', 'ContactController@subscribe');
    Route::post('contact', 'ContactController@store');
    Route::post('product', 'CategoryController@store');
    Route::post('price_clarify', 'PriceController@store');
    
    ### EN start
    Route::get('/en', 'IndexController@index');
    
    Route::get('en/about-us', 'PageController@aboutUs')->name('about-us');
    Route::get('en/testimonials', 'TestimonialController@index')->name('testimonials');
    Route::get('en/documents', 'DocumentController@index')->name('documents');
    Route::get('en/reference-objects', 'GalleryController@index')->name('galleries');
    Route::get('en/reference-objects/{gallery}', 'GalleryController@show')->name('gallery');
    
    Route::get('en/categories', 'CategoryController@index')->name('categories');
    Route::get('en/search', 'SearchController@index')->name('search');
    
    Route::get('en/categories/{category}', 'CategoryController@show')->name('category.show');
    
    Route::get('en/news', 'NewsController@index')->name('news');
    Route::get('en/news/{article}', 'NewsController@show')->name('article');
    
    Route::get('en/prices', 'PriceController@index')->name('prices');
    
    Route::get('en/contacts', 'ContactController@index')->name('contacts');
    
    Route::post('en/subscribe', 'ContactController@subscribe');
    Route::post('en/contact', 'ContactController@store');
    Route::post('en/product', 'CategoryController@store');
    Route::post('en/price_clarify', 'PriceController@store');
    ### EN end
    ### RU start
    Route::get('/ru', 'IndexController@index');
    
    Route::get('ru/about-us', 'PageController@aboutUs')->name('about-us');
    Route::get('ru/testimonials', 'TestimonialController@index')->name('testimonials');
    Route::get('ru/documents', 'DocumentController@index')->name('documents');
    Route::get('ru/reference-objects', 'GalleryController@index')->name('galleries');
    Route::get('ru/reference-objects/{gallery}', 'GalleryController@show')->name('gallery');
    
    Route::get('ru/categories', 'CategoryController@index')->name('categories');
    Route::get('ru/search', 'SearchController@index')->name('search');
    
    Route::get('ru/categories/{category}', 'CategoryController@show')->name('category.show');
    
    Route::get('ru/news', 'NewsController@index')->name('news');
    Route::get('ru/news/{article}', 'NewsController@show')->name('article');
    
    Route::get('ru/prices', 'PriceController@index')->name('prices');
    
    Route::get('ru/contacts', 'ContactController@index')->name('contacts');
    
    Route::post('ru/subscribe', 'ContactController@subscribe');
    Route::post('ru/contact', 'ContactController@store');
    Route::post('ru/product', 'CategoryController@store');
    Route::post('ru/price_clarify', 'PriceController@store');
    ### RU end
    
    // Admin Interface Routes
    Route::group(['prefix'     => 'admin',
                  'middleware' => 'admin',
                  'namespace'  => 'Admin',
    ], function(){
        CRUD::resource('document', 'DocumentCrudController');
        CRUD::resource('testimonial', 'TestimonialCrudController');
        CRUD::resource('gallery', 'GalleryCrudController');
        CRUD::resource('category', 'CategoryCrudController');
        CRUD::resource('product', 'ProductCrudController');
        CRUD::resource('price', 'PriceCrudController');
        CRUD::resource('article', 'ArticleCrudController');
        CRUD::resource('order', 'OrderCrudController');
        CRUD::resource('priceclarify', 'PriceClarifyCrudController');
        CRUD::resource('contactresponse', 'ContactResponseCrudController');
        CRUD::resource('subscriber', 'SubscriberCrudController');
        CRUD::resource('contact', 'ContactCrudController');
        CRUD::resource('slide', 'SlideCrudController');
        CRUD::resource('menu-item', 'MenuItemCrudController');
        
        Route::post('gallery-upload', ['uses' => 'GalleryCrudController@handleDropzoneUpload']);
        Route::post('gallery-delete', ['uses' => 'GalleryCrudController@handleDropzoneDelete']);
        Route::post('product-upload', ['uses' => 'ProductCrudController@handleDropzoneUpload']);
        Route::post('product-delete', ['uses' => 'ProductCrudController@handleDropzoneDelete']);
        
    });
    
    //    Route::get('en/{categories?}', 'CategoryController@show')->where(['categories' => '.*']);
    Route::get('{categories?}', 'CategoryController@show')->where(['categories' => '.*']);