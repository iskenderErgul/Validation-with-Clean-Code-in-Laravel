<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerCreateRequest;
use App\Http\Requests\PlayerUpdateRequest;
use App\Http\Requests\RankingWeeklyRequest;
use App\Models\Player;
use App\Models\Score;
use App\Repostory\Collection;
use App\Repostory\PlayerRepository;
use App\Repostory\ScoreRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlayerController extends Controller
{
    private PlayerRepository $playerRepository;




    public function __construct(PlayerRepository $playerRepository)
    {

        $this->playerRepository = $playerRepository;

    }


    /**
     * @param PlayerCreateRequest $request
     * @return JsonResponse
     */
    public function create(PlayerCreateRequest $request): JsonResponse
    {
        try {
            $createdPlayer = $this->playerRepository->createPlayer($request);
            return response()->json($createdPlayer);

        } catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }


    public function playerList(): JsonResponse
    {
        $players = $this->playerRepository->getAllPlayers();
        return response()->json($players);

    }


    public function playerUpdate(PlayerUpdateRequest $request): JsonResponse
    {


        try {
            $updatedPlayer = $this->playerRepository->updatePlayer($request);
            return response()->json($updatedPlayer);

        } catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }


    }

    public function rankingWeekly(RankingWeeklyRequest $request): JsonResponse
    {
        return  $this->playerRepository->rankingWeekly($request);


    }






}
