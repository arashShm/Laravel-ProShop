<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveCode extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id', 
        'code' ,
        'expired_at'
    ];


    public $timestamps = false ;

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function scopeVerifyCode($query , $code , $user)
    {
        return !! $user->activeCodes()->whereCode($code)->where('expired_at' , '>' , now())->first();
    }


    public function scopeGenerateCode($query , $user)
    {

        //If we want to delete all of the codes for user and regenerate a  new code after getting request each
        // time , we would comment if condition below and add this code before do-while loop :
        // $user->activeCodes()->delete
        if($code = $this->getAliveCodeForUser($user)){
            $code = $code->code ;
        }else{


            do{
                $code = mt_rand(100000, 999999) ;
            }while($this->checkCodeIsUnique($user ,$code));

            //store Code
            $user->activeCodes()->create([
                'code' => $code ,
                'expired_at' => now()->addMinutes(2) 
            ]);
        }

        return $code ;
    }



    public function checkCodeIsUnique($user , $code)
    {
        return !! $user->activeCodes()->whereCode( $code)->first();
    }


    public function getAliveCodeForUser($user)
    {
        return $user->activeCodes()->where('expired_at' , '>' , now())->first();
    }


}
