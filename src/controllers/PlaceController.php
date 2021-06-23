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
        $this->checkIsLoggedInAndBusiness();

        if($this->isPost()) {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $animalsAllowed = $_POST['animalsAllowed'] ?? false;

            if($name == null)
            {
                return $this->render('addPlace', ['messages' => ['Name cannot be empty']]);
            }

            if($description == null)
            {
                return $this->render('addPlace', ['messages' => ['Description cannot be empty']]);
            }

            if (is_uploaded_file($_FILES['file']['tmp_name']) && $this->isValid($_FILES['file'])) {
                $tempFile = $_FILES['file']['tmp_name'];
                $uniqueFileName = $this->createUniqueFilePath();
                $dir = dirname(__DIR__).self::UPLOAD_DIRECTORY.$uniqueFileName;

                move_uploaded_file($tempFile, $dir);
            }

            $place = new Place($name, $description, $animalsAllowed, null/*, $_FILES['file']['name'] */);
            $this->placeRepository->addPlace($place);

            header("Location: http://$_SERVER[HTTP_HOST]/places");
        }
        $this->render('addPlace');
    }

    private function createUniqueFilePath() :string {
        $split = explode(".", $_FILES['file']['name']);
        $fileExtension = $split[count($split) - 1];
        return uniqid().".".$fileExtension;
    }

    private function isValid(array $file)
    {
        if($file['size'] > self::MAX_FILE_SIZE) {
            $this->messages[] = 'File is too large for destination file system.';
            return false;
        }

        if(!isset($file['type']) && !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->messages[] = 'File is not supported.';
            return false;
        }

        return true;
    }
}