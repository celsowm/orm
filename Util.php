<?php

class Util {

    public static function rowParaObject(array $row, string $class_name, ...$campos): ?object {

        if (!empty($campos)) {
            $row = self::fatiarArray($row, ...$campos);
        }
        return self::arrayParaObject($row, $class_name);
    }

    public static function arrayParaObject(array $array, string $class_name): ?object {

        $r = new ReflectionClass($class_name);
        $object = $r->newInstanceWithoutConstructor();
        $list = $r->getProperties();
        foreach ($list as $prop) {
            $prop->setAccessible(true);
            if (isset($array[$prop->name])) {
                $prop->setValue($object, $array[$prop->name]);
            }
        }

        return $object;
    }

    public static function fatiarArray(array $array, ...$campos): ?array {

        return array_intersect_key($array, array_flip($campos));
    }

    public static function montaLinha(array $row, $tag = 'td'): string {
        
        return "<tr>" . implode('', array_map(function($row) use ($tag) {
                            return "<$tag>" . $row . "</$tag>";
                        }, $row)) . "</tr>";
    }

}
