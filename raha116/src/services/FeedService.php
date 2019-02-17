<?php


namespace services;


use models\FeedEntry;
use models\UploadedFile;
use repositories\FeedRepository;

class FeedService
{
    /**
     * @var FeedRepository
     */
    private $feedRepository;

    /**
     * @var ImageService
     */
    private $imageService;
    /**
     * @var SessionService
     */
    private $sessionService;

    /**
     * FeedService constructor.
     * @param FeedRepository $feedRepository
     * @param ImageService $imageService
     * @param SessionService $sessionService
     */
    public function __construct(FeedRepository $feedRepository, ImageService $imageService, SessionService $sessionService)
    {
        $this->feedRepository = $feedRepository;
        $this->imageService = $imageService;
        $this->sessionService = $sessionService;
    }


    /**
     * Creates a new feed entry
     *
     * @param string $title
     * @param string $description
     * @param UploadedFile $image
     * @return FeedEntry
     */
    public function create_feed_entry(string $title, string $description, UploadedFile $image): FeedEntry
    {
        $image_entry = $this->imageService->save_image($image);

        $user_id = $this->sessionService->get_active_user_id();

        $feed_entry = $this->feedRepository->create_feed_entry($user_id, $image_entry->image_id, $description, $title);

        return new FeedEntry(
            $this->imageService->get_image_url($image_entry),
            $feed_entry->title,
            $feed_entry->description,
            $user_id,
            $feed_entry->user_id == $user_id
        );
    }
}