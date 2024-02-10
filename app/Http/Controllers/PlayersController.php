<?php
    
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Player;
    use Illuminate\Support\Facades\DB;
    use App\Http\Requests\FormRequest;
    use Illuminate\Support\Facades\Auth;


    class PlayersController extends Controller
    {

        //indexの処理コード
        public function index()
        {
             // $params = [
             // 'test'=>'これはテストです。',
             // 'sample'=>'これはサンプルです。'
             // ];
            // return view('index',['params'=>$params]);
            
            $playerTable = new Player;
            $players = $playerTable->allPlayer();
            // $players = Player::where('del_flg', 0)->get();
            return view('players.index', ['players' => $players]);
        }
        //index1の処理コード
        public function index1($player_id)
        {
                $result = DB::table('players')
                ->join('countries', 'players.country_id', '=', 'countries.id')
                ->select('players.*', 'countries.name as country_name')
                ->where('players.del_fig', '=', 0)
                ->paginate(20);
                
        
                $player = Player::find($player_id);

                return view('players.index1', ['result' => $result, 'player' => $player]);
        }

        public function index2($player_id)
        {
            
    $user = Auth::user(); 
                $result = DB::table('players')
                ->join('countries', 'players.country_id', '=', 'countries.id')
                ->select('players.*', 'countries.name as country_name')
                ->where('players.del_fig', '=', 0)
                ->where('players.country_id', '=', $user->country_id)
                ->paginate(20);
                
        
                $player = Player::find($player_id);

                return view('players.index2', ['result' => $result, 'player' => $player]);
        }
        
        

        public function reindex()
        {
            $playerTable = new Player;
            $players = $playerTable->allPlayer();
            return view('players.index', ['players' => $players]);
        }




        //detailの処理コード
        public function detail($player_id)
        {
            $playersCountry = new Player;
            $goal = new Player;
            $player = $playersCountry->selectPlayer($player_id);
            $goals = $goal->selectGoals($player_id);
            return view('players.detail',['player'=>$player,'goals'=>$goals]);
        }
        
        public function detail2($player_id)
        {
            $playersCountry = new Player;
            $goal = new Player;
            $player = $playersCountry->selectPlayer($player_id);
            $goals = $goal->selectGoals($player_id);
            return view('players.detail2',['player'=>$player,'goals'=>$goals]);
        }
        


        //editの処理コード
        public function edit($player_id)
        {
            $playersCountry = new Player;
            $goal = new Player;
            $country = new Player;
            $player = $playersCountry->selectPlayer($player_id);
            $goals = $goal->selectGoals($player_id);
            $countries = $country->selectCountries();
            return view('players.edit',['player'=>$player,'goals'=>$goals,'countries'=>$countries]);
        }
        

        public function backToIndex()
        {
            // ここではindex1/1にリダイレクトしますが、実際の要件に合わせて変更してください。
            return redirect('index1/1');
        }

        public function backToIndex2(Request $request, $country_id)
        {
            // ここで $country_id を使用して必要な処理を行う
    dd($country_id);
            // 例えば、$country_id をビューに渡して表示するなど
            return view('players.index2', ['country_id' => $country_id]);
        }

        public function update(Request $request, $player_id)
        {
            $validateMessages = [
                "id.required" =>"この項目は必須項目です。",
                "uniform_num.required" => "この項目は必須項目です。",
                "uniform_num.numeric" => "この項目は半角数字で入力してください。",
                "name.required" => "この項目は必須項目です。",
                "position.required" => "この項目は必須項目です。",
                "my_country_name.required" => "この項目は必須項目です。",
                "club.required" => "この項目は必須項目です。",
                "birth.required" => "この項目は必須項目です。",
                "birth.date" => "この項目は[YYYY-MM-DD]で入力してください。",
                "height.required" => "この項目は必須項目です。",
                "height.numeric" => "この項目は半角数字で入力してください。",
                "weight.required" => "この項目は必須項目です。",
                "weight.numeric" => "この項目は半角数字で入力してください。",
            ];
        
            $validatedData = $request->validate([
                'id' => 'required',
                'uniform_num' => 'required|numeric', // 入力必須で、半角数字のみ許可
                'name' => 'required',
                'position' => 'required',
                'my_country_name' => 'required',
                'club' => 'required', // 入力必須で、文字列のみ許可
                'birth' => 'required|date:Y-m-d',
                'height' => 'required|numeric', // 入力必須で、半角数字のみ許可
                'weight' => 'required|numeric',
            ],$validateMessages);
        
            // dd($validatedData);

            // フォームから送信されたデータでプレイヤーを更新
            $validatedData = $request->all();
            $player = Player::find($validatedData['id']);

            DB::table('players')
                ->join('countries as my_country', 'players.country_id', '=', 'my_country.id')
                ->select('my_country.name as my_country_name')
                ->where('players.id', $player_id)
                ->update([
                    'players.uniform_num' => $validatedData['uniform_num'],
                    'players.name' => $validatedData['name'],
                    'players.position' => $validatedData['position'],
                    'players.country_id' => DB::raw("(SELECT id FROM countries WHERE name = '{$validatedData['my_country_name']}')"),
                    'players.club' => $validatedData['club'],
                    'players.birth' => $validatedData['birth'],
                    'players.height' => $validatedData['height'],
                    'players.weight' => $validatedData['weight'],
                ]);

            return view('players.show', ['validatedData' => $validatedData]);
        }

        public function show($player_id)
        {
            $player = Player::find($player_id);
        
            return view('players.show', compact('player'));
        }

        public function delete($player_id)
        {
            $player = Player::find($player_id);

            if ($player) {
                $referer = @$_SERVER['HTTP_REFERER'];

                if (empty($referer)) {
                    // ダイレクトアクセスの場合
                    return redirect('index1/1')->with('error', '直接アクセスは許可されていません。');
                }

                // 論理削除
                $player->del_fig=$player->del_fig ? 0 : 1;
                $player->save();
            }
            return redirect('index1/1');
        }


}






