
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
    }
?>