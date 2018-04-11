<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    
    public function RecentAdded()
    {
    	$Recent_added = Contact::orderBy('created_at', 'desc')
                ->get();
    }
}
