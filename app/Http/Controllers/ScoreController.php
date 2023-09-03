<?php

namespace App\Http\Controllers;

use App\Http\Requests\RankingScoreRequest;

use App\Http\Requests\StoreScoreRequest;

use App\Models\Player;
use App\Repostory\ScoreRepository;
use Illuminate\Http\JsonResponse;


class ScoreController extends Controller
{


    public ScoreRepository $scoreRepository;


    public function __construct(ScoreRepository $scoreRepository)
    {


        $this->scoreRepository = $scoreRepository;
    }

    public function createScore(StoreScoreRequest $request): JsonResponse
    {

        $createScore = $this->scoreRepository->storeScore($request);
        return response()->json($createScore);

    }

    public function listAllScore(): JsonResponse
    {
        $scores =$this->scoreRepository->getAllScores();
        return response()->json($scores);
    }

    public function  rankingTotally(): JsonResponse
    {

        $players = Player::orderBy('score', 'desc')->get();
        return response()->json($players);
    }






}
