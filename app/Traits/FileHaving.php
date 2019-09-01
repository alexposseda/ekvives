<?php

namespace App\Traits;

trait FileHaving
{
    public static function bootFileHaving()
    {
        static::deleting(function ($obj) {
            if ($obj->file != '/uploads/') {
                unlink(public_path($obj->file));
            }
        });
    }

    public function getFileAttribute($value)
    {
        return '/uploads/' . $value;
    }

    public function setFileAttribute($value)
    {
        $attribute_name = 'file';
        $disk = 'uploads';
        $instance = self::latest()->first();
        $id = $this->id ?? ($instance->id ?? 1);
        $destination_path = "{$this->table}/{$id}";
        $this->uploadPdfToDisk($value, $attribute_name, $disk, $destination_path);
    }

    public function uploadPdfToDisk($value, $attribute_name, $disk, $destination_path)
    {
        $params['disk'] = isset($disk) ? $disk : 'public';
        if ($this->fileDeleted($attribute_name, $value)) {
            $this->dropFiles($attribute_name, $params);
        }

        // if a new file is uploaded, store it on disk and its filename in the database
        if ($this->fileUploaded($attribute_name)) {
            $this->saveFile($attribute_name, $disk, $destination_path);
        }
    }

    protected function fileUploaded($attribute_name)
    {
        return request()->hasFile($attribute_name) && request()->file($attribute_name)->isValid();
    }

    protected function fileDeleted($attribute_name, $value)
    {
        return (request()->hasFile($attribute_name) and
            $this->{$attribute_name} and
            $this->{$attribute_name} != null) ||
            (is_null($value) && $this->{$attribute_name} != null);
    }

    protected function dropFiles($attribute_name, $params)
    {
        \Storage::disk($params['disk'])->delete($this->{$attribute_name});
        $this->attributes[$attribute_name] = null;
    }

    protected function saveFile($attribute_name, $disk, $destination_path)
    {
        $previos_model = self::latest()->first();
        $file = request()->file($attribute_name);
        $new_file_name = $file->getClientOriginalName();

        // 2. Move the new file to the correct path
        $file_path = $file->storeAs($destination_path, $new_file_name, $disk);

        // 3. Save the complete path to the database
        $this->attributes[$attribute_name] = $file_path;
    }
}
