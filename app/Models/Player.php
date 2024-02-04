<?php
    
    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    // use Illuminate\Database\Eloquent\DB;

    class Player extends Model
    {
        use HasFactory;

        public function allPlayer(){
            $players = Player::all();
            // return $players;
            return Player::paginate(20);
        }
        

            public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    protected $casts = [
        'markdown_text' => 'string',
        // escapeWhenCastingToString を false に設定することで、この属性の値がHTMLエスケープされない
        'unescaped_text' => 'string:False',
    ];


    // Player モデルの selectPlayer メソッド
    public function selectPlayer($player_id)
    {
        $player = Player::join('countries as my_country', 'players.country_id', '=', 'my_country.id')
            ->select('my_country.name as my_country_name', 'players.id', 'players.club',
                'players.uniform_num', 'players.position', 'players.name', 'players.birth', 'players.height', 'players.weight')
            ->find($player_id);

        return $player;
    }
    
    // Player モデルの selectGoals メソッド
    public function selectGoals($player_id)
    {
        $goals = Player::where('players.id', '=', $player_id)
            ->join('goals', 'players.id', '=', 'goals.player_id')
            ->join('pairings', 'goals.pairing_id', '=', 'pairings.id')
            ->join('countries as enemy_country', 'pairings.enemy_country_id', '=', 'enemy_country.id')
            ->select('players.id', 'goals.goal_time as goal_time', 'pairings.kickoff as kickoff', 'enemy_country.name as enemy_country')
            ->get();

        return $goals;
    }

    public function selectCountries()
    {
        $countries = Player::join('countries as my_country', 'players.country_id', '=', 'my_country.id')
        ->select('my_country.name as my_country_name')
        ->get();
        return $countries;
    }

    


    
    protected $fillable = [
        'uniform_num',
        'name',
        'position',
        'club',
        'birth',
        'height',
        'weight',
        'my_country_name',
        // 他にも追加が必要なカラムがあればここに追加してください
    ];


    // モデルでのタイムスタンプの有効/無効を制御するプロパティ
    public $timestamps = false;

}

?>