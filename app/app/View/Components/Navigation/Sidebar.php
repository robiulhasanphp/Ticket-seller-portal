<?php

declare(strict_types=1);

namespace App\View\Components\Navigation;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

/**
 * Sidebar Navigation Component
 *
 * Renders the main navigation sidebar with role-based menu items.
 * Supports broker (admin) and seller user types with different menu structures.
 */
class Sidebar extends Component
{
    /**
     * Render the sidebar navigation based on user role and status.
     *
     * @param int $withSalesAndTickets Whether to include sales/ticket items
     * @return View|Closure|string
     */
    public function render(int $withSalesAndTickets = 0): View|Closure|string
    {
        if (!Auth::check()) {
            Auth::logout();
            return redirect('login');
        }

        $user = Auth::user();
        $currentRouteName = Route::currentRouteName();
        $userId = auth()->id();
        $sellerStatus = User::where('USER_id', $userId)->value('USER_state') ?? 'inactive';

        // Build menu based on user role
        if ($user->isBroker()) {
            return $this->renderBrokerMenu($sellerStatus);
        }

        if ($user->isAdmin()) {
            return $this->renderAdminMenu($sellerStatus);
        }

        // Fallback for unknown roles
        Auth::logout();
        return redirect('login');
    }

    /**
     * Build broker (seller) navigation menu.
     *
     * Includes tickets, messages, orders, and settings with special handling
     * for seller imitation mode.
     *
     * @param string $sellerStatus
     * @return View
     */
    private function renderBrokerMenu(string $sellerStatus): View
    {
        $isImitating = Session::has('imitating') && Session::get('imitating') === 'true';

        $brokerMenu = $isImitating
            ? [['name' => 'Sellers', 'routeName' => 'adminUserImitate']]
            : [];

        $listItems = [
            ['name' => 'Tickets', 'routeName' => 'tickets.show'],
            ['name' => 'Nachrichten', 'routeName' => 'message.show'],
        ];

        $orderMainMenu = ['name' => 'Aufträge', 'routeName' => 'assignments'];

        $settingsMenu = ['name' => 'Einstellungen', 'routeName' => 'settings'];

        $settingsItems = [
            ['name' => 'Auszahlungen', 'routeName' => 'payoffs.show'],
            ['name' => 'Profileinstellungen', 'routeName' => 'profile.edit'],
        ];

        $settingsSubItems = [
            ['name' => 'Verkäuferkonto', 'routeName' => 'auth.settings'],
            ['name' => 'Adresse', 'routeName' => 'auth.address'],
            ['name' => 'Kontoverbindung', 'routeName' => 'auth.accountinfo'],
            ['name' => 'Benachrichtigungen', 'routeName' => 'auth.notifications'],
        ];

        $additionalListItems = [
            ['name' => 'Unter Prüfung', 'routeName' => 'sales.underTest'],
            ['name' => 'Zu versenden', 'routeName' => 'sales.send'],
            ['name' => 'Versendet', 'routeName' => 'sales.sent'],
            ['name' => 'Ausgezahlt', 'routeName' => 'sales.paid'],
        ];

        return view('components.navigation.sidebar', [
            'sellerStatus' => $sellerStatus,
        ], [
            'brokerMenu' => $brokerMenu,
            'listItems' => $listItems,
            'additionalListItems' => $additionalListItems,
            'orderMainMenu' => $orderMainMenu,
            'settingsMenu' => $settingsMenu,
            'settingsItems' => $settingsItems,
            'settingsSubItems' => $settingsSubItems,
        ]);
    }

    /**
     * Build admin navigation menu.
     *
     * Includes seller management, messages, and approval requests.
     *
     * @param string $sellerStatus
     * @return View
     */
    private function renderAdminMenu(string $sellerStatus): View
    {
        $listItems = [
            ['name' => 'Sellers', 'routeName' => 'adminUserImitate'],
            ['name' => 'Nachrichten', 'routeName' => 'message.show'],
            ['name' => 'Genehmigungsanfrage', 'routeName' => 'approval'],
        ];

        $additionalListItems = [];

        return view('components.navigation.sidebar', [
            'sellerStatus' => $sellerStatus,
        ], compact('listItems', 'additionalListItems'));
    }
}

