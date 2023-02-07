<?php 
class UserController extends Controller {
    private $userModel;
    
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }
    public function processRequest(string $method, ?int $id = 0) : void 
    {
        if($id) $this->processResourceRequest($method, $id);
        else
            $this->processCollectionRequest($method);
    }

    private function processResourceRequest(string $method, string $id){
        $user = $this->userModel->selectUser($id);
                if(!$user){
                    http_response_code(402);
                    echo json_encode(['error'=>"User don't find"]);
                    
                }
        switch ($method){
            case "GET":
                echo json_encode($user);
                break;
            case "PATCH":
                $data =(array) json_decode(file_get_contents("php://input"), true);
                $errors=$this->getValidationError($data);
                if(!empty($errors)){
                    http_response_code(442);
                    echo json_encode(["errors" => $errors]);
                    break;
                }
                $rows = $this->userModel->updateUser($data, $user);
                
                echo json_encode([
                    "message" => "User $id updated",
                    "rows" => $rows
                ]);
                break;
            case "DELETE": 
                    $rows =  $this->userModel->delete($id);
                    echo json_encode([
                        "message"=> "User $id is deleted",
                        "row" => $rows
                    ]);
                    break;
            default:
                    http_response_code(405);
                    header("ALlow: GET,POST");
                break;
        }
    
    }
    private function processCollectionRequest(string $method){
        switch ($method){
            case "GET": 
               echo json_encode($this->userModel->getAll());
               break;
            
            case "POST":
                $data =(array) json_decode(file_get_contents("php://input"), true);
                $errors=$this->getValidationError($data);
                if(!empty($errors)){
                    http_response_code(442);
                    echo json_encode(["errors" => $errors]);
                    break;
                }
                $id = $this->userModel->insertUser($data);
                http_response_code(201);
                echo json_encode([
                    "message" => "User created",
                    "id" => $id
                ]);
                break;

                default:
                    http_response_code(405);
                    header("ALlow: GET,POST");
        }
    }

    private function getValidationError(array $data) : array{
        $errors = [];
        if (empty($data["nom"])){
            $errors[] = "nom est nessaicere";
        } 
        if(empty($data["prenom"])){

            $errors[] = "Prenom est importent!";
        
        }
        return $errors;

    }
}
