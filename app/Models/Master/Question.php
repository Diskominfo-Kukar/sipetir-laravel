<?php

namespace App\Models\Master;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Question extends Model
{
    use HasFactory, SoftDeletes, UsesUuid;

    protected $table = 'question';

    protected $logName = 'question';

    protected $logOnly = ['*'];

    protected $fillable = ['nama', 'kategori_id', 'parent_id'];

    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function kategoriReview()
    {
        return $this->belongsTo(KategoriReview::class, 'kategori_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id');
    }

    public function parentQuestion()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function childrenQuestions()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
}
