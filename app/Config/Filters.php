<?php

namespace Config;

use App\Filters\AdminCheckFilter;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;
use App\Filters\AuthCheckFilter;
use App\Filters\LoginCheckFilter;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'AuthCheck'     => AuthCheckFilter::class,
        'LoginCheck'     => LoginCheckFilter::class,
        'AdminCheck'     => AdminCheckFilter::class
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            // 'honeypot',
            // 'csrf',
            // 'invalidchars',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['csrf', 'throttle']
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [
        'AuthCheck' => ['before' => ['dashboard', 'dashboard/*', 'kelola', 'kelola/*', 'barang', 'barang/*', 'mriwayat', 'mriwayat/*', 'users', 'users/*', 'pencairan', 'pencairan/*', 'riwayat', 'riwayat/*', 'saldo', 'saldo/*', 'setting', 'setting/*', 'logout', 'logout/*']],
        'AdminCheck' => ['before' => ['kelola', 'kelola/*', 'barang', 'barang/*', 'mriwayat', 'mriwayat/*', 'users', 'users/*', 'pencairan', 'pencairan/*']],
        'LoginCheck' => ['before' => ['login', 'login/*', 'registrasi', 'registrasi/*']],

    ];
}
