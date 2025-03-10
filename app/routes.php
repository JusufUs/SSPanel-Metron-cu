<?php

declare(strict_types=1);

use App\Controllers\MetronController;
use App\Controllers\VueController;
use Slim\App as SlimApp;
use App\Middleware\{Auth, Guest, Admin, Mod_Mu};
use App\Controllers\Api\V1\Api;

return function (SlimApp $app) {
    // Home
    $app->get('/',          App\Controllers\HomeController::class . ':index');
    $app->get('/404',       App\Controllers\HomeController::class . ':page404');
    $app->get('/405',       App\Controllers\HomeController::class . ':page405');
    $app->get('/500',       App\Controllers\HomeController::class . ':page500');
    $app->get('/tos',       App\Controllers\HomeController::class . ':tos');
    $app->get('/staff',     App\Controllers\HomeController::class . ':staff');
    $app->get('/indexold',  App\Controllers\HomeController::class . ':indexold');

    // other
    $app->get('/spay_back',             App\Services\Payment::class . ':notify');
    $app->post('/spay_back',            App\Services\Payment::class . ':notify');
    $app->get('/tomato_back/{type}',    App\Services\Payment::class . ':notify');
    $app->post('/tomato_back/{type}',   App\Services\Payment::class . ':notify');
    $app->post('/notify',               App\Controllers\HomeController::class . ':notify');

    // Telegram
    $app->post('/telegram_callback',    App\Controllers\HomeController::class . ':telegram');
    $app->post('/user/authcode',        App\Controllers\VueController::class . ':authcode');


    // User Center
    $app->group('/user', function () {
        $this->get('',                          App\Controllers\UserController::class . ':index');
        $this->get('/',                         App\Controllers\UserController::class . ':index');

        $this->post('/checkin',                 App\Controllers\UserController::class . ':doCheckin');

        $this->get('/tutorial',                 App\Controllers\UserController::class . ':tutorial');
        $this->get('/announcement',             App\Controllers\UserController::class . ':announcement');

        $this->get('/donate',                   App\Controllers\UserController::class . ':donate');
        $this->get('/lookingglass',             App\Controllers\UserController::class . ':lookingglass');
        $this->get('/profile',                  App\Controllers\UserController::class . ':profile');
        $this->get('/invite',                   App\Controllers\UserController::class . ':invite');
        $this->get('/disable',                  App\Controllers\UserController::class . ':disable');

        $this->get('/node',                     App\Controllers\User\NodeController::class . ':node');
        $this->get('/node/{id}',                App\Controllers\User\NodeController::class . ':nodeInfo');
        $this->get('/node/{id}/ajax',           App\Controllers\User\NodeController::class . ':nodeAjax');

        $this->get('/detect',                   App\Controllers\UserController::class . ':detect_index');
        $this->get('/detect/log',               App\Controllers\UserController::class . ':detect_log');

        $this->get('/shop',                     App\Controllers\UserController::class . ':shop');
        $this->post('/coupon_check',            App\Controllers\UserController::class . ':CouponCheck');
        $this->post('/buy',                     App\Controllers\UserController::class . ':buy');
        $this->post('/buy_traffic_package',     App\Controllers\UserController::class . ':buy_traffic_package');

        // Relay Mange
        $this->get('/relay',                    App\Controllers\User\RelayController::class . ':index');
        $this->get('/relay/create',             App\Controllers\User\RelayController::class . ':create');
        $this->post('/relay',                   App\Controllers\User\RelayController::class . ':add');
        $this->get('/relay/{id}/edit',          App\Controllers\User\RelayController::class . ':edit');
        $this->put('/relay/{id}',               App\Controllers\User\RelayController::class . ':update');
        $this->delete('/relay',                 App\Controllers\User\RelayController::class . ':delete');

        $this->get('/ticket',                   App\Controllers\User\TicketController::class . ':ticket');
        $this->get('/ticket/create',            App\Controllers\User\TicketController::class . ':ticket_create');
        $this->post('/ticket',                  App\Controllers\User\TicketController::class . ':ticket_add');
        $this->get('/ticket/{id}/view',         App\Controllers\User\TicketController::class . ':ticket_view');
        $this->put('/ticket/{id}',              App\Controllers\User\TicketController::class . ':ticket_update');

        $this->post('/buy_invite',              App\Controllers\UserController::class . ':buyInvite');
        $this->post('/custom_invite',           App\Controllers\UserController::class . ':customInvite');
        $this->get('/edit',                     App\Controllers\UserController::class . ':edit');
        $this->post('/password',                App\Controllers\UserController::class . ':updatePassword');
        $this->post('/wechat',                  App\Controllers\UserController::class . ':updateWechat');
        $this->post('/ssr',                     App\Controllers\UserController::class . ':updateSSR');
        $this->post('/theme',                   App\Controllers\UserController::class . ':updateTheme');
        $this->post('/mail',                    App\Controllers\UserController::class . ':updateMail');
        $this->post('/sspwd',                   App\Controllers\UserController::class . ':updateSsPwd');
        $this->post('/method',                  App\Controllers\UserController::class . ':updateMethod');
        $this->post('/hide',                    App\Controllers\UserController::class . ':updateHide');
        $this->get('/sys',                      App\Controllers\UserController::class . ':sys');
        $this->get('/trafficlog',               App\Controllers\UserController::class . ':trafficLog');
        $this->get('/kill',                     App\Controllers\UserController::class . ':kill');
        $this->post('/kill',                    App\Controllers\UserController::class . ':handleKill');
        $this->get('/logout',                   App\Controllers\UserController::class . ':logout');
        $this->get('/backtoadmin',              App\Controllers\UserController::class . ':backtoadmin');
        $this->get('/code',                     App\Controllers\UserController::class . ':code');
        $this->get('/alipay',                   App\Controllers\UserController::class . ':alipay');

        $this->get('/code_check',               App\Controllers\UserController::class . ':code_check');
        $this->post('/code',                    App\Controllers\UserController::class . ':codepost');
        $this->post('/gacheck',                 App\Controllers\UserController::class . ':GaCheck');
        $this->post('/gaset',                   App\Controllers\UserController::class . ':GaSet');
        $this->get('/gareset',                  App\Controllers\UserController::class . ':GaReset');
        $this->get('/telegram_reset',           App\Controllers\UserController::class . ':telegram_reset');
        $this->post('/resetport',               App\Controllers\UserController::class . ':ResetPort');
        $this->post('/specifyport',             App\Controllers\UserController::class . ':SpecifyPort');
        $this->post('/pacset',                  App\Controllers\UserController::class . ':PacSet');
        $this->post('/unblock',                 App\Controllers\UserController::class . ':Unblock');
        $this->get('/bought',                   App\Controllers\UserController::class . ':bought');
        $this->delete('/bought',                App\Controllers\UserController::class . ':deleteBoughtGet');
        $this->get('/url_reset',                App\Controllers\UserController::class . ':resetURL');
        $this->get('/inviteurl_reset',          App\Controllers\UserController::class . ':resetInviteURL');

        // 订阅记录
        $this->get('/subscribe_log',            App\Controllers\UserController::class . ':subscribe_log');

        // getUserAllURL
        $this->get('/getUserAllURL',            App\Controllers\UserController::class . ':getUserAllURL');

        // getPcClient
        $this->get('/getPcClient',              App\Controllers\UserController::class . ':getPcClient');

        $this->post('/code/f2fpay',             App\Services\Payment::class . ':purchase');
        $this->get('/code/codepay',             App\Services\Payment::class . ':purchase');

        //Reconstructed Payment System
        $this->post('/payment/purchase',        App\Services\Payment::class . ':purchase');
        $this->get('/payment/return',           App\Services\Payment::class . ':returnHTML');
        # Metron
        $this->get('/setting/{page}',           App\Controllers\UserController::class . ':settingPages');
        $this->get('/shared_account',           App\Controllers\MetronController::class . ':SharedAccount');
        $this->get('/nodeinfo/{id}',            App\Controllers\MetronController::class . ':NodeInfo');
        $this->get('/metron',                   App\Controllers\MetronController::class . ':getMetron');
        $this->get('/money',                    App\Controllers\MetronController::class . ':getmoney');
        $this->get('/ajax_data/table/{name}',   App\Controllers\MetronController::class . ':ajax_datatable');
        $this->get('/ajax_data/chart/{name}',   App\Controllers\MetronController::class . ':ajax_datachart');
        $this->get('/formcheck/{type}',         App\Controllers\MetronController::class . ':formCheck');

        $this->post('/changetheme',             App\Controllers\MetronController::class . ':changeTheme');
        $this->post('/setting/{page}',          App\Controllers\MetronController::class . ':updateSetting');
        $this->post('/packageconversion',       App\Controllers\MetronController::class . ':PackageConversion');
        $this->post('/advance_feset_flow',      App\Controllers\MetronController::class . ':advanceResetFlow');
        $this->post('/account_check',           App\Controllers\MetronController::class . ':AccountCheck');
        $this->post('/node_filter',             App\Controllers\MetronController::class . ':nodeFilterSave');

        $this->delete('/ajax_data/delete',      App\Controllers\MetronController::class . ':ajax_datatable_delete');

        // Help Page
        $this->get('/help',                     App\Controllers\MetronController::class . ':Help');
        $this->post('/help',                    App\Controllers\MetronController::class . ':Help');
        // Agent
        $this->get('/agent',                        App\Metron\MtAgent::class . ':pages');
        $this->get('/agent/adduser',                App\Metron\MtAgent::class . ':add_user');
        $this->get('/agent/view/{id}',              App\Metron\MtAgent::class . ':edit_user');
        $this->get('/agent_data/table/{name}',      App\Metron\MtAgent::class . ':ajax_datatable');

        $this->post('/agent/adduser',                App\Metron\MtAgent::class . ':add_user_save');
        $this->post('/agent/view/{id}',              App\Metron\MtAgent::class . ':edit_user_save');
        $this->post('/agent/take_total',            App\Metron\MtAgent::class . ':take_total');
        $this->post('/agent/take_account_setting',  App\Metron\MtAgent::class . ':take_account_setting');
        $this->post('/agent_data/process/{name}',   App\Metron\MtAgent::class . ':ajax_datatable_process');

        $this->delete('/agent_data/delete',         App\Metron\MtAgent::class . ':delete');
    })->add(new Auth());

    $app->group('/payment', function () {
        $this->get('/notify',                  App\Services\Payment::class . ':notify');
        $this->post('/notify',                 App\Services\Payment::class . ':notify');
        $this->get('/notify/{type}',           App\Services\Payment::class . ':notify');
        $this->post('/notify/{type}',          App\Services\Payment::class . ':notify');
        $this->get('/notify/{type}/{method}',  App\Services\Payment::class . ':notify');
        $this->post('/notify/{type}/{method}', App\Services\Payment::class . ':notify');
        $this->post('/status',                 App\Services\Payment::class . ':getStatus');
    });

    // Auth
    $app->group('/auth', function () {
        $this->get('/login',            App\Controllers\AuthController::class . ':login');
        $this->post('/qrcode_check',    App\Controllers\AuthController::class . ':qrcode_check');
        $this->post('/login',           App\Controllers\AuthController::class . ':loginHandle');
        $this->post('/qrcode_login',    App\Controllers\AuthController::class . ':qrcode_loginHandle');
        $this->get('/register',         App\Controllers\AuthController::class . ':register');
        $this->post('/register',        App\Controllers\AuthController::class . ':registerHandle');
        $this->post('/send',            App\Controllers\AuthController::class . ':sendVerify');
        $this->get('/logout',           App\Controllers\AuthController::class . ':logout');
        $this->get('/telegram_oauth',   App\Controllers\AuthController::class . ':telegram_oauth');
        $this->get('/login_getCaptcha', App\Controllers\AuthController::class . ':getCaptcha');
    })->add(new Guest());

    // Password
    $app->group('/password', function () {
        $this->get('/reset',            App\Controllers\PasswordController::class . ':reset');
        $this->post('/reset',           App\Controllers\PasswordController::class . ':handleReset');
        $this->get('/token/{token}',    App\Controllers\PasswordController::class . ':token');
        $this->post('/token/{token}',   App\Controllers\PasswordController::class . ':handleToken');
    })->add(new Guest());

    // Admin
    $app->group('/admin', function () {
        $this->get('',                          App\Controllers\AdminController::class . ':index');
        $this->get('/',                         App\Controllers\AdminController::class . ':index');

        $this->get('/trafficlog',               App\Controllers\AdminController::class . ':trafficLog');
        $this->post('/trafficlog/ajax',         App\Controllers\AdminController::class . ':ajax_trafficLog');
        // Node Mange
        $this->get('/node',                     App\Controllers\Admin\NodeController::class . ':index');

        $this->get('/node/create',              App\Controllers\Admin\NodeController::class . ':create');
        $this->post('/node',                    App\Controllers\Admin\NodeController::class . ':add');
        $this->post('/node/copy',               App\Controllers\Admin\NodeController::class . ':copy');
        $this->get('/node/{id}/edit',           App\Controllers\Admin\NodeController::class . ':edit');
        $this->put('/node/{id}',                App\Controllers\Admin\NodeController::class . ':update');
        $this->delete('/node',                  App\Controllers\Admin\NodeController::class . ':delete');
        $this->post('/node/ajax',               App\Controllers\Admin\NodeController::class . ':ajax');


        $this->get('/ticket',                   App\Controllers\Admin\TicketController::class . ':index');
        $this->get('/ticket/{id}/view',         App\Controllers\Admin\TicketController::class . ':show');
        $this->put('/ticket/{id}',              App\Controllers\Admin\TicketController::class . ':update');
        $this->post('/ticket/ajax',             App\Controllers\Admin\TicketController::class . ':ajax');

        // Relay Mange
        $this->get('/relay',                    App\Controllers\Admin\RelayController::class . ':index');
        $this->get('/relay/create',             App\Controllers\Admin\RelayController::class . ':create');
        $this->post('/relay',                   App\Controllers\Admin\RelayController::class . ':add');
        $this->get('/relay/{id}/edit',          App\Controllers\Admin\RelayController::class . ':edit');
        $this->put('/relay/{id}',               App\Controllers\Admin\RelayController::class . ':update');
        $this->delete('/relay',                 App\Controllers\Admin\RelayController::class . ':delete');
        $this->get('/relay/path_search/{id}',   App\Controllers\Admin\RelayController::class . ':path_search');
        $this->post('/relay/ajax',              App\Controllers\Admin\RelayController::class . ':ajax_relay');

        // Shop Mange
        $this->get('/shop',                     App\Controllers\Admin\ShopController::class . ':index');
        $this->post('/shop/ajax',               App\Controllers\Admin\ShopController::class . ':ajax_shop');

        $this->get('/bought',                   App\Controllers\Admin\ShopController::class . ':bought');
        $this->delete('/bought',                App\Controllers\Admin\ShopController::class . ':deleteBoughtGet');
        $this->post('/bought/ajax',             App\Controllers\Admin\ShopController::class . ':ajax_bought');

        $this->get('/shop/create',              App\Controllers\Admin\ShopController::class . ':create');
        $this->post('/shop',                    App\Controllers\Admin\ShopController::class . ':add');
        $this->get('/shop/{id}/edit',           App\Controllers\Admin\ShopController::class . ':edit');
        $this->put('/shop/{id}',                App\Controllers\Admin\ShopController::class . ':update');
        $this->delete('/shop',                  App\Controllers\Admin\ShopController::class . ':deleteGet');

        // Ann Mange
        $this->get('/announcement',             App\Controllers\Admin\AnnController::class . ':index');
        $this->get('/announcement/create',      App\Controllers\Admin\AnnController::class . ':create');
        $this->post('/announcement',            App\Controllers\Admin\AnnController::class . ':add');
        $this->get('/announcement/{id}/edit',   App\Controllers\Admin\AnnController::class . ':edit');
        $this->put('/announcement/{id}',        App\Controllers\Admin\AnnController::class . ':update');
        $this->delete('/announcement',          App\Controllers\Admin\AnnController::class . ':delete');
        $this->post('/announcement/ajax',       App\Controllers\Admin\AnnController::class . ':ajax');

        // Detect Mange
        $this->get('/detect',                   App\Controllers\Admin\DetectController::class . ':index');
        $this->get('/detect/create',            App\Controllers\Admin\DetectController::class . ':create');
        $this->post('/detect',                  App\Controllers\Admin\DetectController::class . ':add');
        $this->get('/detect/{id}/edit',         App\Controllers\Admin\DetectController::class . ':edit');
        $this->put('/detect/{id}',              App\Controllers\Admin\DetectController::class . ':update');
        $this->delete('/detect',                App\Controllers\Admin\DetectController::class . ':delete');
        $this->get('/detect/log',               App\Controllers\Admin\DetectController::class . ':log');
        $this->post('/detect/ajax',             App\Controllers\Admin\DetectController::class . ':ajax_rule');
        $this->post('/detect/log/ajax',         App\Controllers\Admin\DetectController::class . ':ajax_log');

        $this->get('/auto',                     App\Controllers\Admin\AutoController::class . ':index');
        $this->get('/auto/create',              App\Controllers\Admin\AutoController::class . ':create');
        $this->post('/auto',                    App\Controllers\Admin\AutoController::class . ':add');
        $this->delete('/auto',                  App\Controllers\Admin\AutoController::class . ':delete');
        $this->post('/auto/ajax',               App\Controllers\Admin\AutoController::class . ':ajax');

        // IP Mange
        $this->get('/block',                    App\Controllers\Admin\IpController::class . ':block');
        $this->get('/unblock',                  App\Controllers\Admin\IpController::class . ':unblock');
        $this->post('/unblock',                 App\Controllers\Admin\IpController::class . ':doUnblock');
        $this->get('/login',                    App\Controllers\Admin\IpController::class . ':index');
        $this->get('/alive',                    App\Controllers\Admin\IpController::class . ':alive');
        $this->post('/block/ajax',              App\Controllers\Admin\IpController::class . ':ajax_block');
        $this->post('/unblock/ajax',            App\Controllers\Admin\IpController::class . ':ajax_unblock');
        $this->post('/login/ajax',              App\Controllers\Admin\IpController::class . ':ajax_login');
        $this->post('/alive/ajax',              App\Controllers\Admin\IpController::class . ':ajax_alive');

        // Code Mange
        $this->get('/code',                     App\Controllers\Admin\CodeController::class . ':index');
        $this->get('/code/create',              App\Controllers\Admin\CodeController::class . ':create');
        $this->post('/code',                    App\Controllers\Admin\CodeController::class . ':add');
        $this->get('/donate/create',            App\Controllers\Admin\CodeController::class . ':donate_create');
        $this->post('/donate',                  App\Controllers\Admin\CodeController::class . ':donate_add');
        $this->post('/code/ajax',               App\Controllers\Admin\CodeController::class . ':ajax_code');

        // User Mange
        $this->get('/user',                     App\Controllers\Admin\UserController::class . ':index');
        $this->get('/user/{id}/edit',           App\Controllers\Admin\UserController::class . ':edit');
        $this->put('/user/{id}',                App\Controllers\Admin\UserController::class . ':update');
        $this->delete('/user',                  App\Controllers\Admin\UserController::class . ':delete');
        $this->post('/user/changetouser',       App\Controllers\Admin\UserController::class . ':changetouser');
        $this->post('/user/ajax',               App\Controllers\Admin\UserController::class . ':ajax');
        $this->post('/user/create',             App\Controllers\Admin\UserController::class . ':createNewUser');
        $this->post('/user/buy',                App\Controllers\Admin\UserController::class . ':buy');

        $this->get('/coupon',                   App\Controllers\AdminController::class . ':coupon');
        $this->post('/coupon',                  App\Controllers\AdminController::class . ':addCoupon');
        $this->post('/coupon/ajax',             App\Controllers\AdminController::class . ':ajax_coupon');

        $this->get('/exchangeCode', App\Controllers\AdminController::class . ':exchangeCode');
        $this->post('/exchangeCode', App\Controllers\AdminController::class . ':addExchange');
        $this->post('/exchangeCode/ajax', App\Controllers\AdminController::class . ':ajax_exchange_code');
        
        $this->get('/profile',                  App\Controllers\AdminController::class . ':profile');
        $this->get('/invite',                   App\Controllers\AdminController::class . ':invite');
        $this->post('/invite',                  App\Controllers\AdminController::class . ':addInvite');
        $this->post('/chginvite',               App\Controllers\AdminController::class . ':chgInvite');
        $this->get('/sys',                      App\Controllers\AdminController::class . ':sys');
        $this->get('/logout',                   App\Controllers\AdminController::class . ':logout');
        $this->post('/payback/ajax',            App\Controllers\AdminController::class . ':ajax_payback');

        // Subscribe Log Mange
        $this->get('/subscribe',                App\Controllers\Admin\SubscribeLogController::class . ':index');
        $this->post('/subscribe/ajax',          App\Controllers\Admin\SubscribeLogController::class . ':ajax_subscribe_log');

        // Detect Ban Mange
        $this->get('/detect/ban',               App\Controllers\Admin\DetectBanLogController::class . ':index');
        $this->post('/detect/ban/ajax',         App\Controllers\Admin\DetectBanLogController::class . ':ajax_log');

        // 指定用户购买记录以及添加套餐
        $this->get('/user/{id}/bought',         App\Controllers\Admin\UserLog\BoughtLogController::class . ':bought');
        $this->post('/user/{id}/bought/ajax',   App\Controllers\Admin\UserLog\BoughtLogController::class . ':bought_ajax');
        $this->delete('/user/bought',           App\Controllers\Admin\UserLog\BoughtLogController::class . ':bought_delete');
        $this->post('/user/{id}/bought/buy',    App\Controllers\Admin\UserLog\BoughtLogController::class . ':bought_add');

        // 指定用户充值记录
        $this->get('/user/{id}/code',           App\Controllers\Admin\UserLog\CodeLogController::class . ':index');
        $this->post('/user/{id}/code/ajax',     App\Controllers\Admin\UserLog\CodeLogController::class . ':ajax');

        // 指定用户订阅记录
        $this->get('/user/{id}/sublog',         App\Controllers\Admin\UserLog\SubLogController::class . ':index');
        $this->post('/user/{id}/sublog/ajax',   App\Controllers\Admin\UserLog\SubLogController::class . ':ajax');

        // 指定用户审计记录
        $this->get('/user/{id}/detect',         App\Controllers\Admin\UserLog\DetectLogController::class . ':index');
        $this->post('/user/{id}/detect/ajax',   App\Controllers\Admin\UserLog\DetectLogController::class . ':ajax');

        // 指定用户流量记录
        $this->get('/user/{id}/traffic',        App\Controllers\Admin\UserLog\TrafficLogController::class . ':index');
        $this->post('/user/{id}/traffic/ajax',  App\Controllers\Admin\UserLog\TrafficLogController::class . ':ajax');

        // 指定用户登录记录
        $this->get('/user/{id}/login',          App\Controllers\Admin\UserLog\LoginLogController::class . ':index');
        $this->post('/user/{id}/login/ajax',    App\Controllers\Admin\UserLog\LoginLogController::class . ':ajax');

        // Config Mange
        $this->group('/config', function () {
            $this->put('/update/{key}',       App\Controllers\Admin\GConfigController::class . ':update');
            $this->get('/update/{key}/edit',  App\Controllers\Admin\GConfigController::class . ':edit');

            $this->get('/telegram',             App\Controllers\Admin\GConfigController::class . ':telegram');
            $this->post('/telegram/ajax',       App\Controllers\Admin\GConfigController::class . ':telegram_ajax');

            $this->get('/register',             App\Controllers\Admin\GConfigController::class . ':register');
            $this->post('/register/ajax',       App\Controllers\Admin\GConfigController::class . ':register_ajax');
        });
        // admin 增加收入和新用户统计
        $this->get('/api/analytics/income',     App\Controllers\AdminController::class . ':getIncome');
        $this->get('/api/analytics/node',     App\Controllers\AdminController::class . ':getNodeTraffic');
        $this->get('/api/analytics/userTraffic',     App\Controllers\AdminController::class . ':getUserTraffic');
        $this->get('/api/analytics/new_users',  App\Controllers\AdminController::class . ':newUsers');
        $this->get('/api/analytics/ref_user_count',  App\Controllers\AdminController::class . ':getRefUserCount');
        $this->get('/api/analytics/ref_money_count',  App\Controllers\AdminController::class . ':getRefMoneyCount');
        $this->get('/api/analytics/get_order_detail',  App\Controllers\AdminController::class . ':getOrderDetail');
        $this->get('/api/analytics/get_ticket_detail',  App\Controllers\AdminController::class . ':getTicketDetail');

        # Metron
        // Help Mange
        $this->group('/help', function () {
            $this->get('/document',             App\Controllers\Admin\HelpController::class . ':index');
            $this->get('/document/create',      App\Controllers\Admin\HelpController::class . ':create');
            $this->get('/document/gethelpclass',App\Controllers\Admin\HelpController::class . ':getHelpClass');
            $this->get('/document/{id}/edit',   App\Controllers\Admin\HelpController::class . ':edit');
            $this->put('/document/{id}',        App\Controllers\Admin\HelpController::class . ':update');
            $this->delete('/document',          App\Controllers\Admin\HelpController::class . ':delete');
            $this->post('/document',            App\Controllers\Admin\HelpController::class . ':add');
            $this->post('/document/ajax',       App\Controllers\Admin\HelpController::class . ':ajax');

            $this->get('/class',                App\Controllers\Admin\HelpController::class . ':class_index');
            $this->get('/class/create',         App\Controllers\Admin\HelpController::class . ':class_create');
            $this->get('/class/{id}/edit',      App\Controllers\Admin\HelpController::class . ':class_edit');
            $this->put('/class/{id}',           App\Controllers\Admin\HelpController::class . ':class_update');
            $this->delete('/class',             App\Controllers\Admin\HelpController::class . ':class_delete');
            $this->post('/class',               App\Controllers\Admin\HelpController::class . ':class_add');
            $this->post('/class/ajax',          App\Controllers\Admin\HelpController::class . ':class_ajax');
        });
        // Agent
        $this->group('/agent', function () {
            $this->get('/take_log',             App\Controllers\Admin\AgentController::class . ':take_log');
            $this->put('/take_update/{mode}',   App\Controllers\Admin\AgentController::class . ':take_update');
            $this->post('/take_ajax',           App\Controllers\Admin\AgentController::class . ':take_ajax');
        });
    })->add(new Admin());

    // mu
    $app->group('/mod_mu', function () {
        // 流媒体检测
        $this->post('/media/saveReport',    App\Controllers\Mod_Mu\NodeController::class . ':saveReport');
        $this->get('/nodes/{id}/info',      App\Controllers\Mod_Mu\NodeController::class . ':get_info');
        $this->get('/users',                App\Controllers\Mod_Mu\UserController::class . ':index');
        $this->post('/users/traffic',       App\Controllers\Mod_Mu\UserController::class . ':addTraffic');
        $this->post('/users/aliveip',       App\Controllers\Mod_Mu\UserController::class . ':addAliveIp');
        $this->post('/users/detectlog',     App\Controllers\Mod_Mu\UserController::class . ':addDetectLog');
        $this->post('/nodes/{id}/info',     App\Controllers\Mod_Mu\NodeController::class . ':info');

        $this->get('/nodes',                App\Controllers\Mod_Mu\NodeController::class . ':get_all_info');
        $this->post('/nodes/config',        App\Controllers\Mod_Mu\NodeController::class . ':getConfig');

        $this->get('/func/detect_rules',    App\Controllers\Mod_Mu\FuncController::class . ':get_detect_logs');
        $this->get('/func/relay_rules',     App\Controllers\Mod_Mu\FuncController::class . ':get_relay_rules');
        $this->post('/func/block_ip',       App\Controllers\Mod_Mu\FuncController::class . ':addBlockIp');
        $this->get('/func/block_ip',        App\Controllers\Mod_Mu\FuncController::class . ':get_blockip');
        $this->get('/func/unblock_ip',      App\Controllers\Mod_Mu\FuncController::class . ':get_unblockip');
        $this->post('/func/speedtest',      App\Controllers\Mod_Mu\FuncController::class . ':addSpeedtest');
        $this->get('/func/autoexec',        App\Controllers\Mod_Mu\FuncController::class . ':get_autoexec');
        $this->post('/func/autoexec',       App\Controllers\Mod_Mu\FuncController::class . ':addAutoexec');

        $this->get('/func/ping',            App\Controllers\Mod_Mu\FuncController::class . ':ping');
        //============================================
    })->add(new Mod_Mu());

    // res
    $app->group('/res', function () {
        $this->get('/captcha/{id}',     App\Controllers\ResController::class . ':captcha');
    });

    $app->group('/link', function () {
        $this->get('/{token}',          App\Controllers\LinkController::class . ':GetContent');
    });

    $app->group('/user', function () {
        $this->post('/doiam',           App\Services\Payment::class . ':purchase');
    })->add(new Auth());

    $app->group('/doiam', function () {
        $this->post('/callback/{type}', App\Services\Payment::class . ':notify');
        $this->get('/return/alipay',    App\Services\Payment::class . ':returnHTML');
        $this->post('/status',          App\Services\Payment::class . ':getStatus');
    });

    // Vue
    $app->group('', function () {
        $this->get('/logout',                App\Controllers\VueController::class . ':vuelogout');
        $this->get('/globalconfig',          App\Controllers\VueController::class . ':getGlobalConfig');
        $this->get('/getuserinfo',           App\Controllers\VueController::class . ':getUserInfo');
        $this->post('/getuserinviteinfo',    App\Controllers\VueController::class . ':getUserInviteInfo');
        $this->get('/getusershops',          App\Controllers\VueController::class . ':getUserShops');
        $this->get('/getallresourse',        App\Controllers\VueController::class . ':getAllResourse');
        $this->get('/getnewsubtoken',        App\Controllers\VueController::class . ':getNewSubToken');
        $this->get('/getnewinvotecode',      App\Controllers\VueController::class . ':getNewInviteCode');
        $this->get('/gettransfer',           App\Controllers\VueController::class . ':getTransfer');
        $this->get('/getCaptcha',            App\Controllers\VueController::class . ':getCaptcha');
        $this->post('/getChargeLog',         App\Controllers\VueController::class . ':getChargeLog');
        $this->get('/nodeinfo/{id}',         App\Controllers\VueController::class . ':getNodeInfo');
        $this->get('/resettelegram',         App\Controllers\VueController::class . ':telegramReset');
        $this->get('/getconnectsettings',         App\Controllers\VueController::class . ':getConnectSettings');
    });

    $app->post('/api/migration', App\Controllers\BobMigrateController::class . ':migration');
    $app->post('/api/authAdmin', App\Controllers\BobMigrateController::class . ':authAdmin');

    //doc
    $app->group('/doc', function () {
        $this->get('',      App\Controllers\HomeController::class . ':getDocCenter');
        $this->get('/',     App\Controllers\HomeController::class . ':getDocCenter');
    });
    $app->get('/sublink',   App\Controllers\HomeController::class . ':getSubLink');
    //doc end

    $app->group('/getClient', function () {
        $this->get('/{token}', App\Controllers\UserController::class . ':getClientfromToken');
    });

    // api
    $app->group('/api', function () {
        $this->get('/token/{token}', App\Controllers\Api\V1\ApiController::class . ':token');
        $this->post('/token',        App\Controllers\Api\V1\ApiController::class . ':newToken');
        $this->get('/node',          App\Controllers\Api\V1\ApiController::class . ':node')->add(new Api());
        $this->get('/user/{id}',     App\Controllers\Api\V1\ApiController::class . ':userInfo')->add(new Api());
        $this->get('/sublink',       App\Controllers\Api\Client\ClientApiController::class . ':GetSubLink');
    });
};
