<?php


namespace SocialRss\Parser\Vk;

class PostParser
{
    public $parser;

    private $item;
    private $users;

    private $typeMap = [
        'post' => Posts\PostPost::class,
        'photo' => Posts\PhotoPost::class,
        'photo_tag' => Posts\PhotoTagPost::class,
        'friend' => Posts\FriendPost::class,
        'note' => Posts\NotePost::class,
        'audio' => Posts\AudioPost::class,
        'video' => Posts\VideoPost::class,
    ];

    public function __construct($item, $users)
    {
        $this->item = $item;
        $this->users = $users;

        $map = $this->typeMap;
        $type = $this->item['type'];

        if (isset($map[$type])) {
            $this->parser = new $map[$type]($item, $users);
        }
    }

    public function isParserTypeAvailable()
    {
        return isset($this->typeMap[$this->item['type']]);
    }
}