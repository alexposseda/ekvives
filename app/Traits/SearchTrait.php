<?php

namespace App\Traits;

trait SearchTrait
{
    public function hasWords($words)
    {
        $result = true;
        foreach ($words as $word) {
            if (!$this->hasFieldWithWord($word)) {
                $result = false;
            }
        }
        return $result;
    }

    protected function hasFieldWithWord($word)
    {
        foreach ($this->search_fields as $field) {
            if ($this->hasWordIn($word, $this->{$field})) {
                return true;
            }
        }
    }

    protected function hasWordIn($word, $in)
    {
        return false !== mb_strpos(mb_strtolower($in), mb_strtolower($word));
    }

    protected static function filteredCollection($items, $words)
    {
        return $items->filter(function ($item) use ($words) {
            return $item->hasWords(explode(' ', $words));
        })->take(20);
    }
}
