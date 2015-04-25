<?php
class ProductHelper{

    public function getProduct($id){
        return Product::find($id);
    }

    public function getProductByUrl($url_key){
        return Product::where('url_key', '=', $url_key)->first();
    }

    public function getProductArray($row, $fields){

        $count = -1;

        foreach($fields as $field){

            ++$count;

            $productArray[$field] = $row[$count];
        }

        $productArray['update_type'] = 'imported';

        return $productArray;
    }
}
?>