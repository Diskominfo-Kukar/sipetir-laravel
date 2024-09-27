<?php

namespace App\Models\Master;

use App\Models\Paket\Paket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $table = 'answers';

    protected $logName = 'answers';

    protected $logOnly = ['*'];

    protected $fillable = ['review', 'paket_id', 'question_id', 'user_id'];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function histories()
    {
        return $this->hasMany(AnswerHistory::class);
    }
}
