<?php

/** 
 * PHP Controller
 * 
 * PHP version 7.2
 * 
 * @category Controllers
 * @package  Product_Controller
 * @author   Kalnynsh <kda869@yandex.ru>
 * @license  http://example.com MIT 
 * @link     https://github.com/kalnynsh 
 */

namespace app\controllers;

use app\interfaces\IRenderer;
use app\models\repositories\ProductRepository;
use app\services\Request;
use app\services\Session;
use app\services\ProductNotFoundException;

/**
 * Product Controller
 */
class ProductController extends Controller
{
    protected $session;
    protected $repoProductDriver;
    protected $request;

    /**
     * Init property $renderer setting to passing 
     * IRenderer $render
     *
     * @param IRenderer $renderEngine - Engine for rendering
     */
    public function __construct(IRenderer $renderEngine)
    {
        parent::__construct($renderEngine);
        $this->session = (new Session)::getInstance();
        $this->repoProductDriver = new ProductRepository();
        $this->request = new Request();
    }

    /**
     * Default controller's action
     *
     * @return void
     */
    public function actionIndex()
    {
        $products = $this->repoProductDriver->getAll();
        $username = $this->session->get('user')['name'] ?? '';

        $params = [
            'products' => $products,
            'username' => $username,
        ];

        echo $this->render('catalog', $params);
    }

    /**
     * Cart action
     *
     * @return void
     */
    public function actionCard()
    {
        $is_login = false;
        $id = filter_var($this->request->getParams('id'), FILTER_VALIDATE_INT);
        $product = $this->repoProductDriver->getOne($id);

        if (!$product) {
            throw new ProductNotFoundException();
        }

        $is_login = $this->session->get('user')['isAuth'];

        $params = [
            'product' => $product,
            'is_login' => $is_login,
        ];

        echo $this->render('card', $params);
    }

}
