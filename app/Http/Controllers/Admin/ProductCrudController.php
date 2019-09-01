<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ProductRequest as StoreRequest;
use App\Http\Requests\ProductRequest as UpdateRequest;

class ProductCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Product');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/product');
        $this->crud->setEntityNameStrings('продукт', 'продукты');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        $this->crud->addColumns([
            ['name' => 'title', 'label' => 'Название'],
            ['label' => 'Категория', 'type' => 'select', 'name' => 'category_id', 'entity' => 'category',  'attribute' => 'title', 'model' => "App\Models\Category"]
        ]);
        $this->crud->addFields([
            ['name' => 'article', 'label' => 'Артикул', 'attributes' => ['required' => 'required']],
            ['name' => 'title', 'label' => 'Название',  'attributes' => ['required' => 'required']],
            ['name' => 'content', 'label' => 'Контент', 'type' => 'ckeditor', 'attributes' => ['required' => 'required']],
            ['name' => 'price', 'label' => 'Прайс-лист', 'type' => 'upload'],
            ['name' => 'catalog', 'label' => 'Каталог', 'type' => 'upload'],
            ['label' => 'Категория', 'type' => 'select2', 'name' => 'category_id', 'entity' => 'category',  'attribute' => 'title', 'model' => "App\Models\Category"],
            ['label' => 'Рекомендуемая категория', 'type' => 'select2_multiple', 'name' => 'suggestedCategories',
             'entity' => 'suggestedCategories',  'attribute' => 'title', 'model' => "App\Models\Category", 'pivot' => true, ],
            ['label' => 'Рекомендуемый продукт', 'type' => 'select2_multiple', 'name' => 'suggestedProducts',
             'entity' => 'suggestedProducts',  'attribute' => 'title', 'model' => "App\Models\Product", 'pivot' => true, ],
            ['name' => 'meta_title', 'label' => 'Meta title'],
            ['name' => 'meta_description', 'label' => 'Meta description'],
            ['name' => 'no_index', 'label' => 'Не индексировать', 'type' => 'checkbox'],
            ['name' => 'seo_text', 'label' => 'SEO текст', 'type' => 'wysiwyg'],
            [
                'name' => 'banner', 'label' => 'Баннер',
                'type' => 'image', 'upload' => true, 'prefix' => 'uploads/big/',
                'crop' => true, 'aspect_ratio' => 1.53
            ],
            ['name' => 'image', 'label' => 'Главное изображение', 'type' => 'image', 'upload' => true, 'prefix' => 'uploads/min/', 'crop' => true, 'aspect_ratio' => 1.46]
        ]);
        $this->crud->addField([
            'name' => 'images',
            'label' => 'Фотогалерея',
            'type' => 'dropzone',
            'prefix' => 'uploads',
            'acceptedFiles' => 'image/*',
            'maxFilesize' => 10,
            'uploadRoute' => '/' . config('backpack.base.route_prefix') . '/product-upload',
            'deleteRoute' => '/' . config('backpack.base.route_prefix') . '/product-delete',
        ]);
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function handleDropzoneDelete(Request $request)
    {
        return $this->dropzoneDelete($request);
    }

    public function handleDropzoneUpload()
    {
        $disk = 'uploads';
        $destination_path = 'products/' . \Carbon\Carbon::now()->year . '/' . \Carbon\Carbon::now()->month . '/' . \Carbon\Carbon::now()->day;
        $file = \Request::file('file');

        return $this->dropzoneUpload($disk, $destination_path, $file);
    }

    public function dropzoneUpload($disk, $destination_path, $file)
    {
        try {
            if (strpos($file->getMimeType(), 'image') === 0) {
                $new_filename = md5($file . time()) . '.' . $file->getClientOriginalExtension();
                $image = \Image::make($file)->interlace();
                // $watermark = \Image::make(public_path('watermark/watermark.png'));
                // $watermark = $this->longestSide($watermark, .20);
                $image = $this->longestSide($image);//->insert($watermark, 'bottom-right');

                \Storage::disk($disk)->put($destination_path . '/' . $new_filename, $image->stream());
            }

            return response()->json(['success' => true, 'filename' => '/' . $disk . '/' . $destination_path . '/' . $new_filename]);
        } catch (\Exception $e) {
            if (empty($image)) {
                return response('Not a valid image type', 404);
            } else {
                return response('Unknown error', 404);
            }
        }
    }

    protected function longestSide($image, $ratio = false, $width = 1000, $height = 600)
    {
        $width = $ratio ? intval($ratio * $width) : $width;
        $height = $ratio ? intval($ratio * $height) : $height;
        if ($image->width() > $width) {
            $image->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        if ($image->height() > $height) {
            $image->resize(null, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        return $image;
    }
}
