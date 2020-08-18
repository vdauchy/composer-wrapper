<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Tests\Unit\JsonSection;

use VDauchy\ComposerWrapper\Json;
use VDauchy\ComposerWrapper\JsonSections\AutoloadDevSection;
use VDauchy\ComposerWrapper\JsonSections\AutoloadSection;
use VDauchy\ComposerWrapper\JsonSections\ConfigSection;
use VDauchy\ComposerWrapper\JsonSections\DescriptionSection;
use VDauchy\ComposerWrapper\JsonSections\KeywordsSection;
use VDauchy\ComposerWrapper\JsonSections\LicenseSection;
use VDauchy\ComposerWrapper\JsonSections\NameSection;
use VDauchy\ComposerWrapper\JsonSections\RepositoriesSection;
use VDauchy\ComposerWrapper\JsonSections\RequireDevSection;
use VDauchy\ComposerWrapper\JsonSections\RequireSection;
use VDauchy\ComposerWrapper\JsonSections\ScriptsSection;
use VDauchy\ComposerWrapper\JsonSections\TypeSection;
use VDauchy\ComposerWrapper\Tests\Unit\TestCase;

class JsonTest extends TestCase
{
    public function testJsonSerializable()
    {
        $json = Json::buildFromContent();
        $this->assertInstanceOf(Json::class, $json);
        $this->assertJson(json_encode($json), "Json must be JsonSerializable");
    }

    public function testAutoload()
    {
        $json = Json::buildFromContent();
        $json->autoload(fn(AutoloadSection $autoloadSection) => $autoloadSection
            ->excludeFromClassmap(fn(AutoloadSection\ExcludeFromClassmapSection $excludeFromClassmapSection) => $excludeFromClassmapSection
                ->append('MyClassA')
                ->append('MyClassB'))
            ->psr4(fn(AutoloadSection\Psr4Section $psr4Section) => $psr4Section
                ->add('pathA', 'ClassA')
                ->add('pathB', 'ClassB')));
        $this->assertJsonStringEqualsJsonString(json_encode($json), json_encode([
            'autoload' => [
                'exclude-from-classmap' => [
                    'MyClassA',
                    'MyClassB'
                ],
                'psr-4' => [
                    'pathA' => 'ClassA',
                    'pathB' => 'ClassB'
                ]
            ]
        ]));
    }

    public function testAutoloadDev()
    {
        $json = Json::buildFromContent();
        $json->autoloadDev(fn(AutoloadDevSection $autoloadDevSection) => $autoloadDevSection
            ->excludeFromClassmap(fn(AutoloadSection\ExcludeFromClassmapSection $excludeFromClassmapSection) => $excludeFromClassmapSection
                ->append('MyClassDevA')
                ->append('MyClassDevB'))
            ->psr4(fn(AutoloadSection\Psr4Section $psr4Section) => $psr4Section
                ->add('pathA', 'ClassDevA')
                ->add('pathB', 'ClassDevB')));
        $this->assertJsonStringEqualsJsonString(json_encode($json), json_encode([
            'autoload-dev' => [
                'exclude-from-classmap' => [
                    'MyClassDevA',
                    'MyClassDevB'
                ],
                'psr-4' => [
                    'pathA' => 'ClassDevA',
                    'pathB' => 'ClassDevB'
                ]
            ]
        ]));
    }

    public function testConfig()
    {
        $json = Json::buildFromContent();
        $json->config(fn(ConfigSection $configSection) => $configSection
            ->optimizeAutoloader(fn(ConfigSection\OptimizeAutoloader $optimizeAutoloader) => $optimizeAutoloader
                ->put(true))
            ->preferredInstall(fn(ConfigSection\PreferredInstall $preferredInstall) => $preferredInstall
                ->add('my-organization/stable-package', 'dist')
                ->add('my-organization/*', 'source')
                ->add('partner-organization/*', 'auto')
                ->add('*', 'dist'))
            ->sortPackages(fn(ConfigSection\SortPackages $sortPackages) => $sortPackages
                ->put(true)));
        $this->assertJsonStringEqualsJsonString(json_encode($json), json_encode([
            'config' => [
                'optimize-autoloader'   => true,
                'preferred-install'     => [
                    'my-organization/stable-package'    =>  'dist',
                    'my-organization/*'                 =>  'source',
                    'partner-organization/*'            =>  'auto',
                    '*'                                 =>  'dist'
                ],
                'sort-packages'         => true
            ]
        ]));
    }

    public function testDescription()
    {
        $json = Json::buildFromContent();
        $json->description(fn(DescriptionSection $descriptionSection) => $descriptionSection
            ->put('Some Description'));
        $this->assertJsonStringEqualsJsonString(json_encode($json), json_encode([
            'description' => 'Some Description'
        ]));
    }

