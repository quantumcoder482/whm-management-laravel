<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organizations extends Model
{
    //
    protected $table = "organizations";
    protected $fillable = ['org_name', 'domain', 'subdomain', 'super_user', 'super_password', 'admin_user', 'admin_password', 'db_name', 'db_user', 'db_password', 'status', 'created_by', 'owner_name', 'sale_type', 'email'];

}
