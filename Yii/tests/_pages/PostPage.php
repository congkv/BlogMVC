<?php

/**
 * This class represents single publication page.
 *
 * @version    0.1.0
 * @since      0.1.0
 * @package    BlogMVC
 * @subpackage YiiTests
 * @author     Fike Etki <etki@etki.name>
 */
class PostPage extends \ContentPage
{
    /**
     * Post page url pattern.
     *
     * @var string
     * @since 0.1.0
     */
    public static $url = '/<slug>';
    /**
     * Regexp for matching urls.
     *
     * @type string
     * @since 0.1.0
     */
    public static $urlRegexp = '~/([\w\-]+)~u';
    /**
     * Yii controller rout for post page.
     *
     * @var string
     * @since 0.1.0
     */
    public static $route = 'post/show';
    /**
     * Comment form selector.
     *
     * @var string
     * @since 0.1.0
     */
    public static $commentForm = '#comment-form';
    /**
     * Comment username field name.
     *
     * @var string
     * @since 0.1.0
     */
    public static $commentUsernameField = 'Comment[username]';
    /**
     * Comment email field name.
     *
     * @var string
     * @since 0.1.0
     */
    public static $commentEmailField = 'Comment[mail]';
    /**
     * Comment text field name.
     *
     * @var string
     * @since 0.1.0
     */
    public static $commentTextArea = 'Comment[content]';
    /**
     * Comment publication button selector.
     *
     * @var string
     * @since 0.1.0
     */
    public static $commentSubmitButton = '[role="post-comment"]';
    /**
     * Delete comment button selector.
     *
     * @var string
     * @since 0.1.0
     */
    public static $deleteCommentLink = 'div.row.user-comment [role="delete-comment"]';
    /**
     * CSS selector for user comment.
     *
     * @type string
     * @since 0.1.0
     */
    public static $commentSelector = 'div.row.user-comment';

    /**
     * Returns url for particular post by it's slug.
     *
     * @param string $slug Post slug.
     *
     * @return mixed
     * @since 0.1.0
     */
    public static function route($slug)
    {
        return str_replace('<slug>', $slug, static::$url);
    }

    /**
     * Tells if page has errors.
     *
     * @return void
     * @since 0.1.0
     */
    public function hasErrors()
    {
        $this->guy->seeElement('#comment-form .alert');
    }

    /**
     * Tells if page doesn't have any errors displayed.
     *
     * @return void
     * @since 0.1.0
     */
    public function hasNoErrors()
    {
        $this->guy->dontSeeElement('#comment-form .alert');
    }

    /**
     * Extracts post slug.
     *
     * @param string $url URL to parse.
     *
     * @return mixed
     * @since 0.1.0
     */
    public static function extractSlug($url)
    {
        if (strlen($url) === 0) {
            throw new \BadMethodCallException('Url can\'t be empty');
        }
        if ($url[0] !== '/') {
            $url = '/'.$url;
        }
        if (!preg_match(static::$urlRegexp, $url, $m) || !$m[1]) {
            throw new \BadMethodCallException('Invalid URL passed');
        }
        return $m[1];
    }
}