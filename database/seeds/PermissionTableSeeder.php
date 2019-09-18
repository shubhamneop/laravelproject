<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

          'role-list',
          'role-create',
          'role-edit',
          'role-delete',

          'product-list',
          'product-create',
          'product-edit',
          'product-delete',

          'user-list',
          'user-create',
          'user-edit',
          'user-delete',

           'config-list',
           'config-create',
           'config-edit',
           'config-delete',

           'banner-list',
           'banner-create',
           'banner-edit',
           'banner-delete'

           'category-list',
           'category-create',
           'category-edit',
           'category-delete',

           'coupon-list',
           'coupon-create',
           'coupon-edit',
           'coupon-delete',

           'contact-list',
           'contact-create',
           'contact-edit',
           'contact-delete',

             'order-list',
             'order-create',
             'order-edit',
             'order-delete',

             'cms-list',
             'cms-create',
             'cms-edit',
             'cms-delete',

             'report-list',
             'report-create',
             'report-edit',
             'report-delete'


        ];


        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
