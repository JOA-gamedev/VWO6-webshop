<?php

class Post extends Model
{
    protected $table = 'posts';

    public function user()
    {
        return (new User)->where('id', $this->user_id)->first();
    }
}