    public function testLicense()
    {
        $json = Json::buildFromContent();
        $json->license(fn(LicenseSection $licenseSection) => $licenseSection
            ->put('MIT'));
        $this->assertJsonStringEqualsJsonString(json_encode($json), json_encode([
            'license' => 'MIT'
        ]));
    }

    public function testName()
    {
        $json = Json::buildFromContent();
        $json->name(fn(NameSection $nameSection) => $nameSection
            ->put('Some Name'));
        $this->assertJsonStringEqualsJsonString(json_encode($json), json_encode([
            'name' => 'Some Name'
        ]));
    }

    public function testKeywords()
    {
        $json = Json::buildFromContent();
        $json->keywords(fn(KeywordsSection $keywordsSection) => $keywordsSection
            ->append('k1')
            ->append('k2')
            ->prepend('k3'));
        $this->assertJsonStringEqualsJsonString(json_encode($json), json_encode([
            'keywords' => [
                'k3',
                'k1',
                'k2',
            ]
        ]));
    }

    public function testRequire()
    {
        $json = Json::buildFromContent();
        $json->require(fn(RequireSection $requireSection) => $requireSection
            ->add('myPachageA', '^1.2')
            ->add('privatePackage', 'dev-master', [
                'type'  =>  'git',
                'url'   =>  'https://repo.com'
            ])
            ->remove('someOldPackage'));
        $this->assertJsonStringEqualsJsonString(json_encode($json), json_encode([
            'repositories'  =>  [[
                'type'  => 'git',
                'url'   => 'https://repo.com'
            ]],
            'require'   =>  [
                'myPachageA'    =>  '^1.2',
                'privatePackage'=>  'dev-master'
            ]
        ]));
    }

    public function testRequireDev()
    {
        $json = Json::buildFromContent();
        $json->requireDev(fn(RequireDevSection $requireDevSection) => $requireDevSection
            ->add('myDevPachageA', '^0.25')
            ->add('privatePackage', 'dev-develop', [
                'type'  =>  'git',
                'url'   =>  'https://dev-repo.com'
            ])
            ->remove('someOldDevPackage'));
        $this->assertJsonStringEqualsJsonString(json_encode($json), json_encode([
            'repositories'  =>  [[
                'type'  => 'git',
                'url'   => 'https://dev-repo.com'
            ]],
            'require-dev'   =>  [
                'myDevPachageA'    =>  '^0.25',
                'privatePackage'=>  'dev-develop'
            ]
        ]));
    }

    public function testRepositories()
    {
        $json = Json::buildFromContent();
        $json->repositories(fn(RepositoriesSection $repositoriesSection) => $repositoriesSection
            ->append([
                'type'  => 'composer',
                'url'   => 'https://example.org'])
            ->append([
                'type'                      => 'vcs',
                'url'                       => 'http://svn.example.org/projectA/',
                'trunk-path'                => 'Trunk',
                'branches-path'             => 'Branches',
                'tags-path'                 => 'Tags',
                'svn-cache-credentials'     => false])
            ->append([
                'type'      => "package",
                'package'   => [
                'name'      => 'smarty/smarty',
                    'version' => '3.1.7',
                    'dist' => [
                        'url'   =>  'https://www.smarty.net/files/Smarty-3.1.7.zip',
                        'type'  =>  'zip'
                    ],
                    'source' => [
                        'url'       => 'http://smarty-php.googlecode.com/svn/',
                        'type'      => 'svn',
                        'reference' => 'tags/Smarty_3_1_7/distribution/'
                    ],
                    'autoload' => [
                        'classmap'  => ['libs/']
                    ]
                ]
            ])
            ->append([
                'type'  =>  'path',
                'url'   =>  '../../packages/my-package',
                'options'   => [
                    "symlink"   => false
                ]
            ])
            ->append([
                'packagist.org' => false
            ]));
        $this->assertJsonStringEqualsJsonString(json_encode($json), json_encode([
            "repositories" => [
                [
                    "type" => "composer",
                    "url" => "https://example.org"
                ],
                [
                    "branches-path" => "Branches",
                    "svn-cache-credentials" => false,
                    "tags-path" => "Tags",
                    "trunk-path" => "Trunk",
                    "type" => "vcs",
                    "url" => "http://svn.example.org/projectA/"
                ],
                [
                    "package" => [
                        "autoload" => [
                            "classmap" => [
                                "libs/"
                            ]
                        ],
                        "dist" => [
                            "type" => "zip",
                            "url" => "https://www.smarty.net/files/Smarty-3.1.7.zip"
                        ],
                        "name" => "smarty/smarty",
                        "source" => [
                            "reference" => "tags/Smarty_3_1_7/distribution/",
                            "type" => "svn",
                            "url" => "http://smarty-php.googlecode.com/svn/"
                        ],
                        "version" => "3.1.7"
                    ],
                    "type" => "package"
                ],
                [
                    "options" => [
                        "symlink" => false
                    ],
                    "type" => "path",
                    "url" => "../../packages/my-package"
                ],
                [
                    "packagist.org" => false
                ]
            ]
        ]));
    }

