<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Place.php';
require_once __DIR__.'/../repository/PlaceRepository.php';


class PlaceController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $messages = [];
    private PlaceRepository $placeRepository;

    public function __construct()
    {
        parent::__construct();
        $this->placeRepository = new PlaceRepository();
    }

    public function places()
    {
        $this->render('places');
    }

    public function getAllPlaces() {
        header('Content-type: application/json');
        http_response_code(200);

        echo json_encode($this->placeRepository->getPlaces());
    }

    public function searchPlaces()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if($contentType === "application/json")
        {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            $search = $decoded['search'] ?? '';
            $animalsAllowed = $decoded['animalsAllowed'] ?? false;

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->placeRepository->searchPlaces($search, $animalsAllowed));
        }
    }

    public function addPlace()
    {
        parent::checkIsLoggedInAndBusiness();

        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.S_FILES['file']['name']
            );

            $place = new Place($_POST['title'], $_POST['description'], $_FILES['file']['name']);

            return $this->render('places', ['messages' => $this->messages, 'place' => $place]);
        }
        $this->render('addPlaces');
    }

    private function validate(array $file)
    {
        if($file['size'] > self::MAX_FILE_SIZE) {
            $this->messages[] = 'File is too large for destination file system.';
            return false;
        }

        if(!isset($file['type']) && !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->messages[] = 'File is not supported.';
            return false;
        }
    }
}