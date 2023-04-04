<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Role;
use App\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public $roles = [
        [
            'name' => 'super-admin',
            'display_name' => 'Super admin user',
            'description' => 'Application owner'
        ], [
            'name' => 'admin',
            'display_name' => 'Admin user',
            'description' => 'Application rent owner'
        ], [
            'name' => 'staff',
            'display_name' => 'Staff user',
            'description' => 'Rent owner staff'
        ]
    ];

    public $permissions = [

        //payments
        [
            'name'          => 'payment-manage',
            'display_name'  => 'Manage Payments'
        ],
        //end payments


        //purchase
        [
            'name'          => 'purchase-manage',
            'display_name'  => 'Manage Purchase'
        ],
        //end purchase


        //patient
        [
            'name'          => 'patient-manage',
            'display_name'  => 'Manage Patient'
        ], [
            'name'          => 'patient-delete',
            'display_name'  => 'Delete Patient'
        ], [
            'name'          => 'patient-exam-manage',
            'display_name'  => 'Manage Patient Exam'
        ], [
            'name'          => 'patient-order-manage',
            'display_name'  => 'Manage Patient Orders'
        ], [
            'name'          => 'patient-appointment-manage',
            'display_name'  => 'Manage Patient Appointment'
        ],
        //end patient






        //inventory items
        [
            'name'          => 'item-manage',
            'display_name'  => 'Manage Item'
        ], [
            'name'          => 'item-quantity-edit',
            'display_name'  => 'Edit Item Quantity'
        ], [
            'name'          => 'item-cost-edit',
            'display_name'  => 'Edit Item Cost'
        ], [
            'name'          => 'item-price-edit',
            'display_name'  => 'Edit Item Price'
        ], 
        
        //end inventory items

        //reorder
        [
            'name'          => 'reorder-manage',
            'display_name'  => 'Manage Reorders',
        ],
        //end reorder

        //inventory category
        [
            'name'          => 'category-manage',
            'display_name'  => 'Manage Category'
        ],
        //end inventory category

        //supplier
        [
            'name'          => 'supplier-manage',
            'display_name'  => 'Manage Supplier',
        ],
        //end supplier

        //users
        [
            'name'          => 'user-view',                  
            'display_name'  => 'View User'
        ]
    ];

    public function run()
    {
        foreach ($this->permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission['name'],
                'display_name' => $permission['display_name'], // optional
            ]);
        }

        foreach ($this->roles as $role) {
            Role::firstOrCreate([
                'name' => $role['name'],
                'display_name' => $role['display_name'], // optional
                'description' => $role['description'], // optional
            ]);
        }
    }
}