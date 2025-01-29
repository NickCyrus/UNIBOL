<?php

namespace App\Models;

use App\Models\ie\functions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modulesapp extends functions
{
    use HasFactory;

    protected $table = "modulesapps";
    protected $fillable = ['id'];

    
    public function getSubmenuAttribute(){
        return $this->hasMany(modulesapp::class ,'id_parent', 'id')
        ->whereIn('id',active_user()->permission)
        ->StatusActive()
        ->orderBy('orderapp');
    }

    static public function menuTop($id = ''){
        $module = getCurrentRouteGroup();
        $parent = modulesapp::query();
        if (!$id) $parent->where('urlapp', $module);
        if ($id)  $parent->where('id', $id);
        $res  = $parent->first();
        
        if ($res && $res->id_parent){
            return modulesapp::menuTop($res->id_parent);
        }else{
            return $res->id ?? '';
        }

    
    }

    public function is_parent(){
        $module = getCurrentRouteGroup();
        return modulesapp::where('urlapp', $module)->first()->id_parent ?? '';
    }

    public function activeRoute(){
        $module = getCurrentRouteGroup();
        return  ($this->urlapp == $module) ?  $this->urlapp : false;
    }

    

    public function getParentNameAttribute(){
        return  ($this->id_parent) ? modulesapp::where('id',$this->id_parent)->first()->nameapp : '<span class="badge bg-label-warning">Master</span>';
    }
 
    

}
