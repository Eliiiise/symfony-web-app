<?php

declare(strict_types=1);

namespace App\Converter;
use League\CommonMark\CommonMarkConverter;

final class MarkdownConverter
{
    public function toHtml(string $content): string
    {
        $converter = new CommonMarkConverter([
            'html_input' => 'strip',
            'allow_unsafe_link' => false,
        ]);

        $rendererContent = $converter->convert($content);
        return $rendererContent->getContent();
    }
}