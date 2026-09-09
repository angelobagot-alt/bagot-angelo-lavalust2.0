<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductsController extends Controller
{
    public function index()
    {
        $this->call->model('ProductsModel');
        $data['products'] = $this->ProductsModel->all();
        $data['flash'] = $this->pullFlash();
        $this->call->view('products', $data);
    }

    public function create()
    {
        $this->call->view('product_form', [
            'product' => null,
            'formAction' => site_url('products'),
            'heading' => 'Add product',
            'submitLabel' => 'Create product',
            'error' => $this->pullFlash('error'),
        ]);
    }

    public function store()
    {
        $data = $this->productData();
        if ($this->invalid($data)) {
            $this->flashAndRedirect('Complete all fields with a valid price and quantity.', 'products/create', 'error');
            return;
        }
        $this->call->model('ProductsModel');
        $this->ProductsModel->insert($data);
        $this->flashAndRedirect('Product added successfully.', 'products');
    }

    public function edit($id)
    {
        $this->call->model('ProductsModel');
        $product = $this->ProductsModel->find((int) $id);
        if (!$product) {
            show_404();
            return;
        }
        $this->call->view('product_form', [
            'product' => $product,
            'formAction' => site_url('products/edit/' . (int) $id),
            'heading' => 'Edit product',
            'submitLabel' => 'Save changes',
            'error' => $this->pullFlash('error'),
        ]);
    }

    public function update($id)
    {
        $data = $this->productData();
        if ($this->invalid($data)) {
            $this->flashAndRedirect('Complete all fields with a valid price and quantity.', 'products/edit/' . (int) $id, 'error');
            return;
        }
        $this->call->model('ProductsModel');
        $this->ProductsModel->query()->where('id', (int) $id)->update($data);
        $this->flashAndRedirect('Product updated successfully.', 'products');
    }

    public function delete($id)
    {
        $this->call->model('ProductsModel');
        $this->ProductsModel->query()->where('id', (int) $id)->delete();
        $this->flashAndRedirect('Product deleted successfully.', 'products');
    }

    private function productData()
    {
        return [
            'product_name' => trim((string) $this->request->post('product_name')),
            'description' => trim((string) $this->request->post('description')),
            'price' => (float) $this->request->post('price'),
            'quantity' => (int) $this->request->post('quantity'),
        ];
    }

    private function invalid($data)
    {
        return $data['product_name'] === '' || $data['description'] === '' || $data['price'] < 0 || $data['quantity'] < 0;
    }

    private function flashAndRedirect($message, $path, $type = 'success')
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $_SESSION['flash_' . $type] = $message;
        redirect($path);
    }

    private function pullFlash($type = 'success')
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $key = 'flash_' . $type;
        $message = $_SESSION[$key] ?? '';
        unset($_SESSION[$key]);
        return $message;
    }
}