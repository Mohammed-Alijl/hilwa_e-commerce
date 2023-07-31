<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            //Dashboards
            'view_dashboard',

            //Orders
            'view_order',
            'add_order',
            'edit_order',

            //Customers
            'view_customer',
            'add_customer',
            'edit_customer',
            'delete_customer',

            //Drivers
            'view_driver',
            'add_driver',
            'edit_driver',
            'delete_driver',

            //Contact Request
            'view_contact-request',
            'add_contact-request',

            //Review
            'view_review',
            'add_review',
            'edit_review',
            'delete_review',

            //Category
            'view_category',
            'add_category',
            'edit_category',
            'delete_category',

            //Product
            'view_product',
            'add_product',
            'edit_product',
            'delete_product',

            //Attribute
            'view_attribute',
            'add_attribute',
            'edit_attribute',
            'delete_attribute',

            //Returns
            'view_return',
            'add_return',
            'edit_return',
            'delete_return',

            //Comment
            'view_comment',

            //Advertisement
            'view_advertisement',
            'add_advertisement',
            'edit_advertisement',
            'delete_advertisement',

            //Marketing
            'view_marketing',
            'add_marketing',
            'edit_marketing',
            'delete_marketing',

            //Coupons
            'view_coupon',
            'add_coupon',
            'edit_coupon',
            'delete_coupon',

            //Unit
            'view_unit',
            'add_unit',
            'edit_unit',
            'delete_unit',

            //Store
            'view_store',
            'add_store',
            'edit_store',
            'delete_store',

            //Setting
            'view_setting',
            'add_setting',
            'edit_setting',
            'delete_setting',

            //Timeslot
            'view_timeslot',
            'add_timeslot',
            'edit_timeslot',
            'delete_timeslot',

            //Users
            'view_user',
            'add_user',
            'edit_user',
            'delete_user',

            //Roles
            'view_role',
            'add_role',
            'edit_role',
            'delete_role',

            //Cities
            'view_city',
            'add_city',
            'edit_city',

            //Zones
            'view_zone',
            'add_zone',
            'edit_zone',
            'delete_zone',

            //Logs
            'view_log',
            'add_log',
            'edit_log',
            'delete_log',

            //Rewards
            'view_reward',
            'add_reward',
            'edit_reward',
            'delete_reward',

            //Cms Pages
            'view_cms-page',
            'add_cms-page',
            'edit_cms-page',
            'delete_cms-page',

            //Holidays
            'view_holiday',
            'add_holiday',
            'edit_holiday',
            'delete_holiday',

            //Chats
            'view_chat',

            //Order Status
            'view_order-status',

            //Pre Sales Customer
            'view_pre-sales-customer',
            'add_pre-sales-customer',
            'edit_pre-sales-customer',
            'delete_pre-sales-customer',

            //Payment Services
            'view_payment-services',

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'admin']);
        }
    }
}
