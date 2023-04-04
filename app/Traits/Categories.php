<?php 

namespace App\Traits;

trait Categories {

    public $from_trait_mode_of_payments = [
        'Cash',
        'GCash',
        'Credit Card',
        'Coins.ph',
        'Other',
    ];

    public $from_trait_order_status = [
        [
            'title' => 'Pending',
            'value' => 1,
            'icon'  => 'bi bi-arrow-clockwise'
        ], [
            'title' => 'Ordered',
            'value' => 2,
            'icon'  => 'bi bi-box-seam'
        ], [
            'title' => 'On the way',
            'value' => 3,
            'icon'  => 'bi bi-truck'
        ], [
            'title' => 'Received',
            'value' => 4,
            'icon'  => 'bi bi-check2-circle'
        ], [
            'title' => 'Awaiting',
            'value' => 5,
            'icon'  => 'bi bi-hourglass'
        ], [
            'title' => 'Claimed',
            'value' => 6,
            'icon'  => 'bi bi-check-circle'
        ], [
            'title' => 'Canceled',
            'value' => 7,
            'icon'  => 'bi bi-x-circle'
        ]
    ];

    public $from_trait_reorder_status = [
        [
            'title' => 'Pending',
            'value' => 1,
            'icon'  => 'bi bi-arrow-clockwise'
        ], [
            'title' => 'Ordered',
            'value' => 2,
            'icon'  => 'bi bi-box-seam'
        ], [
            'title' => 'On the way',
            'value' => 3,
            'icon'  => 'bi bi-truck'
        ], [
            'title' => 'Received',
            'value' => 4,
            'icon'  => 'bi bi-check2-circle'
        ]
    ];

    public $from_trait_pt_appointment_status = [
        [
            'title' => 'Scheduled',
            'value' => 1
        ], [
            'title' => 'No Show',
            'value' => 2
        ], [
            'title' => 'Canceled',
            'value' => 3
        ], [
            'title' => 'Completed',
            'value' => 4
        ], 
    ];

    public $from_trait_pt_purpose = [
        [
            'purpose'   => 'Purpose 1',
            'value'     => 1
        ], [
            'purpose'   => 'Purpose 2',
            'value'     => 2
        ], [
            'purpose'   => 'Purpose 3',
            'value'     => 3
        ]
    ];
}