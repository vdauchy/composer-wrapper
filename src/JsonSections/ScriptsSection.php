<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\JsonSections;

use Closure;
use Illuminate\Support\Collection;
use VDauchy\ComposerWrapper\JsonSections\Abstracts\ParentSection;
use VDauchy\ComposerWrapper\JsonSections\ScriptsSection\PostArchiveCmdSection;
use VDauchy\ComposerWrapper\JsonSections\ScriptsSection\PostAutoloadDumpSection;
use VDauchy\ComposerWrapper\JsonSections\ScriptsSection\PostCreateProjectCmdSection;
use VDauchy\ComposerWrapper\JsonSections\ScriptsSection\PostInstallCmdSection;
use VDauchy\ComposerWrapper\JsonSections\ScriptsSection\PostRootPackageInstall;
use VDauchy\ComposerWrapper\JsonSections\ScriptsSection\PostStatusCmdSection;
use VDauchy\ComposerWrapper\JsonSections\ScriptsSection\PostUpdateCmdSection;
use VDauchy\ComposerWrapper\JsonSections\ScriptsSection\PreArchiveCmdSection;
use VDauchy\ComposerWrapper\JsonSections\ScriptsSection\PreAutoloadDumpSection;
use VDauchy\ComposerWrapper\JsonSections\ScriptsSection\PreInstallCmdSection;
use VDauchy\ComposerWrapper\JsonSections\ScriptsSection\PreStatusCmdSection;

/**
 * @method $this preInstallCmd(Closure $preInstallCmdSection)
 * @method $this postInstallCmd(Closure $postInstallCmdSection)
 * @method $this postUpdateCmd(Closure $postUpdateCmdSection)
 * @method $this preStatusCmd(Closure $preStatusCmdSection)
 * @method $this postStatusCmd(Closure $postStatusCmdSection)
 * @method $this preArchiveCmd(Closure $preArchiveCmdSection)
 * @method $this postArchiveCmd(Closure $postArchiveCmdSection)
 * @method $this preAutoloadDump(Closure $preAutoloadDumpSection)
 * @method $this postAutoloadDump(Closure $postAutoloadDumpSection)
 * @method $this postRootPackageInstall(Closure $postRootPackageInstall)
 * @method $this postCreateProjectCmd(Closure $postCreateProjectCmdSection)
 */
class ScriptsSection extends ParentSection
{
    public const PRE_INSTALL_CMD            = 'pre-install-cmd';
    public const POST_INSTALL_CMD           = 'post-install-cmd';
    public const POST_UPDATE_CMD            = 'post-update-cmd';
    public const PRE_STATUS_CMD             = 'pre-status-cmd';
    public const POST_STATUS_CMD            = 'post-status-cmd';
    public const PRE_ARCHIVE_CMD            = 'pre-archive-cmd';
    public const POST_ARCHIVE_CMD           = 'post-archive-cmd';
    public const PRE_AUTOLOAD_DUMP          = 'pre-autoload-dump';
    public const POST_AUTOLOAD_DUMP         = 'post-autoload-dump';
    public const POST_ROOT_PACKAGE_INSTALL  = 'post-root-package-install';
    public const POST_CREATE_PROJECT_CMD    = 'post-create-project-cmd';

    /**
     * @return Collection
     */
    protected function sections(): Collection
    {
        return collect([
            static::PRE_INSTALL_CMD             =>  PreInstallCmdSection::class,
            static::POST_INSTALL_CMD            =>  PostInstallCmdSection::class,
            static::POST_UPDATE_CMD             =>  PostUpdateCmdSection::class,
            static::PRE_STATUS_CMD              =>  PreStatusCmdSection::class,
            static::POST_STATUS_CMD             =>  PostStatusCmdSection::class,
            static::PRE_ARCHIVE_CMD             =>  PreArchiveCmdSection::class,
            static::POST_ARCHIVE_CMD            =>  PostArchiveCmdSection::class,
            static::PRE_AUTOLOAD_DUMP           =>  PreAutoloadDumpSection::class,
            static::POST_AUTOLOAD_DUMP          =>  PostAutoloadDumpSection::class,
            static::POST_ROOT_PACKAGE_INSTALL   =>  PostRootPackageInstall::class,
            static::POST_CREATE_PROJECT_CMD     =>  PostCreateProjectCmdSection::class,
        ]);
    }
}
