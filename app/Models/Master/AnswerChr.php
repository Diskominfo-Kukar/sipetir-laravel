<?php

namespace App\Models\Master;

use App\Models\Paket\Paket;
use App\Models\User;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerChr extends Model
{
    use HasFactory, UsesUuid;

    protected $table = 'answer_chrs';

    protected $logName = 'answer_chrs';

    protected $logOnly = ['*'];

    protected $fillable = ['review', 'paket_id', 'kategori_id', 'user_id'];

    public function kategoriReview()
    {
        return $this->belongsTo(KategoriReview::class, 'kategori_id');
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
