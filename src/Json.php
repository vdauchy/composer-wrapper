<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper;

use Illuminate\Support\Collection;
use stdClass;
use VDauchy\ComposerWrapper\JsonSections\Abstracts\ParentSection;
use VDauchy\ComposerWrapper\JsonSections\AutoloadDevSection;
use VDauchy\ComposerWrapper\JsonSections\AutoloadSection;
use VDauchy\ComposerWrapper\JsonSections\ConfigSection;
use VDauchy\ComposerWrapper\JsonSections\DescriptionSection;
use VDauchy\ComposerWrapper\JsonSections\KeywordsSection;
use VDauchy\ComposerWrapper\JsonSections\LicenseSection;
use VDauchy\ComposerWrapper\JsonSections\NameSection;
use VDauchy\ComposerWrapper\JsonSections\RepositoriesSection;
use VDauchy\ComposerWrapper\JsonSections\RequireDevSection;
use VDauchy\ComposerWrapper\JsonSections\ScriptsSection;
use Closure;
use JsonSerializable;
use VDauchy\ComposerWrapper\JsonSections\RequireSection;
use VDauchy\ComposerWrapper\JsonSections\TypeSection;

/**
 * @property AutoloadSection $autoload
 * @property AutoloadDevSection $autoloadDev
 * @property ConfigSection $config
 * @property DescriptionSection $description
 * @property LicenseSection $license
 * @property NameSection $name
 * @property KeywordsSection $keywords
 * @property RequireSection $require
 * @property RequireDevSection $requireDev
 * @property RepositoriesSection $repositories
 * @property TypeSection $type
 * @property ScriptsSection $scripts
 * @method $this autoload(Closure $autoload)
 * @method $this autoloadDev(Closure $autoloadDev)
 * @method $this config(Closure $config)
 * @method $this description(Closure $description)
 * @method $this license(Closure $license)
 * @method $this name(Closure $name)
 * @method $this keywords(Closure $keywords)
 * @method $this require(Closure $require)
 * @method $this requireDev(Closure $requireDev)
 * @method $this repositories(Closure $repositories)
 * @method $this type(Closure $type)
 * @method $this scripts(Closure $scripts)
 */
class Json extends ParentSection implements JsonSerializable
{
    public const AUTOLOAD     = 'autoload';
    public const AUTOLOAD_DEV = 'autoload-dev';
    public const CONFIG       = 'config';
    public const DESCRIPTION  = 'description';
    public const LICENSE      = 'license';
    public const NAME         = 'name';
    public const KEYWORDS     = 'keywords';
    public const REQUIRE      = 'require';
    public const REQUIRE_DEV  = 'require-dev';
    public const REPOSITORIES = 'repositories';
    public const TYPE         = 'type';
    public const SCRIPTS      = 'scripts';

    /**
     * @var Collection
     */
    protected Collection $structure;

    /**
     * @param string $content
     * @return static
     */
    public static function buildFromContent(string $content = ''): self
    {
        return new static((array)json_decode($content, true));
    }

    /**
     * @return JsonSerializable|object
     */
    public function jsonSerialize()
    {
        return $this->structure->isNotEmpty() ? $this->structure->filter()->sortKeys() : new stdClass();
    }

    /**
     * @return Collection
     */
    protected function sections(): Collection
    {
        return collect([
            static::AUTOLOAD      =>  AutoloadSection::class,
            static::AUTOLOAD_DEV  =>  AutoloadDevSection::class,
            static::CONFIG        =>  ConfigSection::class,
            static::DESCRIPTION   =>  DescriptionSection::class,
            static::LICENSE       =>  LicenseSection::class,
            static::NAME          =>  NameSection::class,
            static::KEYWORDS      =>  KeywordsSection::class,
            static::REQUIRE       =>  RequireSection::class,
            static::REQUIRE_DEV   =>  RequireDevSection::class,
            static::REPOSITORIES  =>  RepositoriesSection::class,
            static::TYPE          =>  TypeSection::class,
            static::SCRIPTS       =>  ScriptsSection::class
        ]);
    }
}
