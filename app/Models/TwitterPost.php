<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TwitterPost extends Model
{
    protected $table = 'twitter_posts';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'twitter_handle_id', 'twitter_id', 'post_name', 'post_message', 'link', 'media', 'hashtags', 'mentions', 'favourites', 'comments', 'retweets', 'internal_favourites', 'internal_comments', 'internal_retweets', 'created_time', 'flag',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public static function getPost($twitter_id)
    {
        $query = Self::where('twitter_id', $twitter_id)->where('flag', 1);
        $post = $query->first();

        return $post;
    }

    public static function updateData($id, $action)
    {
        $query = Self::where('id', $id)->where('flag', 1);

        $post = $query->first();
        $post['internal_'.$action] += 1;
        $post->save();
    }
}
