<?php

namespace App\View\Components\Navigation;

use App\Models\User;
use Closure;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class Sidebar extends Component
{

    public function render($withSalesAndTickets=0): View|Closure|string
    {

        $currentRouteName = Route::currentRouteName();
        $user_id = $this->id = auth()->id();
        $loginSellerStatus = User::where('USER_id', $user_id)->value('USER_state');


        if (Auth::check()) {


            if (Auth::user()->isBroker()) {
                if (Session::has('imitating') == 'true') {


                    $brokermenu = [
                        ['name' => 'Sellers', 'routeName' => 'adminUserImitate']
                    ];
                    $listItems = [
                        ['name' => 'Tickets', 'routeName' => 'tickets.show'],
                        ['name' => 'Nachrichten', 'routeName' => 'message.show'],
                    ];

                    $order_main_menu =
                        ['name' => 'Aufträge', 'routeName' => 'assignments'];

                    $settings = ['name' => 'profile', 'routeName' => 'profile'];

                    $einstellungen = ['name' => 'Einstellungen', 'routeName' => 'settings'];

                    $settingsItems = [
                        ['name' => 'Auszahlungen', 'routeName' => 'payoffs.show'],
                        ['name' => 'Profileinstellungen', 'routeName' => 'profile.edit'],

                    ];
                    $einstellungenItems = [
                        ['name' => 'Verkäuferkonto', 'routeName' => 'auth.settings'],
                        ['name' => 'Adresse', 'routeName' => 'auth.address'],
                        ['name' => 'Kontoverbindung', 'routeName' => 'auth.accountinfo'],
                        ['name' => 'Benachrichtigungen', 'routeName' => 'auth.notifications']
                    ];
                    $additionalListItems = [
                        ['name' => 'Unter Prüfung', 'routeName' => 'sales.underTest'],
                        ['name' => 'Zu versenden', 'routeName' => 'sales.send'],
                        ['name' => 'Versendet', 'routeName' => 'sales.sent'],
                        ['name' => 'Ausgezahlt', 'routeName' => 'sales.paid']
                    ];

                    return view('components.navigation.sidebar', ['sellerStatus' => $loginSellerStatus], compact('listItems', 'additionalListItems','einstellungenItems', 'einstellungen','order_main_menu', 'brokermenu', 'settings', 'settingsItems'));

                }
                else {
                    $listItems = [
                        ['name' => 'Tickets', 'routeName' => 'tickets.show'],
                        ['name' => 'Nachrichten', 'routeName' => 'message.show']
                    ];
                    $order_main_menu =
                        ['name' => 'Aufträge', 'routeName' => 'assignments'];

                    $settings = ['name' => 'profile', 'routeName' => 'profile'];

                    $einstellungen = ['name' => 'Einstellungen', 'routeName' => 'settings'];

                    $settingsItems = [
                        ['name' => 'Auszahlungen', 'routeName' => 'payoffs.show'],
                        ['name' => 'Profileinstellungen', 'routeName' => 'profile.edit'],

                    ];
                    $einstellungenItems = [
                        ['name' => 'Verkäuferkonto', 'routeName' => 'auth.settings'],
                        ['name' => 'Adresse', 'routeName' => 'auth.address'],
                        ['name' => 'Kontoverbindung', 'routeName' => 'auth.accountinfo'],
                        ['name' => 'Benachrichtigungen', 'routeName' => 'auth.notifications']
                    ];
                    $additionalListItems = [
                        ['name' => 'Unter Prüfung', 'routeName' => 'sales.underTest'],
                        ['name' => 'Zu versenden', 'routeName' => 'sales.send'],
                        ['name' => 'Versendet', 'routeName' => 'sales.sent'],
                        ['name' => 'Ausgezahlt', 'routeName' => 'sales.paid']
                    ];

                    return view('components.navigation.sidebar', ['sellerStatus' => $loginSellerStatus], compact('listItems', 'additionalListItems', 'einstellungen','einstellungenItems', 'order_main_menu', 'settings', 'settingsItems'));
                }
            }

            elseif (Auth::user()->isAdmin()) {
                $listItems = [
                    ['name' => 'Sellers', 'routeName' => 'adminUserImitate'],
                    ['name' => 'Nachrichten', 'routeName' => 'message.show'],
                    ['name' => 'Genehmigungsanfrage', 'routeName' => 'approval']

                ];
                $additionalListItems = [

                ];

                return view('components.navigation.sidebar', ['sellerStatus' => $loginSellerStatus], compact('listItems', 'additionalListItems'));
            }
        }
        Auth::logout();
        return redirect('login');
       // return view('components.navigation.sidebar', ['sellerStatus' => $loginSellerStatus], compact('listItems', 'additionalListItems', 'order_main_menu', 'settings', 'settingsItems'));
    }
}
