<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParkingTransactionModel extends Model
{
	use HasFactory;
	use SoftDeletes;
	protected $table   = 'parking_transaction';
	public $primarykey = 'id';
	public $timestamps = true;

	protected $fillable = [
		'user_id','trx_code','plate_number', 'checkin_time','checkout_time','price_total'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [
		'created_at','deleted_at','updated_at'
	];
	protected $dates = [
		'checkin_time','checkout_time'
	];

	public function user()
	{
		return $this->belongsTo('App\Models\Admin\UsersModel', 'user_id', 'id');
	}

}
