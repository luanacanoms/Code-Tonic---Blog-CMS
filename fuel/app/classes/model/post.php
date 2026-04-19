<?php
class Model_Post extends Orm\Model {
protected static $_properties = array(
    'id',
    'title',
    'slug',
    'category',
    'excerpt',
    'content',
    'image_url',
    'status',
    'created_at',
    'updated_at',
);

}