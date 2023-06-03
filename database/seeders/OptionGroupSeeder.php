<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultGroups = [
            ['name'=>'User Status'],
            ['name'=>'Employment Status'],
            ['name'=>'Payment Method'],
            ['name'=>'Article Status'],
        ];

        foreach($defaultGroups as $group){
            \App\Models\OptionGroup::factory()->create($group);
        }

        $defaultOptions = [
            ['name'=>'Active','code'=>'USTAT_ACT', 'group_id'=>1,'sort_order'=>'a'],
            ['name'=>'Inactive','code'=>'USTAT_INA','group_id'=>1,'sort_order'=>'b'],
            ['name'=>'Archive','code'=>'USTAT_ARC','group_id'=>1,'sort_order'=>'c'],

            ['name'=>'Active','code'=>'EMPSTAT_ACT','group_id'=>2,'sort_order'=>'a'],
            ['name'=>'Separtated','code'=>'EMPSTAT_SEP','group_id'=>2,'sort_order'=>'b'],

            ['name'=>'COD','code'=>'PAY_COD','group_id'=>3],
            ['name'=>'Credit Card','code'=>'PAY_CC','group_id'=>3],
            ['name'=>'GCash','code'=>'PAY_GCASH','group_id'=>3],
            ['name'=>'Maya','code'=>'PAY_MAYA','group_id'=>3],
            ['name'=>'Paypal','code'=>'PAY_PAYPAL','group_id'=>3],

            ['name'=>'Draft','code'=>'ARTSTAT_DRAFT','group_id'=>4,'sort_order'=>'a'],
            ['name'=>'Published','code'=>'ARTSTAT_PUB','group_id'=>4,'sort_order'=>'b'],
            ['name'=>'Archived','code'=>'ARTSTAT_ARC','group_id'=>4,'sort_order'=>'c'],
        ];

        foreach($defaultOptions as $option){
            \App\Models\Option::factory()->create($option);
        }

    }
}
