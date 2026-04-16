<?php
class Model_Post extends Orm\Model {
    protected static $_properties = array(
        'id',
        'title',
        'slug',
        'excerpt',
        'content',
        'image_url',
        'created_at',
        'updated_at'
    );
}