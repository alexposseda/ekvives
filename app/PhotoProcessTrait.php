<?php

namespace App;

use Image;

trait PhotoProcessTrait
{
    protected $ext;
    protected $attribute_name;
    protected $params;

    public static function bootPhotoProcessTrait()
    {
        static::deleting(function ($obj) {
            foreach ($obj->image_properties as $image_type => $property) {
                $ext = $property->ext ?? 'png';
                if (strpos($obj->{$image_type}, '.' . $ext) !== false) {
                    foreach ($property['sizes'] as $size_type => $value) {
                        \Storage::disk($property['disk'])->delete('/' . $size_type . '/' . $obj->{$image_type});
                    }
                    \Storage::disk($property['disk'])->delete('/main/' . $obj->{$image_type});
                }
            }
        });
    }

    public function getPhoto($attribute_name, $folder = 'main')
    {
        $disk = $this->image_properties[$attribute_name]['disk'] ?? 'public';
        return '/' . $disk . '/' . $folder . $this->{$attribute_name};
    }

    public function getRawPhoto($attribute_name)
    {
        return $this->getPhoto($attribute_name, 'main');
    }

    public function uploadPhotoToDisk($value, $attribute_name)
    {
        $this->createParams($value, $attribute_name);
        $this->dropPhoto();

        if ($this->photoUploaded()) {
            return $this->processPhoto();
        }
    }

    protected function dropPhoto()
    {
        if (!$this->photoDeleted() and !$this->photoUploaded()) {
            return false;
        }

        $property = $this->image_properties[$this->attribute_name];
        $ext = $property->ext ?? 'png';
        if (strpos($this->{$this->attribute_name}, '.' . $ext) !== false) {
            foreach ($property['sizes'] as $size_type => $value) {
                \Storage::disk($property['disk'])->delete('/' . $size_type . '/' . $this->{$this->attribute_name});
            }
        }
        $this->attributes[$this->attribute_name] = null;
    }

    protected function photoUploaded()
    {        
        return (request()->hasFile($this->attribute_name) and
        request()->file($this->attribute_name)->isValid()) ||
        starts_with($this->params['value'], 'data:image');
    }

    protected function photoDeleted()
    {
        return (request()->hasFile($this->attribute_name) and
        $this->{$this->attribute_name} and
        $this->{$this->attribute_name} != null) || (is_null($this->params['value']) && $this->{$this->attribute_name} != null);
    }

    protected function processPhoto()
    {
        $this->params['filename'] = md5($this->params['value'] . time()) . '.' . $this->ext;

        $this->makeSizes();

        return $this->attributes[$this->attribute_name] = '/' . $this->params['destination_path'] . '/' . $this->params['filename'];
    }

    protected function createParams($value, $attribute_name)
    {
        $previos_model = self::latest()->first();
        $this->attribute_name = $attribute_name;
        $this->params = $this->image_properties[$attribute_name];
        $this->params['value'] = $value;
        $entity = self::latest()->first();
        $this->params['id'] = $this->id ?? ($entity ? $entity->id : 1);
        $this->params['disk'] = isset($this->params['disk']) ? $this->params['disk'] : 'public';
        $this->params['destination_path'] = isset($this->params['destination_path']) ? $this->params['destination_path'] : '';
        $this->params['destination_path'] .= '/' . $this->params['id'];
        $this->ext = $this->params['ext'] ?? 'png';
    }

    protected function createDir($path)
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    }

    protected function savePhoto()
    {
        $image = Image::make($this->params['value'])->interlace();
        // $watermark = Image::make(public_path('watermark/watermark.png'));
        // $watermark = $this->longestSide($watermark, .20);
        $image = $this->longestSide($image); //->insert($watermark, 'bottom-right');
        $image->encode($this->ext)
        ->save($this->params['path'] . '/' . $this->params['filename'], $this->params['quality']);
    }

    protected function createPhoto()
    {
        $this->params['path'] = config('filesystems.disks.' . ($this->params['disk']) . '.root') . '/' . $this->params['folder'] . '/' . $this->params['destination_path'];
        $this->createDir($this->params['path']);
        $this->savePhoto();
    }

    protected function makeSizes()
    {
        $this->params['quality'] = $this->params['quality'] ?? 75;
        foreach ($this->params['sizes'] as $folder => $size) {
            $this->params['folder'] = $folder;
            $this->params['size'] = $size;
            $this->createPhoto();
            $this->params['folder'] = null;
            $this->params['size'] = null;
        }
        // $this->params['folder'] = 'main';
        // $this->params['size'] = null;
        // $this->createPhoto();
    }

    protected function longestSide($image, $ratio = false)
    {
        $sizes['width'] = $this->params['size']['width'] ?? 0;
        $sizes['height'] = $this->params['size']['height'] ?? 0;
        $sizes['width'] = $ratio ? intval($ratio * $sizes['width']) : $sizes['width'];
        $sizes['height'] = $ratio ? intval($ratio * $sizes['height']) : $sizes['height'];
        if ($sizes['width'] > 0 && $sizes['height'] > 0) {
            return $this->autosize($image, $sizes);
        } elseif ($sizes['width']) {
            return $image->resize($sizes['width'], null, function ($constraint) {
                $constraint->aspectRatio();
            });
        } elseif ($sizes['height']) {
            return $image->resize(null, $sizes['height'], function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        return $image;
    }

    protected function autosize($image, $size)
    {
        return $image->width() > $size['width'] ?
            $image->resize($size['width'], null, function ($constraint) {
                $constraint->aspectRatio();
            }) :
            $image->resize(null, $size['height'], function ($constraint) {
                $constraint->aspectRatio();
            });
    }
}
