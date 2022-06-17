<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\QuickBookToken;
use QuickBooksOnline\API\Facades\Customer;
use QuickBooksOnline\API\DataService\DataService;

class QuickbookController extends Controller
{

    protected $dataService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $configuration = [
            'auth_mode' => config('quickbooks.keys.auth_mode'),
            'ClientID' => config('quickbooks.keys.ClientID'),
            'ClientSecret' => config('quickbooks.keys.ClientSecret'),
            'RedirectURI' => config('quickbooks.keys.RedirectURI'),
            'scope' => "com.intuit.quickbooks.accounting",
            'baseUrl' => config('quickbooks.data_service.base_url')
        ];

        $this->dataService = DataService::Configure($configuration);
    }


    public function connect () {

        $OAuth2LoginHelper = $this->dataService->getOAuth2LoginHelper();
        $authorizationCodeUrl = $OAuth2LoginHelper->getAuthorizationCodeURL();

        return redirect($authorizationCodeUrl);
    }

    public function tokenRefresh (Request $request) {

        // if(!$request->session()->get("refresh_token")){
        //     Auth::logout();
        //     return redirect()->route('login');
        // }

        auth()->user()->quickbook_token ? $refresh_token = auth()->user()->quickbook_token->refresh_token: $refresh_token = Str::random(40);

        $configuration = [
            'auth_mode' => config('quickbooks.keys.auth_mode'),
            'ClientID' => config('quickbooks.keys.ClientID'),
            'ClientSecret' => config('quickbooks.keys.ClientSecret'),
            'refreshTokenKey' => $refresh_token,
            'QBORealmID' => auth()->user()->quickbook_token->realm_id,
            'baseUrl' => config('quickbooks.data_service.base_url')
        ];

        $this->dataService = DataService::Configure($configuration);

        $OAuth2LoginHelper = $this->dataService->getOAuth2LoginHelper();
        $refreshedAccessTokenObj = $OAuth2LoginHelper->refreshToken();

        $error = $OAuth2LoginHelper->getLastError();
        if ($error) {

            Auth::logout();
            return response()->json([
                "error"     => 1,
                "message"   => "Quickbook session aren't regenerated",
            ], 500);
        } else {

            /*
            $request->session()->forget(['realmid', 'access_token', 'refresh_token']);

            $request->session()->put('realmid', $refreshedAccessTokenObj->getRealmID());
            $request->session()->put('access_token', $refreshedAccessTokenObj->getAccessToken());
            $request->session()->put('refresh_token', $refreshedAccessTokenObj->getRefreshToken());
            */

            $expire_at = Carbon::createFromFormat("Y/m/d H:i:s", $refreshedAccessTokenObj->getAccessTokenExpiresAt())->format('Y-m-d H:i:s');
            $refresh_expire_at = Carbon::createFromFormat("Y/m/d H:i:s", $refreshedAccessTokenObj->getRefreshTokenExpiresAt())->format('Y-m-d H:i:s');

            QuickBookToken::updateOrCreate(
                ['user_id' => auth()->user()->id ],
                [
                    "realm_id"  => $refreshedAccessTokenObj->getRealmID(),
                    "access_token"  => $refreshedAccessTokenObj->getAccessToken(),
                    "refresh_token" => $refreshedAccessTokenObj->getRefreshToken(),
                    "access_token_expires_at"   => $expire_at,
                    "refresh_token_expires_at"  => $refresh_expire_at
                ]
            );

            $this->dataService->updateOAuth2Token($refreshedAccessTokenObj);

            return response()->json([
                "error"     => 0,
                "message"   => "Quickbook session regenerated successfully",
            ], 200);
        }
    }

    public function quickbook_response (Request $request) {

        $configuration = [
            'auth_mode' => config('quickbooks.keys.auth_mode'),
            'ClientID' => config('quickbooks.keys.ClientID'),
            'ClientSecret' => config('quickbooks.keys.ClientSecret'),
            'RedirectURI' => config('quickbooks.keys.RedirectURI'),
            'scope' => "com.intuit.quickbooks.accounting",
            'baseUrl' => config('quickbooks.data_service.base_url')
        ];

        $dataService = DataService::Configure($configuration);

        if ($request->has("code") && $request->has("realmId")) {

            $OAuth2LoginHelper = $dataService->getOAuth2LoginHelper();
            $accessTokenObj = $OAuth2LoginHelper->exchangeAuthorizationCodeForToken($request->get("code"), $request->get("realmId"));

            /*
            $request->session()->put('realmid', $accessTokenObj->getRealmID());
            $request->session()->put('access_token', $accessTokenObj->getAccessToken());
            $request->session()->put('refresh_token', $accessTokenObj->getRefreshToken());
            */

            $dataService->updateOAuth2Token($accessTokenObj);
        }

        $user = User::where("realme_id", $accessTokenObj->getRealmID())->first();

        if (empty($user)) {

            $user = User::create([
                "role_id"       => 3,
                "first_name"    => "Quickbook",
                "last_name"     => "User",
                "email"         => $accessTokenObj->getRealmID()."@tracker.com",
                "password"      => bcrypt("Quick-5656"),
                "realme_id"     => $accessTokenObj->getRealmID()
            ]);
        }

        $expire_at = Carbon::createFromFormat("Y/m/d H:i:s", $accessTokenObj->getAccessTokenExpiresAt())->format('Y-m-d H:i:s');
        $refresh_expire_at = Carbon::createFromFormat("Y/m/d H:i:s", $accessTokenObj->getRefreshTokenExpiresAt())->format('Y-m-d H:i:s');

        QuickBookToken::updateOrCreate(
            ['user_id' => $user->id ],
            [
                "realm_id"  => $accessTokenObj->getRealmID(),
                "access_token"  => $accessTokenObj->getAccessToken(),
                "refresh_token" => $accessTokenObj->getRefreshToken(),
                "access_token_expires_at"   => $expire_at,
                "refresh_token_expires_at"  => $refresh_expire_at
            ]
        );

        Auth::login($user, true);

        return redirect()->route("dashboard", [date("m"), date("Y")]);
    }

    public function authorization_response (Request $request) {

        if ($request->has("code") && $request->has("realmId")) {

            $OAuth2LoginHelper = $this->dataService->getOAuth2LoginHelper();
            $accessTokenObj = $OAuth2LoginHelper->exchangeAuthorizationCodeForToken($request->get("code"), $request->get("realmId"));

            $request->session()->put('realmid', $accessTokenObj->getRealmID());
            $request->session()->put('access_token', $accessTokenObj->getAccessToken());
            $request->session()->put('refresh_token', $accessTokenObj->getRefreshToken());

            $this->dataService->updateOAuth2Token($accessTokenObj);
        }

        $request->session()->flash('quickbook', 'Quickbook connect successfully');

        return redirect()->route("dashboard", [date("m"), date("Y")]);
    }

    public function getCustomers (Request $request) {

        $this->dataService = DataService::Configure([
            'auth_mode' => config('quickbooks.keys.auth_mode'),
            'ClientID' => config('quickbooks.keys.ClientID'),
            'ClientSecret' => config('quickbooks.keys.ClientSecret'),
            'accessTokenKey' => $request->session()->get("access_token"),
            'refreshTokenKey' => $request->session()->get("refresh_token"),
            'QBORealmID' => $request->session()->get("realmid"),
            'baseUrl' => config('quickbooks.data_service.base_url')
        ]);

        $customers = $this->dataService->Query("SELECT * FROM CUSTOMER");

        return view('quickbook.customer.index', compact("customers"));
    }

    public function editCustomer ($id, Request $request) {

        $this->dataService = DataService::Configure([
            'auth_mode' => config('quickbooks.keys.auth_mode'),
            'ClientID' => config('quickbooks.keys.ClientID'),
            'ClientSecret' => config('quickbooks.keys.ClientSecret'),
            'accessTokenKey' => $request->session()->get("access_token"),
            'refreshTokenKey' => $request->session()->get("refresh_token"),
            'QBORealmID' => $request->session()->get("realmid"),
            'baseUrl' => config('quickbooks.data_service.base_url')
        ]);

        $customer = $this->dataService->FindById("CUSTOMER", $id);

        return view('quickbook.customer.edit', compact("customer"));
    }

    public function updateCustomer ($id, Request $request) {

        $this->dataService = DataService::Configure([
            'auth_mode' => config('quickbooks.keys.auth_mode'),
            'ClientID' => config('quickbooks.keys.ClientID'),
            'ClientSecret' => config('quickbooks.keys.ClientSecret'),
            'accessTokenKey' => $request->session()->get("access_token"),
            'refreshTokenKey' => $request->session()->get("refresh_token"),
            'QBORealmID' => $request->session()->get("realmid"),
            'baseUrl' => config('quickbooks.data_service.base_url')
        ]);


        $customerToUpdate = $this->dataService->FindById("CUSTOMER", $id);

        $customer = Customer::update($customerToUpdate, [
                        "sparse" => true,
                        "PrimaryEmailAddr" => [
                            "Address" => $request->get("email")
                        ]
                    ]);

        $updatedCustomer = $this->dataService->Update($customer);

        if (empty($updatedCustomer)) {
            $request->session()->flash("success", "Quickbook customer updated successfully.");
        } else {
            $request->session()->flash("success", "Quickbook customer updated successfully.");
        }

        return redirect()->back();
    }

    public function deleteCustomer ($id, Request $request) {

        $this->dataService = DataService::Configure([
            'auth_mode' => config('quickbooks.keys.auth_mode'),
            'ClientID' => config('quickbooks.keys.ClientID'),
            'ClientSecret' => config('quickbooks.keys.ClientSecret'),
            'accessTokenKey' => $request->session()->get("access_token"),
            'refreshTokenKey' => $request->session()->get("refresh_token"),
            'QBORealmID' => $request->session()->get("realmid"),
            'baseUrl' => config('quickbooks.data_service.base_url')
        ]);

        $customerToDelete = $this->dataService->FindById("CUSTOMER", $id);
        $this->dataService->Delete($customerToDelete);

        $request->session()->flash("success", "Quickbook customer deleted successfully.");

        return redirect()->back();
    }

    public function createCustomer () {

        return view('quickbook.customer.create');
    }

    public function storeCustomer (Request $request) {

        $this->dataService = DataService::Configure([
            'auth_mode' => config('quickbooks.keys.auth_mode'),
            'ClientID' => config('quickbooks.keys.ClientID'),
            'ClientSecret' => config('quickbooks.keys.ClientSecret'),
            'accessTokenKey' => $request->session()->get("access_token"),
            'refreshTokenKey' => $request->session()->get("refresh_token"),
            'QBORealmID' => $request->session()->get("realmid"),
            'baseUrl' => config('quickbooks.data_service.base_url')
        ]);

        $newCustomer = Customer::create([
            "FullyQualifiedName" => $request->get("name"),
            "PrimaryEmailAddr" => [
                "Address" => $request->get("email")
            ],
            "PrimaryPhone" => [
                "FreeFormNumber" => $request->get("phone")
            ]
        ]);

        $this->dataService->Add($newCustomer);

        $request->session()->flash("success", "Quickbook customer created successfully.");

        return redirect()->back();
    }

}
