<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\JsonSections;

use Illuminate\Support\Collection;
use VDauchy\ComposerWrapper\Contracts\SectionListInterface;

class KeywordsSection implements SectionListInterface
{
    private Collection $keywords;

    /**
     * KeywordsSection constructor.
     * @param array|null $keywords
     */
    public function __construct(?array $keywords)
    {
        $this->put($keywords);
    }

    /**
     * @param string $keyword
     * @return $this
     */
    public function append(string $keyword): SectionListInterface
    {
        $this->keywords = $this->keywords->reject($keyword)->add($keyword);
        return $this;
    }

    /**
     * @param string $keyword
     * @return $this
     */
    public function remove(string $keyword): SectionListInterface
    {
        $this->keywords = $this->keywords->reject($keyword);
        return $this;
    }

    /**
     * @param string $keyword
     * @return $this
     */
    public function prepend(string $keyword): SectionListInterface
    {
        $this->keywords = $this->keywords->reject($keyword)->prepend($keyword);
        return $this;
    }

    /**
     * @return array|null
     */
    public function value(): ?array
    {
        return $this->get();
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->keywords->unique()->toArray();
    }

    /**
     * @param array|null $content
     * @return $this|SectionListInterface
     */
    public function put(?array $content = null): SectionListInterface
    {
        $this->keywords = collect($content);
        return $this;
    }
}
