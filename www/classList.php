<?php
$namespace = 'App\Base';
var_dump(get_include_path());
// Relative namespace path
$namespaceRelativePath = str_replace('\\', DIRECTORY_SEPARATOR, $namespace);

// Include paths
$includePathStr = get_include_path();
$includePathArr = explode(PATH_SEPARATOR, $includePathStr);

// Iterate include paths
$classArr = array();
foreach ($includePathArr as $includePath) {
    $path = $includePath . DIRECTORY_SEPARATOR . $namespaceRelativePath;
    if (is_dir($path)) { // Does path exist?
        $dir = dir($path); // Dir handle     
        while (false !== ($item = $dir->read())) {  // Read next item in dir
            $matches = array();
            if (preg_match('/^(?<class>[^.].+)\.php$/', $item, $matches)) {
                $classArr[] = $matches['class'];
            }
        }
        $dir->close();
    }
}

// Debug output
var_dump($includePathArr);
var_dump($classArr);