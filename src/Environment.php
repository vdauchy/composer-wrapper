<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper;

use Illuminate\Support\Collection;

class Environment
{
    public const COMPOSER = 'COMPOSER';
    public const COMPOSER_ALLOW_SUPERUSER = 'COMPOSER_ALLOW_SUPERUSER';
    public const COMPOSER_ALLOW_XDEBUG = 'COMPOSER_ALLOW_XDEBUG';
    public const COMPOSER_AUTH = 'COMPOSER_AUTH';
    public const COMPOSER_BIN_DIR = 'COMPOSER_BIN_DIR';
    public const COMPOSER_CACHE_DIR = 'COMPOSER_CACHE_DIR';
    public const COMPOSER_CAFILE = 'COMPOSER_CAFILE';
    public const COMPOSER_DISABLE_XDEBUG_WARN = 'COMPOSER_DISABLE_XDEBUG_WARN';
    public const COMPOSER_DISCARD_CHANGES = 'COMPOSER_DISCARD_CHANGES';
    public const COMPOSER_HOME = 'COMPOSER_HOME';
    public const COMPOSER_HTACCESS_PROTECT = 'COMPOSER_HTACCESS_PROTECT';
    public const COMPOSER_MEMORY_LIMIT = 'COMPOSER_MEMORY_LIMIT';
    public const COMPOSER_MIRROR_PATH_REPOS = 'COMPOSER_MIRROR_PATH_REPOS';
    public const COMPOSER_NO_INTERACTION = 'COMPOSER_NO_INTERACTION';
    public const COMPOSER_PROCESS_TIMEOUT = 'COMPOSER_PROCESS_TIMEOUT';
    public const COMPOSER_ROOT_VERSION = 'COMPOSER_ROOT_VERSION';
    public const COMPOSER_VENDOR_DIR = 'COMPOSER_VENDOR_DIR';
    public const HTTP_PROXY = 'HTTP_PROXY';
    public const HTTP_PROXY_REQUEST_FULLURI = 'HTTP_PROXY_REQUEST_FULLURI';
    public const HTTPS_PROXY_REQUEST_FULLURI = 'HTTPS_PROXY_REQUEST_FULLURI';
    public const COMPOSER_SELF_UPDATE_TARGET = 'COMPOSER_SELF_UPDATE_TARGET';
    public const NO_PROXY = 'NO_PROXY';
    public const COMPOSER_DISABLE_NETWORK = 'COMPOSER_DISABLE_NETWORK';

    /**
     * @var Collection
     */
    protected Collection $variables;

    /**
     * OptionBagAbstract constructor.
     */
    public function __construct()
    {
        $this->variables = collect();
    }

    /**
     * @param string|null $composerJson
     * @return $this
     */
    public function composer(?string $composerJson): self
    {
        $this->variables->put(static::COMPOSER, $composerJson);
        return $this;
    }

    /**
     * @param bool|null $allowSuperuser
     * @return $this
     */
    public function allowSuperuser(?bool $allowSuperuser): self
    {
        $this->variables->put(static::COMPOSER_ALLOW_SUPERUSER, $allowSuperuser);
        return $this;
    }

    /**
     * @param bool|null $allowXdebug
     * @return $this
     */
    public function allowXdebug(?bool $allowXdebug): self
    {
        $this->variables->put(static::COMPOSER_ALLOW_XDEBUG, $allowXdebug);
        return $this;
    }

    /**
     * @param object|null $auth
     * @return $this
     */
    public function auth(?object $auth): self
    {
        $this->variables->put(static::COMPOSER_AUTH, json_encode($auth));
        return $this;
    }

    /**
     * @param string|null $binDir
     * @return $this
     */
    public function binDir(?string $binDir): self
    {
        $this->variables->put(static::COMPOSER_BIN_DIR, $binDir);
        return $this;
    }

    /**
     * @param string|null $cacheDir
     * @return $this
     */
    public function cacheDir(?string $cacheDir): self
    {
        $this->variables->put(static::COMPOSER_CACHE_DIR, $cacheDir);
        return $this;
    }

    /**
     * @param string|null $cafile
     * @return $this
     */
    public function cafile(?string $cafile): self
    {
        $this->variables->put(static::COMPOSER_CAFILE, $cafile);
        return $this;
    }

