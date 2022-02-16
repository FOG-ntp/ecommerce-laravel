<?php

namespace App\Imports;

use App\Models\CategoryProductModel;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportProduct implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new CategoryProductModel([
            'product_name' => $row[0],
            'product_slug' => $row[1],
            'category_id' => $row[2],
            'brand_id' => $row[3],
            'product_desc' => $row[4],
            'product_content' => $row[5],
            'product_price' => $row[6],
            'product_image' => $row[7],
            'product_status' => $row[8],
        ]);
    }
}
