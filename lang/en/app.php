<?php

return [
    // Navigation
    'dashboard' => 'Dashboard',
    'profile' => 'Profile',
    'tasks' => 'Tasks',
    'task_statuses' => 'Task Statuses',
    'labels' => 'Task Labels',

    // Leads
    'task_management' => 'Task Management',
    'task_details' => 'Task Details',
    'status_management' => 'Status Management',
    'label_management' => 'Label Management',

    // Elements
    'buttons' => [
        'common' => [
            'view' => 'View',
            'edit' => 'Edit',
            'apply' => 'Apply',
            'update' => 'Update',
            'save' => 'Save',
            'submit' => 'Submit',
            'continue' => 'Continue',
            'delete' => 'Delete',
            'reset' => 'Reset',
            'back' => 'Back',
        ],
        'tasks' => [
            'create' => 'Create task',
        ],
        'task_statuses' => [
            'create' => 'Create status',
        ],
        'labels' => [
            'create' => 'Create label',
        ],
    ],

    // Flash Messages
    'flash' => [
        'dashboard' => [
            'logged_in' => "You're logged in!",
        ],
        'tasks' => [
            'created' => 'Task created successfully',
            'updated' => 'Task updated successfully',
            'deleted' => 'Task deleted successfully',
            'delete_failed' => 'Only the task author can perform this action',
        ],
        'task_statuses' => [
            'created' => 'Status created successfully',
            'updated' => 'Status updated successfully',
            'deleted' => 'Status deleted successfully',
            'delete_failed' => 'Unable to delete status',
        ],
        'labels' => [
            'created' => 'Label created successfully',
            'updated' => 'Label updated successfully',
            'deleted' => 'Label deleted successfully',
            'delete_failed' => 'Unable to delete label',
        ],
    ],

    // Form UI
    'forms' => [
        'tasks' => [
            'title_placeholder' => 'What needs to be done?',
            'description_placeholder' => 'Provide additional context, steps, or notes for completing this task.',
        ],
        'task_statuses' => [
            'name_placeholder' => 'e.g. In Progress, Completed',
        ],
        'labels' => [
            'name_placeholder' => 'e.g. frontend, bug, urgent',
            'description_placeholder' => 'Describe when this label should be applied or its meaning.',
        ],
    ],

    // Field labels
    'fields' => [
        'id' => 'ID',
        'name' => 'Name',
        'title' => 'Title',
        'description' => 'Description',
        'status' => 'Status',
        'labels' => 'Labels',
        'created_by_id' => 'Created by',
        'assigned_to_id' => 'Assigned to',
        'created_at' => 'Created at',
        'actions' => 'Actions',
        'empty' => [
            'assignee' => 'Unassigned',
            'description' => 'No description',
            'labels' => 'No labels',
        ]
    ],

    // Pages
    'pages' => [
        'tasks' => [
            'index' => [
                'title' => 'Filters',
                'subtitle' => 'Specify which tasks to display.',
                'options_all' => 'All',
            ],
            'create' => [
                'title' => 'Create task',
                'subtitle' => 'Add a title, description, and optional assignment details needed for your task.',
            ],
            'edit' => [
                'title' => 'Edit task',
                'subtitle' => 'Update the task information, status, and assignment.',
            ],
            'destroy' => [
                'title' => 'Delete task',
                'subtitle' => 'Are you sure you want to delete this task? This action cannot be undone.',
            ],
        ],
        'task_statuses' => [
            'create' => [
                'title' => 'Create status',
                'subtitle' => 'Add a new status for tasks.',
            ],
            'edit' => [
                'title' => 'Edit status',
                'subtitle' => 'Update the status used for tasks.',
            ],
            'destroy' => [
                'title' => 'Delete status',
                'subtitle' => 'Are you sure you want to delete this status? This action cannot be undone.',
            ],
        ],
        'labels' => [
            'create' => [
                'title' => 'Create label',
                'subtitle' => 'Add a new label for tasks.',
            ],
            'edit' => [
                'title' => 'Edit label',
                'subtitle' => 'Update the label used for tasks.',
            ],
            'destroy' => [
                'title' => 'Delete label',
                'subtitle' => 'Are you sure you want to delete this label? This action cannot be undone.',
            ],
        ],
    ]
];
