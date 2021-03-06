<?php namespace Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ores
 *
 * @property int                   $tradestation_id
 * @property int                   $cluster_id
 * @property int                   $server_id
 * @property int                   $transaction_type
 * @property int                   $good_type
 * @property int                   $good_id
 * @property double                $value
 * @property double                $amount
 * @property string                $created_at
 * @property string                $updated_at
 * @package Models
 */
class ActiveTransactions extends Model
{
    protected $table = 'active_transactions';
    protected $fillable = ['tradestation_id','cluster_id','server_id', 'transaction_type','good_type','good_id','value','amount','created_at','updated_at'];
}