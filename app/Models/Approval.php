<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
	protected $fillable = [
		'username',
		'userid',
		'department',
		'dateout',
		'datein',
		'reason',
		'title',
		'slackid',
		'type',
		'body'
	];
	
	public function getUsernameAttribute($value)
	{
		return ucfirst(str_replace('.', ' ', $this->slack($value)->name));
	}
	
    public function scopeFilter($query, $request)
    {
        return $query->whereDate('created_at', '>=', $request->from)
                ->whereDate('created_at', '<=', $request->to);
    }
	
	public function slack($username)
	{
		return Slack::where('slackid', $username)->first();
	}
	
}
