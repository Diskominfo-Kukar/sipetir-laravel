<?php

namespace App\Models\Master;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerHistory extends Model
{
    use HasFactory;

    protected $table = 'answer_history';

    protected $fillable = ['answer_id', 'user_id', 'old_review', 'tanggal'];

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
