<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HskWord extends Model
{
    protected $table = 'hsk_words';
    public $timestamps = false;

    /**
     * DBカラム名が EF Core 由来の PascalCase のため、
     * 取得時にすべてのキーを小文字に正規化する。
     */
    public function newFromBuilder($attributes = [], $connection = null): static
    {
        $normalized = array_change_key_case((array) $attributes, CASE_LOWER);
        return parent::newFromBuilder($normalized, $connection);
    }
}
