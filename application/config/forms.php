<?php

/*
 * This file is subject to the terms and conditions defined in
 * file 'LICENSE.txt', which is part of this source code package.
 */

$fields = 'fields';
$name = 'name';
$tag = 'tag';
$type = 'type';
$is_db = 'is_db';
$dbname = 'db_name';
$form_attr = 'form_attr';
$title = 'title';
$default = 'default';
$enabled = 'enabled';
$formtitle = 'form_title';
$staticdata = 'staticdata';
$dynamic_data = 'dynamic_data';
$extraclasses = 'extraclasses';
$extras = 'extras';
$table = 'table';
$primary_key = 'primary_key';


$config['stocks'] = array(
    $primary_key => 'id',
    $table => 'stocks',
    $formtitle => 'Stock',
    $fields => array(
        'book' => array(
            $name => 'book',
            $title => 'book',
            $tag => 'select',
            $dynamic_data => 'books,id&name,status=1', //table name,fields,condition
            $dbname => 'book',
            $form_attr => array('integer', 'required')
        ),
        'qty' => array(
            $name => 'Quantity',
            $title => 'qty',
            $tag => 'input',
            $type => 'number',
            $dbname => 'qty',
            $form_attr => array('required', 'numeric')
        ), 'descr_lang1' => array(
            $name => 'descr_lang1',
            $title => 'Notes ',
            $tag => 'textarea',
            $dbname => 'notes',
            $form_attr => array('min_length[1]', 'max_length[4000]')
        )
    )
);


$config['library_user'] = array(
    $primary_key => 'id',
    $table => 'users',
    $formtitle => 'User',
    $fields => array(
        'name' => array(
            $name => 'name',
            $title => 'User Name',
            $tag => 'input',
            $type => 'text',
            $dbname => 'name',
            $form_attr => array('required', 'min_length[2]')
        ),
        'email' => array(
            $name => 'email',
            $title => 'Email Address',
            $tag => 'input',
            $type => 'email',
            $dbname => 'email',
            $form_attr => array(
                'required', 'min_length[2]', 'is_unique[users.email]'
                , 'valid_email'
            )
        ),
        'dob' => array(
            $name => 'dob',
            $title => 'Date of birth ',
            $tag => 'input',
            $type => 'date',
            $dbname => 'dob',
            $form_attr => array('required')
        ),
        'phone' => array(
            $name => 'phone',
            $title => 'Phone Number',
            $tag => 'input',
            $type => 'tel',
            $dbname => 'phone',
            $form_attr => array('min_length[10]', 'is_unique[users.phone]')
        ),
        'address' => array(
            $name => 'address',
            $title => 'User Address ',
            $tag => 'textarea',
            $dbname => 'address',
            $form_attr => array('min_length[15]', 'max_length[4000]')
        ),
        'enabled' => array(
            $name => 'enabled',
            $title => 'Enable this user',
            $tag => 'input',
            $type => 'simple_checkbox',
            $default => 'checked',
            $dbname => 'status',
            $is_db => false
        )
    )
);

$config['books'] = array(
    $primary_key => 'id',
    $table => 'books',
    $formtitle => 'Book',
    $fields => array(
        'name' => array(
            $name => 'name',
            $title => 'Title',
            $tag => 'input',
            $type => 'text',
            $dbname => 'name',
            $form_attr => array('required', 'min_length[2]')
        ),
        'rfid' => array(
            $name => 'rfid',
            $title => 'RFID TAG',
            $tag => 'input',
            $type => 'text',
            $dbname => 'rfid',
            $form_attr => array(
                'required', 'min_length[2]', 'is_unique[books.rfid]'
                , 'alpha_numeric'
            )
        ),
        'descr_lang1' => array(
            $name => 'descr_lang1',
            $title => 'Book Descreption ',
            $tag => 'textarea',
            $dbname => 'descr',
            $form_attr => array('min_length[15]', 'max_length[4000]')
        ),
        'category' => array(
            $name => 'category',
            $title => 'Category',
            $tag => 'select',
            $dynamic_data => 'category,id&name,status=1', //table name,fields,condition
            $dbname => 'category',
            $form_attr => array('integer', 'required')
        ),
        'published' => array(
            $name => 'published',
            $title => 'Published on ',
            $tag => 'input',
            $type => 'date',
            $dbname => 'published'
        ),
        'author' => array(
            $name => 'author',
            $title => 'Author',
            $tag => 'select',
            $dynamic_data => 'author,id&name,status=1', //table name,fields,condition
            $dbname => 'author',
            $form_attr => array('integer', 'required')
        ),
        'enabled' => array(
            $name => 'enabled',
            $title => 'Enable this book',
            $tag => 'input',
            $type => 'simple_checkbox',
            $default => 'checked',
            $dbname => 'status',
            $is_db => false
        )
    )
);


$config['category'] = array(
    $primary_key => 'id',
    $table => 'category',
    $formtitle => 'Category',
    $fields => array(
        'name' => array(
            $name => 'name',
            $title => 'Title',
            $tag => 'input',
            $type => 'text',
            $dbname => 'name',
            $form_attr => array('required', 'min_length[2]')
        ),
        'descr_lang1' => array(
            $name => 'descr_lang1',
            $title => 'Category Descreption ',
            $tag => 'textarea',
            $dbname => 'descr',
            $form_attr => array('min_length[15]', 'max_length[4000]')
        ),
        'enabled' => array(
            $name => 'enabled',
            $title => 'Enable this Category',
            $tag => 'input',
            $type => 'simple_checkbox',
            $default => 'checked',
            $dbname => 'status',
            $is_db => false
        )
    )
);


$config['authors'] = array(
    $primary_key => 'id',
    $table => 'author',
    $formtitle => 'Author',
    $fields => array(
        'name' => array(
            $name => 'name',
            $title => 'Author Name',
            $tag => 'input',
            $type => 'text',
            $dbname => 'name',
            $form_attr => array('required', 'min_length[2]')
        ),
        'dob' => array(
            $name => 'dob',
            $title => 'Date of birth ',
            $tag => 'input',
            $type => 'date',
            $dbname => 'dob',
            $form_attr => array('required')
        ),
        'address' => array(
            $name => 'address',
            $title => 'User Address ',
            $tag => 'textarea',
            $dbname => 'address',
            $form_attr => array('min_length[15]', 'max_length[4000]')
        ),
        'enabled' => array(
            $name => 'enabled',
            $title => 'Enable this user',
            $tag => 'input',
            $type => 'simple_checkbox',
            $default => 'checked',
            $dbname => 'status',
            $is_db => false
        )
    )
);
