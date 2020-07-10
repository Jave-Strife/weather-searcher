<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // お気に入りの一覧を取得するメソッド
    public function favorites(){
        return $this->belongsToMany( City::class, 'favorites', 'user_id', 'city_id')->withTimestamps();
    }

    public function favorite( $city_id ){
        // 既にお気に入りにしているかの確認
        $exist = $this->is_favoriting( $city_id );

        // 同じ投稿かどうかの確認
        $its_me = $this->city_id == $city_id;

        if( $exist && !$its_me ){
            // 既にお気に入りなら何もしない
            return false;
        } else {
            // 未お気に入りならお気に入りにする
            $this->favorites()->attach( $city_id );
            return true;
        }
    }

    public function unfavorite( $city_id ){
        // 既にお気に入りにしているかの確認
        $exist = $this->is_favoriting( $city_id );

        // 既にお気に入りにしているかの確認
        $its_me = $this->city_id == $city_id;

        if( $exist && !$its_me ){
            // 既にお気に入りなら外す
            $this->favorites()->detach( $city_id );
            return true;
        } else {
            // 未お気に入りであれば何もしない
            return false;
        }
    }

    public function is_favoriting( $city_id ){
        return $this->favorites()->where('city_id', $city_id )->exists();
    }
}