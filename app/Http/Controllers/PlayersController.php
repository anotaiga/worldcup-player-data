<?php
    
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Player;
    use Illuminate\Support\Facades\DB;


    class PlayersController extends Controller
    {
        public function index()
        {
             // $params = [
             // 'test'=>'これはテストです。',
             // 'sample'=>'これはサンプルです。'
             // ];
            // return view('index',['params'=>$params]);
            
            $playerTable = new Player;
            $players = $playerTable->allPlayer();
            return view('players.index', ['players' => $players]);
        }

        public function detail($player_id)
        {
            $player = Player::find($player_id);
            return view('players.detail',['player'=> $player]);
        }
    }






