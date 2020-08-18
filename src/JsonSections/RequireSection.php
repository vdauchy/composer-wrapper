<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\JsonSections;

use VDauchy\ComposerWrapper\JsonSections\Abstracts\AssocSection;

class RequireSection extends AssocSection
{
    /**
     * @param string $key
     * @param string $value
     * @param array|null $repository
     * @return $this
     */
    public function add(string $key, $value, ?array $repository = null): AssocSection
    {
        parent::add($key, $value);
        if ($repository) {
            $this->json->repositories(fn(RepositoriesSection $repositoriesSection) => $repositoriesSection
                ->append($repository));
        }
        return $this;
    }
}
