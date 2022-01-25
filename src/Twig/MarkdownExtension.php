<?php

declare(strict_types=1);

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use App\Converter\MarkdownConverter;

final class MarkdownExtension extends AbstractExtension
{
    private $mardownConverter;

    public function __construct(MarkdownConverter $mardownConverter)
    {
        $this->markdiwnConverter = $mardownConverter;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('markdown_to_html', [$this, 'toHtml']),
        ];
    }

    public function toHtml(string $content): string
    {
        return $this->mardownConverter->toHtml($content);
    }
}