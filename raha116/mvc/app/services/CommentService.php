<?php


namespace services;


use models\Comment;
use models\CommentDatabaseEntry;
use repositories\CommentRepository;

class CommentService
{

    /**
     * @var CommentRepository
     */
    private $comment_repository;

    /**
     * @var SessionService
     */
    private $session_service;

    /**
     * CommentService constructor.
     * @param CommentRepository $comment_repository
     * @param SessionService $session_service
     */
    public function __construct(CommentRepository $comment_repository, SessionService $session_service)
    {
        $this->comment_repository = $comment_repository;
        $this->session_service = $session_service;
    }


    /**
     * Create a new comment on the given feed entry
     *
     * @param int $feed_entry_id
     * @param string $text
     * @return Comment
     */
    public function create_comment(int $feed_entry_id, string $text): Comment
    {
        $user_id = $this->session_service->get_active_user_id();

        $entry = $this->comment_repository->add_comment($user_id, $text, $feed_entry_id);

        return $this->convert_database_entry_to_comment($entry, $user_id);
    }

    /**
     * Converts the given database entry into a normal comment object
     *
     * @param CommentDatabaseEntry $entry
     * @param int $user_id
     * @return Comment
     */
    private function convert_database_entry_to_comment(CommentDatabaseEntry $entry, int $user_id): Comment
    {
        return new Comment($entry->text, $entry->user_id, $entry->user_id == $user_id, $entry->comment_id, $entry->feed_entry_id);
    }

    /**
     * Gets the comments for the given feed entry
     *
     * @param int $feed_entry_id
     * @return Comment[]
     */
    public function get_comments_for_feed_entry(int $feed_entry_id): array
    {
        $user_id = $this->session_service->get_active_user_id();
        $entries = $this->comment_repository->get_comments_for_feed_entry($feed_entry_id);

        $comments = array();

        foreach ($entries as $entry) {
            $comments[] = $this->convert_database_entry_to_comment($entry, $user_id);
        }

        return $comments;
    }
}