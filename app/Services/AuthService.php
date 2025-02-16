<?php
    namespace App\Services;

    use App\Mail\NotifyOnboarUser;
    use App\Models\Role;
    use App\Models\User;
    use App\Notifications\DatabaseNotification;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Mail;
    use Illuminate\Support\Facades\Session;
    use Patienceman\Notifier\Notifier;

    class AuthService {
        /**
         * $providerUser Socialite user array
         * @var array
         */
        protected $providerUser;

        /**
         * @param $providerUser Socialite/Custom user object
         * @param $providerName Social/Custom auth provider
         */
        public static function handle(array $providerUser) {
            $self = new self;
            $self->providerUser = $providerUser;
            return $self;
        }

        /**
         * If a user has registered before using social auth,
         * update or create
         *
         * @return  User
         */
        public function updateOrCreateUser() {
            $authUser = User::where('email', $this->providerUser['email'])->first();

            return  ($authUser)
                    ? $this->updateUser($authUser)
                    : $this->createUser(Role::USER);
        }

        /**
         * Create new user
         *
         * @return  User
         */
        public function createUser($role) {
            $user = User::create($this->providerUser);
            $user->userMetaData()->create();
            $user->attachRole($role);

            (new Notifier())->send([
                DatabaseNotification::process([
                    "subject" => "Welcome to Norldverse - blogs",
                    "message" => "You account have been created, you can view different written stories or request to become a writter",
                    'action' => "/"
                ])->to($user)
            ]);

            Mail::to($this->providerUser['email'])->send(new NotifyOnboarUser($user));

            return $user;
        }

        /**
         * Update current user
         *
         * @param User $user
         * @return User
         */
        public function updateUser($user) {
            $user->update($this->providerUser);
            return $user;
        }

        /**
         * Update current user
         *
         * @param User $user
         * @return User
         */
        public static function accessToken(User $user) {
            return $user->createToken('client')->accessToken;
        }

        /**
         * Login user
         * @return void
         */
        public static function login($authUser) :void {
            Auth::login($authUser, true);
        }

        /**
         * logout authenticated user
         * @return void
         */
        public static function logout() :void {
            Session::flush();
            Auth::logout();
        }
    }