    public function testType()
    {
        $json = Json::buildFromContent();
        $json->type(fn(TypeSection $typeSection) => $typeSection
            ->put('library'));
        $this->assertJsonStringEqualsJsonString(json_encode($json), json_encode([
            'type'  =>  'library'
        ]));
    }

    public function testScripts()
    {
        $json = Json::buildFromContent();
        $json->scripts(fn(ScriptsSection $scriptsSection) => $scriptsSection
            ->preInstallCmd(fn(ScriptsSection\PreInstallCmdSection $preInstallCmdSection) => $preInstallCmdSection
                ->append('MyVendor\\MyClass::preInstallCmd'))
            ->postInstallCmd(fn(ScriptsSection\PostInstallCmdSection $postInstallCmdSection) => $postInstallCmdSection
                ->append('MyVendor\\MyClass::postInstallCmd'))
            ->postUpdateCmd(fn(ScriptsSection\PostUpdateCmdSection $postUpdateCmdSection) => $postUpdateCmdSection
                ->append('MyVendor\\MyClass::postUpdateCmd'))
            ->preStatusCmd(fn(ScriptsSection\PreStatusCmdSection $preStatusCmdSection) => $preStatusCmdSection
                ->append('MyVendor\\MyClass::preStatusCmd'))
            ->postStatusCmd(fn(ScriptsSection\PostStatusCmdSection $postStatusCmdSection) => $postStatusCmdSection
                ->append('MyVendor\\MyClass::postStatusCmd'))
            ->preArchiveCmd(fn(ScriptsSection\PreArchiveCmdSection $preArchiveCmdSection) => $preArchiveCmdSection
                ->append('MyVendor\\MyClass::preArchiveCmd'))
            ->postArchiveCmd(fn(ScriptsSection\PostArchiveCmdSection $postArchiveCmdSection) => $postArchiveCmdSection
                ->append('MyVendor\\MyClass::postArchiveCmd'))
            ->preAutoloadDump(fn(ScriptsSection\PreAutoloadDumpSection $preAutoloadDumpSection) => $preAutoloadDumpSection
                ->append('MyVendor\\MyClass::preAutoloadDump'))
            ->postAutoloadDump(fn(ScriptsSection\PostAutoloadDumpSection $postAutoloadDumpSection) => $postAutoloadDumpSection
                ->append('MyVendor\\MyClass::postAutoloadDump'))
            ->postRootPackageInstall(fn(ScriptsSection\PostRootPackageInstall $postRootPackageInstall) => $postRootPackageInstall
                ->append('MyVendor\\MyClass::postRootPackageInstall'))
            ->postCreateProjectCmd(fn(ScriptsSection\PostCreateProjectCmdSection $postCreateProjectCmdSection) => $postCreateProjectCmdSection
                ->append('MyVendor\\MyClass::postCreateProjectCmdSection')));
        $this->assertJsonStringEqualsJsonString(json_encode($json), json_encode([
            "scripts"   => [
                "post-archive-cmd" => [
                    "MyVendor\\MyClass::postArchiveCmd"
                ],
                "post-autoload-dump" => [
                    "MyVendor\\MyClass::postAutoloadDump"
                ],
                "post-create-project-cmd" => [
                    "MyVendor\\MyClass::postCreateProjectCmdSection"
                ],
                "post-install-cmd" => [
                    "MyVendor\\MyClass::postInstallCmd"
                ],
                "post-root-package-install" => [
                    "MyVendor\\MyClass::postRootPackageInstall"
                ],
                "post-status-cmd" => [
                    "MyVendor\\MyClass::postStatusCmd"
                ],
                "post-update-cmd" => [
                    "MyVendor\\MyClass::postUpdateCmd"
                ],
                "pre-archive-cmd" => [
                    "MyVendor\\MyClass::preArchiveCmd"
                ],
                "pre-autoload-dump" => [
                    "MyVendor\\MyClass::preAutoloadDump"
                ],
                "pre-install-cmd" => [
                    "MyVendor\\MyClass::preInstallCmd"
                ],
                "pre-status-cmd" => [
                    "MyVendor\\MyClass::preStatusCmd"
                ]
            ]
        ]));
    }
}
