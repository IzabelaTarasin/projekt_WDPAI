<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Place.php';
require_once __DIR__.'/../models/Booking.php';

require_once __DIR__.'/../repository/PlaceRepository.php';
require_once __DIR__.'/../repository/BookingRepository.php';
require_once __DIR__.'/../repository/UserRepository.php';

class PlaceController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private PlaceRepository $placeRepository;
    private BookingRepository $bookingRepository;
    private UserRepository $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->placeRepository = new PlaceRepository();
        $this->bookingRepository = new BookingRepository();
        $this->userRepository = new UserRepository();
    }

    public function places()
    {
        $this->render('places');
    }

    public function place()
    {
        if($this->isGet())
        {
            $id = $_GET["id"];
            $place = $this->placeRepository->getPlace($id);

            $this->render("place", ['place' => $place]);
        }
    }

    public function book()
    {
        $this->checkIsLoggedIn();

        if ($this->isPost())
        {
            $id = $_POST['id'];
            $hasAnimals = $_POST['$hasAnimals'] ?? false;

            try {
                $startDate = new DateTime($_POST['startDate']);
                $endDate = new DateTime($_POST['endDate']);
                $place = $this->placeRepository->getPlace($id);
                $user = $this->userRepository->getUser($_SESSION['user']->getEmail());

                if ($startDate >= $endDate)
                    throw new Exception('End date must be greater than start date');

                if (new DateTime('today') > $startDate)
                    throw new Exception('Past cannot be selected');

                if ($place == null)
                    throw new Exception('No such place!');

                if ($user == null)
                    throw new Exception('No such user!');

                if ($place->getOwnerId() == $user->getId())
                    throw new Exception('Cannot book your own field!');

                if (!$this->bookingRepository->checkIsAvailable($startDate, $endDate, $place->getId()))
                    throw new Exception('Field taken. Choose another date');

                if (!$place->isAnimalsAllowed())
                    $hasAnimals = false;

                $booking = new Booking($user->getId(), $place->getId(), $startDate, $endDate, $hasAnimals);
                $this->bookingRepository->addBooking($booking);

                $this->render("bookSuccess");
            } catch (Exception $e) {
                $this->render("place", ['id' => $id, 'messages' => [$e->getMessage()]]);
            }
        }
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

        try {
            if($this->isPost()) {
                $name = $_POST['name'];
                $description = $_POST['description'];
                $animalsAllowed = $_POST['animalsAllowed'] ?? false;

                $postalCode = $_POST['postal-code'];
                $city = $_POST['city'];
                $number = $_POST['number'];
                $street = $_POST['street'];

                if($name == null)
                    throw new Exception('Name cannot be empty');

                if($description == null)
                    throw new Exception('Description cannot be empty');

                if($postalCode == null)
                    throw new Exception('Postal code cannot be empty');

                if($city == null)
                    throw new Exception('City cannot be empty');

                if($number == null)
                    throw new Exception('Number cannot be empty');

                if($street == null)
                    throw new Exception('Street cannot be empty');

                $imagePath = null;

                if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                    $this->validateImageFile($_FILES['file']);

                    $tempFile = $_FILES['file']['tmp_name'];
                    $uniqueFileName = $this->createUniqueFilePath();
                    $imagePath = self::UPLOAD_DIRECTORY.$uniqueFileName;
                    move_uploaded_file($tempFile, dirname(__DIR__).self::UPLOAD_DIRECTORY.$uniqueFileName);
                }

                $user = $this->userRepository->getUser($_SESSION['user']->getEmail());

                if ($user == null)
                    throw new Exception('No such user!');

                $place = new Place(
                    null,
                    $name,
                    $description,
                    $animalsAllowed,
                    $user->getId(),
                    $imagePath,
                    $postalCode,
                    $city,
                    $number,
                    $street);

                $this->placeRepository->addPlace($place);

                header("Location: http://$_SERVER[HTTP_HOST]/places");
            } else {
                $this->render('addPlace');
            }
        } catch (Exception $e) {
            $this->render('addPlace', ['messages' => [$e->getMessage()]]);
        }
    }

    private function createUniqueFilePath() :string {
        $split = explode(".", $_FILES['file']['name']);
        $fileExtension = $split[count($split) - 1];
        return uniqid().".".$fileExtension;
    }

    private function validateImageFile(array $file)
    {
        if($file['size'] > self::MAX_FILE_SIZE) {
            throw new Exception('File too big');
        }

        if(!isset($file['type']) && !in_array($file['type'], self::SUPPORTED_TYPES)) {
            throw new Exception('Wrong type');
        }
    }
}