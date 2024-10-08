<?php

namespace App\Models\Master;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Master\Question[] $questions
 */
class KategoriReview extends Model
{
    use HasFactory, SoftDeletes, UsesUuid;

    protected $table = 'kategori_review';

    protected $logName = 'kategori-review';

    protected $logOnly = ['*'];

    protected $fillable = ['nama', 'no_urut', 'deskripsi'];

    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'kategori_id');
    }

    public function answerChr()
    {
        return $this->hasMany(AnswerChr::class, 'kategori_id');
    }
}
