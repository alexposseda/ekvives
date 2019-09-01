<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\GalleryRequest as StoreRequest;
use App\Http\Requests\GalleryRequest as UpdateRequest;
use Illuminate\Http\Request;

class GalleryCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Gallery');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/gallery');
        $this->crud->setEntityNameStrings('галерею', 'галереии');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->orderBy('published_at', 'desc');

        $this->crud->addColumns([
        ['name' => 'title', 'label' => 'Название'],
        ['name' => 'published_at', 'label' => 'Название', 'type' => 'datetime']
        ]);
        $this->crud->addFields([
            ['name' => 'title', 'label' => 'Название',  'attributes' => ['required' => 'required']],
            ['name' => 'published_at', 'label' => 'Дата публикации', 'type' => 'datetime_picker', 'attributes' => ['required' => 'required']],
            ['name' => 'meta_title', 'label' => 'Meta title'],
            ['name' => 'meta_description', 'label' => 'Meta description'],
            ['name' => 'no_index', 'label' => 'Не индексировать', 'type' => 'checkbox'],
            ['name' => 'seo_text', 'label' => 'SEO текст', 'type' => 'wysiwyg'],   
            [
                'name' => 'banner', 'label' => 'Баннер',
                'type' => 'image', 'upload' => true, 'prefix' => 'uploads/big/',
                'crop' => true, 'aspect_ratio' => 1.53
            ],         
            ['name' => 'image', 'label' => 'Главное изображение', 'type' => 'image', 'upload' => true, 'prefix' => 'uploads/min/', 'crop' => true, 'aspect_ratio' => 1.46],
        ]);
        $this->crud->addField([
            'name' => 'photos',
            'label' => 'Фотогалерея',
            'type' => 'dropzone',
            'prefix' => 'uploads',
            'acceptedFiles' => 'image/*',
            'maxFilesize' => 10,
            'uploadRoute' => '/' . config('backpack.base.route_prefix') . '/gallery-upload',
            'deleteRoute' => '/' . config('backpack.base.route_prefix') . '/gallery-delete',
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
        $destination_path = 'galleries/' . \Carbon\Carbon::now()->year . '/' . \Carbon\Carbon::now()->month . '/' . \Carbon\Carbon::now()->day;
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
                $image = $this->longestSide($image); //->insert($watermark, 'bottom-right');

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
