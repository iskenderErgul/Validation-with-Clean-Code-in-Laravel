<?php

namespace App\Repostory;


use App\Http\Requests\StoreScoreRequest;
use App\Models\Score;
use App\Models\Player;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ScoreRepository
{

    public function storeScore(StoreScoreRequest $request)
    {
        Player::where('id', $request->player_id)->increment('score', $request->score);
        return Score::create([
            'score' => $request->score,
            'date' => $request->date,
            'player_id' => $request->player_id,
        ]);



    }

    public function getAllScores(): Collection
    {
        return Score::all();
    }


}


?>
