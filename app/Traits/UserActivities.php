<?php

namespace App\Traits;

use App\Models\User_activity;
use Illuminate\Support\Facades\Auth;

class UserActivity {
    public static function new($user_activity)
    {
        User_activity::create([
            'user_id' => Auth::user()->id,
            'description' => $user_activity
        ]);
    }
}

trait UserActivities {
    //patient
    public function trait_user_activity_patient_create() {
        UserActivity::new('New Patient has been added.'); 
    }
    public function trait_user_activity_patient_update() {
        UserActivity::new('Patient has been updated.'); 
    }
    public function trait_user_activity_patient_delete() {
        UserActivity::new('Patient has been deleted.'); 
    }
    public function trait_user_activity_patient_appointment_create() {
        UserActivity::new('Appointment has been created.'); 
    }
    //end patient


    // inventory items
    public function trait_user_activity_item_create() {
        UserActivity::new('New inventory item has been added.'); 
    }
    public function trait_user_activity_item_update() {
        UserActivity::new('Inventory item has been updated.'); 
    }
    public function trait_user_activity_item_delete($count_deleted_items) {
        UserActivity::new($count_deleted_items . ' inventory item(s) has been deleted.');
    }
    public function trait_user_activity_in_item() {
        UserActivity::new('New inventory stocks(on hand) has been added.');
    }
    public function trait_user_activity_item_reorder() {
        UserActivity::new('Reorder item.');
    }
    // end inventory items


    // inventory category
    public function trait_user_activity_category_create() {
        UserActivity::new('Item Category has been created.'); 
    }
    public function trait_user_activity_category_update() {
        UserActivity::new('Item Category has been updated.'); 
    }
    public function trait_user_activity_category_delete($count_deleted_category) {
        $subject = 'Category';
        if ($count_deleted_category > 1) 
            $subject = 'Categories';
        UserActivity::new("{$count_deleted_category} Item {$subject} has been deleted."); 
    }
    // end inventory category


    // reorder
    public function trait_user_activity_reorder_status_update() {
        UserActivity::new('Reorder status has been updated.');
    }
    public function trait_user_activity_reorder_cancel() {
        UserActivity::new('Reorder of item has been canceled.');
    }
    public function trait_user_activity_reorder_add_to_inventory() {
        UserActivity::new('Reorder of item has been added to inventory.');
    }
    // end reorder
    

    //supplier
    public function trait_user_activity_supplier_create() {
        UserActivity::new('Supplier has been created.'); 
    }
    public function trait_user_activity_supplier_update() {
        UserActivity::new('Supplier has been updated.'); 
    }
    public function trait_user_activity_supplier_delete() {
        UserActivity::new('Supplier has been deleted.'); 
    }
    //end supplier

    
    //user
    public function trait_user_activity_user_update($user_name) {
        UserActivity::new('User account has been updated: ' . $user_name);
    }
    public function trait_user_activity_user_password_update($user_name) {
        UserActivity::new('User password has been updated: ' . $user_name);
    }
    //end user
}