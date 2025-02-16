<?php

class User extends Model
{
    protected $table = 'users';
    protected $id;

    public function posts()
    {
        return (new Post)->where('user_id', $this->id)->get();
    }
}