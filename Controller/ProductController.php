<?php
class ProductController extends BaseController
{
    /** 
     * "/user/list" Endpoint - Get list of users 
     */
    public function productHandler()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $productModel = new ProductModel();
        if (strtoupper($requestMethod) == 'GET') {
            $arrQueryStringParams = $this->getQueryStringParams();
            try {
                $id = null;
                if (isset($arrQueryStringParams['id']) && $arrQueryStringParams['id']) {
                    $id = $arrQueryStringParams['id'];
                    if ($id === 'all') $arrProducts = $productModel->getProduct('all');
                    else $arrProducts = $productModel->getProduct($id);
                } else {
                    $strErrorDesc = 'miss parameter';
                    $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
                }
                $responseData = json_encode($arrProducts);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } elseif (strtoupper($requestMethod) == 'POST') {
            $body = $this->getPostBody();
            try {

                $response = $productModel->updateProduct($body['id']);
                $responseData = json_encode($response);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output 
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array("Access-Control-Allow-Origin: *", 'Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array("Access-Control-Allow-Origin: *", 'Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    public function cartHandler()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $productModel = new ProductModel();
        if (strtoupper($requestMethod) == 'GET') {
            $arrQueryStringParams = $this->getQueryStringParams();
            try {
                $id = null;
                if (isset($arrQueryStringParams['id']) && $arrQueryStringParams['id']) {
                    $id = $arrQueryStringParams['id'];
                    if ($id === 'all') $arrProducts = $productModel->getCart('all');
                    else $arrProducts = $productModel->getCart($id);
                } else {
                    $strErrorDesc = 'miss parameter';
                    $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
                }
                $responseData = json_encode($arrProducts);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } elseif (strtoupper($requestMethod) == 'POST') {
            $body = $this->getPostBody();
            try {

                $response = $productModel->updateCart($body['id']);
                $responseData = json_encode($response);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output 
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    
}
