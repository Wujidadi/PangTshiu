<?php

use Wujidadi\Pangtshiu\Json;

test('json unescaped', function (array $data, string $json) {
    expect(Json::unescape($data))->toBe($json);
})->with([
    [
        [
            'item_no' => 'SCP-173',
            'object_class' => 'Euclid',
            'interact' => true,
            'threat' => true,
        ],
        '{"item_no":"SCP-173","object_class":"Euclid","interact":true,"threat":true}',
    ],
    [
        [
            'country' => 'South Korea',
            'name' => 'Yoon Suk Yeol',
            'hangul' => '윤석열',
            'hanja' => '尹錫悅',
        ],
        '{"country":"South Korea","name":"Yoon Suk Yeol","hangul":"윤석열","hanja":"尹錫悅"}',
    ],
]);

test('json pretty print', function (array $data, string $json) {
    expect(Json::prettyPrint($data))->toBe($json);
})->with([
    [
        [
            'order' => 1,
            'name' => 'Highly Responsive to Prayers',
            'kanji' => '東方靈異伝',
            'first_release' => '1997-08-15',
        ],
        <<<JSON
        {
            "order": 1,
            "name": "Highly Responsive to Prayers",
            "kanji": "東方靈異伝",
            "first_release": "1997-08-15"
        }
        JSON,
    ],
    [
        [
            'name' => 'Nero Claudius Caesar Augustus Germanicus',
            'class' => 'Saber',
            'source' => 'History',
            'noble_phantasms' => 'Aestus Domus Aurea',
        ],
        <<<JSON
        {
            "name": "Nero Claudius Caesar Augustus Germanicus",
            "class": "Saber",
            "source": "History",
            "noble_phantasms": "Aestus Domus Aurea"
        }
        JSON,
    ],
]);

test('json pretty print with compact indent', function (array $data, string $json) {
    expect(Json::prettyPrint($data, true))->toBe($json);
})->with([
    [
        [
            'city_name' => 'Helsinki',
            'country' => 'Finland',
            'population' => [
                'date' => '2024-10-31',
                'data' => [
                    'city' => 683669,
                    'urban' => 1360075,
                    'metro' => 1603170,
                ],
            ],
        ],
        <<<JSON
        {
          "city_name": "Helsinki",
          "country": "Finland",
          "population": {
            "date": "2024-10-31",
            "data": {
              "city": 683669,
              "urban": 1360075,
              "metro": 1603170
            }
          }
        }
        JSON,
    ],
    [
        [
            [
                'date' => '2024-12-29',
                'area' => 2,
                'weather' => 'Sunny',
                'temperature' => [
                    'min' => 10,
                    'max' => 19,
                ],
            ],
            [
                'date' => '2024-12-29',
                'area' => 3,
                'weather' => 'Rainy',
                'temperature' => [
                    'min' => 8,
                    'max' => 21,
                ],
            ],
            [
                'date' => '2025-01-01',
                'area' => 9,
                'weather' => 'Cloudy',
                'temperature' => [
                    'min' => 13,
                    'max' => 24,
                ],
            ],
        ],
        <<<JSON
        [
          {
            "date": "2024-12-29",
            "area": 2,
            "weather": "Sunny",
            "temperature": {
              "min": 10,
              "max": 19
            }
          },
          {
            "date": "2024-12-29",
            "area": 3,
            "weather": "Rainy",
            "temperature": {
              "min": 8,
              "max": 21
            }
          },
          {
            "date": "2025-01-01",
            "area": 9,
            "weather": "Cloudy",
            "temperature": {
              "min": 13,
              "max": 24
            }
          }
        ]
        JSON,
    ],
]);
