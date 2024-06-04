<?php

namespace WebProgrammingApi;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
header('Access-Control-Allow-Headers: Content-Type, X-Auth-Token, Origin, Authorization');


use OpenApi\Annotations as OA;
use Flight as Flight;

class Controller {
    /**
     * @OA\Post(
     *     path="/api/register",
     *     summary="Register User",
     *     description="Register a new user with a full name, username, email, password, and phone number",
     *     tags={"Users"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"fullName", "username", "email", "password", "phoneNumber"},
     *             @OA\Property(property="fullName", type="string", example="John Doe"),
     *             @OA\Property(property="username", type="string", example="johndoe", minLength=4, pattern="^[a-zA-Z0-9]+$"),
     *             @OA\Property(property="email", type="string", format="email", example="johndoe@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="Passw0rd!", minLength=8),
     *             @OA\Property(property="phoneNumber", type="string", example="387123456789", pattern="^387\d{8,9}$")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Registration successful",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Registration successful"),
     *             @OA\Property(property="username", type="string", example="johndoe")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Full name is required.")
     *         )
     *     )
     * )
     */

    public function register() {
            $data = Flight::request()->data;
        
            $fullName = $data->fullName;
            $username = Flight::request()->data->username;
            $email = Flight::request()->data->email;
            $password = Flight::request()->data->password;
            $phoneNumber = Flight::request()->data->phoneNumber;

            $reservedUsernames = ['admin', 'root', 'system'];
            $commonPasswords = ['12345678', 'password', '1234567890', 'Admin123', 'unknown', '11111111'];
        
            if (empty($fullName)) {
                Flight::json(['error' => 'Full name is required.'], 400);
                return;
            }

            // Check if the username is already in use (if it's unique)
            //$pdo = new \PDO("mysql:host=localhost;dbname=your_database", "username", "password");
            //$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
            //$stmt->execute(['username' => $username]);
            //$existingUser = $stmt->fetch(\PDO::FETCH_ASSOC);
            //if ($existingUser) {
                //Flight::json(['error' => 'The username is already taken.'], 400);
               // return;
            //}

            // Username: Should be longer than 3 characters.
        
            if (mb_strlen($username) < 3) {
                echo "The username should be longer than 3 characters.";
                die;
            }
        
            // Username: Can only include alphanumeric characters (letters and numbers), no special characters or spaces are allowed.
        
            if (!ctype_alnum($username)) {
                echo "Username can include only letters and numbers, no special characters or spaces!";
                die;
            }

            // Check if username is reserved
            if (in_array(strtolower($username), $reservedUsernames)) {
                Flight::json(['error' => 'The username is reserved and cannot be used.'], 400);
                return;
            }

            // Check password against "Have I Been Pwned"
            //if ($this->isPasswordPwned($password)) {
              //  Flight::json(['error' => 'This password has been found in a data breach. Please choose a different password.'], 400);
                //return;
            //}
            
             // Check if password is commonly used
             if (in_array(strtolower($password), $commonPasswords)) {
                Flight::json(['error' => 'This password is commonly, please think of another one.'], 400);
                return;
            }
        
            // Password: Should be at least 8 characters long.
        
            if (mb_strlen($password) < 8) {
                echo "The password should be at least 8 characters long.";
                die;
            }
        
            // Email Address: Needs to follow a valid email format (example@domain.com).
        
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Invalid email format! Please enter a valid email format (example@domain.com).";
                die;
            }
        
            // Mobile phone number: Must be a mobile phone number
            
           
            if (preg_match('/^387\d{8,9}$/', $phoneNumber)) {
                echo "Mobile phone number is valid.\n";
            } else {
                echo "Mobile phone number is invalid.\n";
            } 

            // If all validations pass
            Flight::json(['message' => 'Registration successful', 'username' => $username]);
        }
        
    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="User Login",
     *     description="Login a user with username or email and password",
     *     tags={"Users"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"username_or_email", "password"},
     *             @OA\Property(property="username_or_email", type="string", example="johndoe"),
     *             @OA\Property(property="password", type="string", format="password", example="Passw0rd!")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login successful",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="You are logged in.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Enter your email or username to log in.")
     *         )
     *     )
     * )
     */
        
     /* Login Endpoint Validations: For the /login endpoint, ensure the username/email and password is sent to the API */
        
        public function login() {
            $data = Flight::request()->data;
        
            if (!isset($data->username_or_email)) {
                Flight::json(["error" => "Enter your email or username to log in."], 400);
                return;
            }
        
            if (!isset($data->password)) {
                Flight::json(["error" => "Enter your password to log in."], 400);
                return;
            }
        
            if (($data->username_or_email === "" && isset($data->password)) || ($data->password === "" && isset($data->username_or_email))) {
                Flight::json(["error" => "Email/username and password fields must be entered."], 400);
                return;
            }
        
            Flight::json(["message" => "You are logged in."]);
        
        }
    }
        

    Flight::route('POST ../register', ['WebProgrammingApi\Controller', 'register']);
    Flight::route('POST ../login', ['WebProgrammingApi\Controller', 'login']);

    