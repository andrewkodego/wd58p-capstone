<?php

namespace App\Traits;

use App\Models\Option;

trait OptionsList{

    public function getOptionListByGroupId($groupId){
        return Option::where('group_id', $groupId)->orderBy('sort_order','asc')->orderBy('name', 'asc')->get();
    }

    public function getArticleStatusList(){
        return $this->getOptionListByGroupId(config('constants.OG_ARTICLE_STAT'));
    }
}