<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Quote
 *
 * @property int         $id
 * @property string      $first_name
 * @property string      $last_name
 * @property string      $title
 * @property string      $business
 * @property string      $company
 * @property string      $address
 * @property string      $city_state_zip_country
 * @property string      $phone
 * @property string      $fax
 * @property string      $email
 * @property string      $connector_interested_in
 * @property string      $connector_supplier
 * @property string      $eau
 * @property string      $project_title
 * @property string      $project_start_date
 * @property string      $questions_comments
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|Quote newModelQuery()
 * @method static Builder|Quote newQuery()
 * @method static Builder|Quote query()
 * @method static Builder|Quote whereAddress($value)
 * @method static Builder|Quote whereBusiness($value)
 * @method static Builder|Quote whereCityStateZipCountry($value)
 * @method static Builder|Quote whereCompany($value)
 * @method static Builder|Quote whereConnectorInterestedIn($value)
 * @method static Builder|Quote whereConnectorSupplier($value)
 * @method static Builder|Quote whereCreatedAt($value)
 * @method static Builder|Quote whereEau($value)
 * @method static Builder|Quote whereEmail($value)
 * @method static Builder|Quote whereFax($value)
 * @method static Builder|Quote whereFirstName($value)
 * @method static Builder|Quote whereId($value)
 * @method static Builder|Quote whereLastName($value)
 * @method static Builder|Quote wherePhone($value)
 * @method static Builder|Quote whereProjectStartDate($value)
 * @method static Builder|Quote whereProjectTitle($value)
 * @method static Builder|Quote whereQuestionsComments($value)
 * @method static Builder|Quote whereTitle($value)
 * @method static Builder|Quote whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Quote extends Model
{
    use HasFactory;
}
