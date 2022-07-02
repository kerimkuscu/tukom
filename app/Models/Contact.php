<?php

namespace App\Models;

use App\Traits\HashId;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Contact
 *
 * @property int         $id
 * @property string      $name
 * @property string      $email
 * @property string      $phone
 * @property string      $subject
 * @property string      $message
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read string        $hashed_id
 *
 * @method static Builder|Contact newModelQuery()
 * @method static Builder|Contact newQuery()
 * @method static Builder|Contact query()
 * @method static Builder|Contact whereCreatedAt($value)
 * @method static Builder|Contact whereEmail($value)
 * @method static Builder|Contact whereId($value)
 * @method static Builder|Contact whereMessage($value)
 * @method static Builder|Contact whereName($value)
 * @method static Builder|Contact wherePhone($value)
 * @method static Builder|Contact whereSubject($value)
 * @method static Builder|Contact whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Contact extends Model
{
    use HasFactory, HashId;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
    ];
}
