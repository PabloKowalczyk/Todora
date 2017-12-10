<?php

declare(strict_types=1);

namespace Todora;

use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Config\Loader\LoaderInterface;

final class Kernel extends BaseKernel
{
    private $cacheDir;

    public function __construct($environment, $debug)
    {
        date_default_timezone_set("UTC");

        parent::__construct($environment, $debug);
    }

    public function registerBundles()
    {
        $bundles = [
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new \Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new \Symfony\Bundle\TwigBundle\TwigBundle(),
            new \Symfony\Bundle\MonologBundle\MonologBundle(),
            new \Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new \Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new \League\Tactician\Bundle\TacticianBundle(),
            new \Snc\RedisBundle\SncRedisBundle()
        ];

        if (in_array($this->getEnvironment(), ["dev", "test"], true)) {
            $bundles[] = new \Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new \Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
            $bundles[] = new \Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            
            if ("dev" === $this->getEnvironment()) {
                $bundles[] = new \Matthimatiker\OpcacheBundle\MatthimatikerOpcacheBundle();
                $bundles[] = new \Pixers\DoctrineProfilerBundle\PixersDoctrineProfilerBundle();
            }
        }

        return $bundles;
    }

    public function getRootDir()
    {
        return __DIR__ . "/../app";
    }

    public function getCacheDir()
    {
        if ($this->cacheDir === null) {
            $this->cacheDir = "{$this->getVarDirectory()}/cache/{$this->getEnvironment()}";
        }

        return $this->cacheDir;
    }

    public function getLogDir()
    {
        return "{$this->getVarDirectory()}/logs";
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load("{$this->getRootDir()}/config/config_{$this->getEnvironment()}.yml");
    }

    protected function getKernelParameters()
    {
        return array_merge(
            parent::getKernelParameters(),
            [
                "kernel.var_root_dir" => $this->getVarDirectory()
            ]
        );
    }

    private function getVarDirectory()
    {
        if ($this->getEnvironment() === "dev") {
            return "/dev/shm/todora";
        }

        return dirname(__DIR__) . "/var";
    }
}
