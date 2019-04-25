<?php
declare(strict_types=1);

namespace controllers;


use framework\ActionResult;
use framework\ControllerBase;
use models\horribleApi\HorriblePictureEntryCreatedResponse;
use models\horribleApi\HorriblePicturesForUserResponse;
use models\horribleApi\HorribleUploadPictureRequest;
use models\horribleApi\HorribleUserResponse;
use models\UploadedFile;
use models\ValidationError;
use mysql_xdevapi\Exception;
use services\FeedService;
use services\SessionService;
use services\UserService;

class HorribleApiController extends ControllerBase
{

    /**
     * @var UserService
     */
    private $userService;
    /**
     * @var FeedService
     */
    private $feedService;

    /**
     * HorribleApiController constructor.
     * @param UserService $userService
     * @param SessionService $sessionService
     * @param FeedService $feedService
     */
    public function __construct(UserService $userService, SessionService $sessionService, FeedService $feedService)
    {
        parent::__construct($sessionService);
        $this->userService = $userService;
        $this->feedService = $feedService;
    }


    public function getUsers(): ActionResult
    {
        $users = $this->userService->getUsers();

        $badUsers = array();

        foreach ($users as $user) {
            $badUsers[] = new HorribleUserResponse($user->userId, $user->username);
        }

        return $this->Ok($badUsers);
    }

    public function getPicturesForUser(int $path_userId): ActionResult
    {
        $entries = $this->feedService->get_feed_by_user($path_userId);

        $badImages = array();

        foreach ($entries as $entry) {
            $badImages[] = new HorriblePicturesForUserResponse($entry->entryId, $entry->title, $entry->description, $entry->imageUrl);
        }

        return $this->Ok($badImages);
    }

    public function uploadPictureInHorribleWay(int $path_userId, HorribleUploadPictureRequest $body)
    {

        $loginResult = $this->userService->verify_login($body->username, $body->password);

        if (is_string($loginResult)) {
            return new ActionResult(new ValidationError($loginResult), 401);
        }

        if ($loginResult->user_id != $path_userId) {
            // No uploading for other users either
            return new ActionResult(new ValidationError($loginResult), 401);
        }

        $uploadedFile = $this->convertThatShittyBase64HackIntoAProperlyUploadedFileBecauseFuckThatIsBadAndHorribleAndSomebodyShouldBeAshamedToEvenAttemptToTeachSuchCrapToStudents($body->image);

        $file = UploadedFile::fromUploadedFile($uploadedFile);

        $entry = $this->feedService->create_feed_entry($body->title, $body->description, $file);


        // Make sure to delete the temporary file again
        unlink($uploadedFile['tmp_name']);


        return $this->Ok(new HorriblePictureEntryCreatedResponse($entry->entryId));
    }

    /**
     * Does what is says on the method name, and doesn't actually judge you (That much), unlike what it seems to
     * @param string $encodedFile The base64 encoded file
     * @return array
     */
    private function convertThatShittyBase64HackIntoAProperlyUploadedFileBecauseFuckThatIsBadAndHorribleAndSomebodyShouldBeAshamedToEvenAttemptToTeachSuchCrapToStudents(string $encodedFile)
    {
        $tempFileName = tempnam("%TEMP%", "hack");
        $fileHandle = fopen($tempFileName, "0600");

        if ($fileHandle === false) {
            throw new Exception("Could not create temporary file");
        }

        // Automatically converts the file from base64, as per https://stackoverflow.com/a/568217/3950006
        stream_filter_append($fileHandle, 'convert.base64-decode');
        fwrite($fileHandle, $encodedFile);

        fclose($fileHandle);

        $image_info = @getimagesize($tempFileName);

        return array(
            "name" => "base64hack",
            "tmp_name" => $tempFileName,
            "size" => filesize($tempFileName),
            "type" => $image_info['mime'],
            "error" => 0
        );

    }
}