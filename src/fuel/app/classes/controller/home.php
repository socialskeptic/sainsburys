<?php

namespace Controller;
use \Library;

/**
 * Class Home
 * @package Controller
 */
class Home extends Base\Rest
{
	/**
	 * The main index page for the application.
	 * @return mixed
	 */
	public function action_index()
	{
		try
		{
			//set product list target url
			$url = 'http://www.sainsburys.co.uk/webapp/wcs/stores/servlet/AjaxApplyFilterBrowseView?langId=44&storeId=10151&catalogId=10137&categoryId=185749&parent_category_rn=12518&top_category=12518&pageSize=20&orderBy=FAVOURITES_FIRST&searchTerm=&beginIndex=0&hideFilters=true';

			//get products list
			/** @var \Library\Consume\ProductList $productList */
			$productList = $this->getDi()['\Library\Consume\ProductList'];
			$productList->setUrl($url);
			$productList = $productList->getResponse();

			//check products list
			if(!is_array($productList) || empty($productList)) {
				throw new \Exception('product list not found');
			} else {

				//get product instance
				/** @var \Library\Consume\Product $consumeProduct */
				$consumeProduct = $this->getDi()['\Library\Consume\Product'];

				//iterate over products list
				foreach($productList as $key => $product) {

					//check href is set
					if(!isset($product['href'])) {
						throw new \Exception('product href is not set');
					}

					//set single product request url
					$consumeProduct->setUrl($product['href']);

					//unset href from products list
					unset($productList[$key]['href']);

					//get product info
					$productInfo = $consumeProduct->getResponse();
					$productList[$key] = array_merge($productList[$key], $productInfo);
				}

				$this->response($productList);
			}

		} catch (\Exception $e) {

			//return caught exceptions to json response
			$this->response(array('exception' => $e->getMessage()));
		}
	}

	/**
	 * The 404 action for the application.
	 * @return mixed
	 */
	public function action_404()
	{
		$this->response(array('404'));
	}
}
