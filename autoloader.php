<?php

class NamespaceAutoloader
{

  // карта для соответствия неймспейса пути в файловой системе
  protected array $namespacesMap = [];

  public function addNamespace($namespace, $rootDir): bool
  {
    if (is_dir($rootDir)) {
      $this->namespacesMap[$namespace] = $rootDir;
      return true;
    }

    return false;
  }

  public function register()
  {
    spl_autoload_register(array($this, 'autoload'));
  }

  protected function autoload($class): bool
  {
    $pathParts = explode('\\', $class);

    if (is_array($pathParts)) {
      $namespace = array_shift($pathParts);

      if (!empty($this->namespacesMap[$namespace])) {
        $filePath = $this->namespacesMap[$namespace] . '/' . implode('/', $pathParts) . '.php';
        if (is_file($filePath)) {
          require_once $filePath;
          return true;
        }
      }
    }

    return false;
  }
}

$autoloader = new NamespaceAutoloader();
$autoloader->addNamespace('PHPUnit', __DIR__ . '/../PHPUnit/phpunit');
$autoloader->register();