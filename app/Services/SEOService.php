<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Tag;

class SEOService
{

    /**
     * Get Default Meta Tags SEO
     * @return array
     */
    public static function getMetaTagDefault(): array
    {
        return [
            'title' => config('app.name'),
            'description' => "Welcome to our blog! Discover articles about PHP, Laravel development, industry news, useful tips, and performance optimization.",
            'image' => asset('storage/img/logo.png'),
            'keywords' => "PHP, Laravel, development, news, tips, performance, optimization," . config('app.name'),
        ];
    }

    /**
     * Add Meta Tags SEO
     * @param \App\Models\Post $post
     * @return array
     */
    public static function getMetaTagPost($post): array
    {
        return [
            'title' => $post->title . ' - ' . config('app.name'),
            'description' => self::setMetaTagDescription($post->content),
            'image' => asset('storage/' . optional($post->postImage)->path),
            'keywords' => $post->postTags->pluck('tag.name')->implode(',') . ',' . $post->category_name . ',' . config('app.name'),
        ];
    }

    /**
     * Generate meta description
     * @param string $content
     * @param int $maxLength
     * @return string
     */
    public static function setMetaTagDescription($content, $maxLength = 200)
    {
        // Strip HTML tags
        $plainText = strip_tags($content);

        // Trim and limit length
        $plainText = trim($plainText);
        if (mb_strlen($plainText) > $maxLength) {
            $plainText = mb_substr($plainText, 0, $maxLength - 3) . '...';
        }

        // Remove special characters and non-alphanumeric characters
        return preg_replace('/[^a-zA-Z0-9\s]/', '', $plainText);
    }

}
