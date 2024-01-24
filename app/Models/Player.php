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
        
        // public function getPlayerCountryById()
        // {
        // return DB::table('players as p')
        //     ->select(       
        //             'p.id',
        //             'p.uniform_num',
        //             'p.position',
        //             'p.club',
        //             'p.name',
        //             'c.name as c_name',
        //             'p.birth',
        //             'p.height',
        //             'p.weight',
        //             'p.del_flg'
        //             )
        //     ->join('countries as c','c.id','=','p.country_id')
        //     ->get();

        // return $this->all();
        // }
    }
?>