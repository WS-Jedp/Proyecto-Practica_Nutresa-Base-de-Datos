<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'http://127.0.0.1:8000/iniciarSesion', 'http://127.0.0.1:8000/validacionToken', 'http://127.0.0.1:8000/crearCategoria', 'http://127.0.0.1:8000/agregarCliente', 'http://127.0.0.1:8000/agregarProducto', 'http://127.0.0.1:8000/comprarProductos', 'registrarCombo'
    ];
}
