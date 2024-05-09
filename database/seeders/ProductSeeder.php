<?php

namespace Database\Seeders;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $randomFeatureIds = $this->getRandomFeatureIds(20, 5);
            $categoryFeatureIds = $this->getRandomFeatureIds(5, 1);
            Product::create([
                'name' => "Product $i",
                'description' => "Description for Product $i",
                'image'=>"image$i.jpg",
                'user_id' => 1,
                'category_id'=>json_encode($categoryFeatureIds),
                'feature_ids'=>json_encode($randomFeatureIds),
            ]);
        }
    }

    private function getRandomFeatureIds(int $maxId, int $count): array
    {
        $featureIds = range(1, $maxId);
        shuffle($featureIds);
        $randomIds = array_slice($featureIds, 0, $count);

        return $randomIds;
    }
}
