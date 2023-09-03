<?php

namespace App\Repostory;

use App\Http\Requests\PlayerCreateRequest;
use App\Http\Requests\PlayerUpdateRequest;
use App\Http\Requests\RankingWeeklyRequest;
use App\Models\Player;
use App\Models\Score;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class PlayerRepository
{



    public function createPlayer(PlayerCreateRequest $request):Player
    {

        return Player::create([
            'name' => $request->name,
            'birthday' => $request->birthday
        ]);
    }


    // izzet abiye neden model döndügümüzde hata aldığımız sorulacak

    public function updatePlayer(PlayerUpdateRequest $request):mixed
    {

        return Player::where('id',$request->id)
            ->update([
            'name' => $request->name,
            'birthday' => $request->birthday
        ]);

    }

    public function getAllPlayers(): \Illuminate\Database\Eloquent\Collection
    {
        return Player::all();
    }





//    public function sortPlayerByYear($sortByBirthday)
//    {
//        return DB::table('players')
//            ->whereYear('birthday', '=', $sortByBirthday)
//            ->orderBy('score', 'desc')
//            ->get();
//    }
//
//    public function sortPlayerByScore()
//    {
//
//        $players = DB::table('players')
//            ->select('name', 'score')
//            ->orderBy('score', 'desc')
//            ->get();
//
//        return response()->json($players);
//
//
//    }
    public function rankingWeekly(RankingWeeklyRequest $request): JsonResponse
    {
        $startDate = $request->startDate;
        $endDate = $request->endDate;


        // "scores" tablosunu oyuncu kimliği (player_id) ve toplam skorları alarak gruplandırın ve toplayın
        $playerScores = Score::whereBetween('date', [$startDate, $endDate])
            ->select('player_id', DB::raw('SUM(score) as total_score'))
            ->groupBy('player_id')
            ->get();

        // Oyuncuları toplam skorlarına göre sırala ve isimlerini al
        $playersWithTotalScores = $playerScores->sortByDesc('total_score')->map(function ($playerScore) {
            $player = Player::find($playerScore->player_id);
            return [
                'name' => $player->name,
                'total_score' => $playerScore->total_score,
            ];
        })->values();

        // JSON yanıtını oluşturun
        $responseData = [

            'Oyuncuların Haftalık Puan Sıralaması' => $playersWithTotalScores,
            'message' => 'Oyuncular ve toplam skorlarına göre sıralandı.'
        ];

        // JSON yanıtını döndürün
        return new JsonResponse($responseData, 200);
    }


}

?>

