<?php

namespace App;

trait PageTemplates
{
    private function developed()
    {
        $this->crud->addField([
            'name' => 'meta_title',
            'label' => trans('backpack::pagemanager.meta_title'),
        ]);

        $this->crud->addField([
            'name' => 'meta_description',
            'label' => trans('backpack::pagemanager.meta_description'),
        ]);

        $this->crud->addField([
            'name' => 'no_index',
            'label' => 'Без индекса',
            'type' => 'checkbox'
        ]);

        $this->crud->addField([
            'name' => 'seo_text',
            'label' => 'SEO текст',
            'type' => 'wysiwyg'
        ]);
        $this->crud->addField([
            'name' => 'banner', 'label' => 'Баннер',
            'type' => 'image', 'upload' => true, 'prefix' => 'uploads/min/',
            'crop' => true, 'aspect_ratio' => 1.53
        ]);
    }

    private function infos()
    {
        $this->crud->addField([
            'name' => 'content',
            'label' => 'Контент',
            'type' => 'wysiwyg',
        ]);

        $this->crud->addField([
            'name' => 'meta_title',
            'label' => trans('backpack::pagemanager.meta_title'),
        ]);

        $this->crud->addField([
            'name' => 'meta_description',
            'label' => trans('backpack::pagemanager.meta_description'),
        ]);

        $this->crud->addField([
            'name' => 'no_index',
            'label' => 'Без индекса',
            'type' => 'checkbox'
        ]);

        $this->crud->addField([
            'name' => 'seo_text',
            'label' => 'SEO текст',
            'type' => 'wysiwyg'
        ]);
        $this->crud->addField([
            'name' => 'banner', 'label' => 'Баннер',
            'type' => 'image', 'upload' => true, 'prefix' => 'uploads/min/',
            'crop' => true, 'aspect_ratio' => 1.53
        ]);
    }
}
