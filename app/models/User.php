<?php

class User extends Model
{
    protected $table = 'users';

    public function posts()
    {
        return (new Post)->where('user_id', $this->id)->get();
    }
}