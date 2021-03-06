<?php

namespace Turahe\Master\Test\Models;

use Illuminate\Database\Eloquent\Collection;
use Turahe\Master\Models\City;
use Turahe\Master\Models\District;
use Turahe\Master\Models\Province;
use Turahe\Master\Test\TestCase;

class ProvinceTest extends TestCase
{
    /** @test */
    public function a_province_has_many_cities_relation()
    {
        $this->seed('Turahe\Master\Seeds\ProvincesTableSeeder');
        $this->seed('Turahe\Master\Seeds\CitiesTableSeeder');
        $province = Province::first();

        $this->assertInstanceOf(Collection::class, $province->cities);
        $this->assertInstanceOf(City::class, $province->cities->first());
    }

    /** @test */
    public function a_province_has_many_districts_relation()
    {
        $this->seed('Turahe\Master\Seeds\ProvincesTableSeeder');
        $this->seed('Turahe\Master\Seeds\CitiesTableSeeder');
        $this->seed('Turahe\Master\Seeds\DistrictsTableSeeder');
        $province = Province::first();

        $this->assertInstanceOf(Collection::class, $province->districts);
        $this->assertInstanceOf(District::class, $province->districts->first());
    }

    /** @test */
    public function a_province_has_name_attribute()
    {
        $this->seed('Turahe\Master\Seeds\ProvincesTableSeeder');
        $province = Province::first();

        $this->assertEquals('ACEH', $province->name);
    }

    /** @test */
    public function a_province_has_logo_path_attribute()
    {
        $this->seed('Turahe\Master\Seeds\ProvincesTableSeeder');
        $province = Province::first();

        $this->assertNull($province->logo_path);
    }

    /** @test */
    public function a_province_can_store_meta_column()
    {
        $this->seed('Turahe\Master\Seeds\ProvincesTableSeeder');
        $province = Province::first();
        $province->meta = ['luas_wilayah' => 200.2];
        $province->save();
        $this->assertEquals(['luas_wilayah' => 200.2], $province->meta);
    }
}