    /**
     * @param bool|null $disableXdebugWarn
     * @return $this
     */
    public function disableXdebugWarn(?bool $disableXdebugWarn): self
    {
        $this->variables->put(static::COMPOSER_DISABLE_XDEBUG_WARN, $disableXdebugWarn);
        return $this;
    }

    /**
     * @param bool|null $discardChanges
     * @return $this
     */
    public function discardChanges(?bool $discardChanges): self
    {
        $this->variables->put(static::COMPOSER_DISCARD_CHANGES, $discardChanges);
        return $this;
    }

    /**
     * @param string|null $home
     * @return $this
     */
    public function home(?string $home): self
    {
        $this->variables->put(static::COMPOSER_HOME, $home);
        return $this;
    }

    /**
     * @param bool|null $htaccessProtect
     * @return $this
     */
    public function htaccessProtect(?bool $htaccessProtect): self
    {
        $this->variables->put(static::COMPOSER_HTACCESS_PROTECT, $htaccessProtect);
        return $this;
    }

    /**
     * @param int|null $memoryLimit
     * @return $this
     */
    public function memoryLimit(?int $memoryLimit): self
    {
        $this->variables->put(static::COMPOSER_MEMORY_LIMIT, $memoryLimit);
        return $this;
    }

    /**
     * @param string|null $mirrorPathRepos
     * @return $this
     */
    public function mirrorPathRepos(?string $mirrorPathRepos): self
    {
        $this->variables->put(static::COMPOSER_MIRROR_PATH_REPOS, $mirrorPathRepos);
        return $this;
    }

    /**
     * @param bool|null $noInteraction
     * @return $this
     */
    public function noInteraction(?bool $noInteraction): self
    {
        $this->variables->put(static::COMPOSER_NO_INTERACTION, $noInteraction);
        return $this;
    }

    /**
     * @param int|null $processTimeout
     * @return $this
     */
    public function processTimeout(?int $processTimeout): self
    {
        $this->variables->put(static::COMPOSER_PROCESS_TIMEOUT, $processTimeout);
        return $this;
    }

    /**
     * @param string|null $rootVersion
     * @return $this
     */
    public function rootVersion(?string $rootVersion): self
    {
        $this->variables->put(static::COMPOSER_ROOT_VERSION, $rootVersion);
        return $this;
    }

    /**
     * @param string|null $vendorDir
     * @return $this
     */
    public function vendorDir(?string $vendorDir): self
    {
        $this->variables->put(static::COMPOSER_VENDOR_DIR, $vendorDir);
        return $this;
    }

    /**
     * @param string|null $httpProxy
     * @return $this
     */
    public function httpProxy(?string $httpProxy): self
    {
        $this->variables->put(static::HTTP_PROXY, $httpProxy);
        return $this;
    }

    /**
     * @param string|null $httpProxyRequestFulluri
     * @return $this
     */
    public function httpProxyRequestFulluri(?string $httpProxyRequestFulluri): self
    {
        $this->variables->put(static::HTTP_PROXY_REQUEST_FULLURI, $httpProxyRequestFulluri);
        return $this;
    }

    /**
     * @param string|null $httpsProxyRequestFulluri
     * @return $this
     */
    public function httpsProxyRequestFulluri(?string $httpsProxyRequestFulluri): self
    {
        $this->variables->put(static::HTTPS_PROXY_REQUEST_FULLURI, $httpsProxyRequestFulluri);
        return $this;
    }

    /**
     * @param bool|null $selfUpdateTarget
     * @return $this
     */
    public function selfUpdateTarget(?bool $selfUpdateTarget): self
    {
        $this->variables->put(static::COMPOSER_SELF_UPDATE_TARGET, $selfUpdateTarget);
        return $this;
    }

    /**
     * @param array|null $noProxy
     * @return $this
     */
    public function noProxy(?array $noProxy): self
    {
        $this->variables->put(static::NO_PROXY, implode(',', $noProxy));
        return $this;
    }

    /**
     * @param bool|null $composerDisableNetwork
     * @return $this
     */
    public function disableNetwork(?bool $composerDisableNetwork): self
    {
        $this->variables->put(static::COMPOSER_DISABLE_NETWORK, $composerDisableNetwork);
        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this
            ->variables
            ->filter(fn($variable) => ! is_null($variable))
            ->map(fn($variable) => is_bool($variable) ? (int)$variable : $variable)
            ->toArray();
    }
}
