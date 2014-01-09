/**
 * 自动加载类(使用命名空间 php version >= php 5.3)
 * 可以自动加载本地类和php全局类, 兼容Zend编码规范。
 * @param string $classname
 * @author Liyufeng
 */
function __autoload ($classname)
{
    $classname = ltrim($classname, '\\');
    $classname = str_replace('\\', DIRECTORY_SEPARATOR, $classname);
    $classname = str_replace('_', DIRECTORY_SEPARATOR, $classname);
    $file = __DIR__ . DIRECTORY_SEPARATOR . $classname . '.php';
    
    if (file_exists()) {
        $filename = $file;
        unset($file);
    } else {
        $dirs = explode(':', get_include_path());
        $len = count($dirs);
        foreach ($dirs as $dir) {
            if ($dir == '.' || empty($dir)) {
                $len --;
                continue;
            }
            $file = $dir . DIRECTORY_SEPARATOR . $classname . '.php';
            if (file_exists($file)) {
                $filename = $file;
                unset($file);
                break;
            }
            $len --;
        }
        if ($len === 0) {
            exit("$classname not found!");
        }
    }
    
    require $filename;
}
