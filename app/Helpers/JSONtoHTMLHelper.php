<?php

namespace App\Helpers;

class JSONtoHTMLHelper
{
    public static function getMarkList($content)
    {
        $ast = self::getAST($content);
        $tagOpen = '<li style="display: block">';
        $tagClose = '</li>';
        $tagNestedOpen = '<ul class="menu-header" style="display: block">';
        $tagNestedClose = '</ul>';

        $iter = function ($ast) use (&$iter, $tagOpen, $tagClose, $tagNestedOpen, $tagNestedClose) {
            return array_reduce($ast, function ($acc, $node) use ($iter, $tagOpen, $tagClose, $tagNestedOpen, $tagNestedClose) {
                if (is_array($node['value'])) {
                    $value = "{$tagOpen}{$node['key']} ({$node['type']}) :{$tagNestedOpen}{$iter($node['value'])}{$tagNestedClose}{$tagClose}";
                } else {
                    $value = "{$tagOpen}{$node['key']} : {$node['value']} ({$node['type']}){$tagClose}";
                }
                return "{$acc}{$value}";
            }, '');
        };

        return "{$tagNestedOpen}{$iter($ast)}{$tagNestedClose}";
    }
    private static function getAST($content)
    {
        $iter = function ($content) use (&$iter) {
            $keys = array_keys($content);
            return array_map(function ($key) use ($iter, $content) {
                $value = is_array($content[$key]) ? $iter($content[$key]) : $content[$key];
                return [
                    'key' => $key,
                    'type' => getType($content[$key]),
                    'value' => $value,
                 ];
            }, $keys);
        };
        return $iter($content);
    }
}
