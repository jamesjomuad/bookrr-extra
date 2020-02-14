<?php namespace Bookrr\Extra;

use Backend;
use System\Classes\PluginBase;
use Event;



class Plugin extends PluginBase
{

    public function pluginDetails()
    {
        return [
            'name'        => 'Extra plugin.',
            'description' => 'Form widgets, Tools & etc.',
            'author'      => 'bookrr',
            'icon'        => 'icon-leaf'
        ];
    }

    public function boot()
    {
        Event::listen('backend.page.beforeDisplay', function ($controller, $action, $params) {
            $controller->addCss('/plugins/bookrr/extra/assets/css/extra.css','v1.0');  
        });
    }

    public function registerFormWidgets()
    {
        return[
            'Bookrr\Extra\FormWidgets\DateTimePicker' => [
                'label' => 'Bootstrap Datetime picker',
                'code' => 'datetimepicker'
            ]
        ];
    }

    public function registerListColumnTypes()
    {
        return [
            'tag' => [$this, 'tagListColumn'],
            'dot' => [$this, 'dotListColumn'],
            'url' => [$this, 'urlListColumn'],
        ];
    }

    public function tagListColumn($value, $column, $record)
    {
        return implode(" ",[
            '<button type="button" class="btn btn-secondary btn-xs '.strtolower($record->getPriorityOptions()[$value]).'">',
            $record->getPriorityOptions()[$value],
            '</button>'
        ]);
    }

    public function dotListColumn($value, $column, $record)
    {
        if($value)
            return '<i class="fas fa-dot-circle" style="color: lime;"></i>';
        else
            return '<i class="fas fa-dot-circle"></i>';
    }

    public function urlListColumn($value, $column, $record)
    {
        return '<a href="'.$value.'" target="_blank" rel="noopener noreferrer">'.$value.'</a>';
    }

}
