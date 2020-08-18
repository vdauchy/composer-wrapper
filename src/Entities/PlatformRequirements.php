<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Entities;

use Illuminate\Support\Collection;

class PlatformRequirements
{
    /**
     *
     */
    private Collection $requirements;

    /**
     * @param Collection $requirements
     */
    public function __construct(Collection $requirements)
    {
        $this->requirements = $requirements
            ->filter()
            ->map(fn(string $requirement) => array_values(array_filter(explode(' ', trim($requirement)))))
            ->mapWithKeys(fn(array $requirement) => [
                $requirement[0] => (object)[
                    'version'   => $requirement[1],
                    'state'     => $requirement[2]
                ]
            ]);
    }

    /**
     * @param string $requirement
     * @return bool
     */
    public function has(string $requirement): bool
    {
        return $this->requirements->has($requirement);
    }

    /**
     * @param string $requirement
     * @return object
     */
    public function get(string $requirement): object
    {
        return $this->requirements->get($requirement);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->requirements;
    }
}
