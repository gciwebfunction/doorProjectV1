<?php

namespace Junges\ACL\Models;

use Illuminate\Database\Eloquent\Model;
use Junges\ACL\Concerns\ACLWildcardsTrait;
use Junges\ACL\Concerns\GroupsTrait;
use Junges\ACL\Events\GroupSaving;

class Group extends Model
{
    use GroupsTrait;
    use ACLWildcardsTrait;

    protected $dates = ['deleted_at'];
    protected $table;

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'description',
    ];

    protected $dispatchesEvents = [
        'creating' => GroupSaving::class,
    ];

    /**
     * Group constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable(config('acl.tables.groups'));
    }

    public function getRouteKeyName()
    {
        return config('acl.route_model_binding_keys.group_model', 'slug');
    }
}
