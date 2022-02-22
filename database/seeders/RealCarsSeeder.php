<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarDetails;
use App\Models\Manufacturer;
use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class RealCarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cars = new Collection([
            [
                "man" => 'Mercedes',
                "country" => 'Germany',
                'models' => ['G Class', "GLS"],
                "description" => [
                    "G Class" => "After four decades of conquering terrain on every continent, the G-Class journey advances. Along with its signature 4-wheel drive and three lockable differentials, virtually every measure of its off-road ability, from climbing to fording depth, is exceptional.",
                    "GLS" => "With a long wheelbase for more legroom and a smoother ride, the GLS lets you live large without the bulky driving experience. It's chiseled and muscular, yet polished and agile. 100% LED lighting adds to its brilliance.",
                ]
            ],
            [
                "man" => 'BMW',
                "country" => 'Germany',
                'models' => ['x6', "i8"],
                "description" => [
                    "x6" => "The BMW X6 is a Sports Activity Coupe – BMW’s line of crossovers that combine sporty style with the spaciousness and versatility of traditional SUVs. The coupe-inspired body accentuates its performance capabilities without detracting from the utility of the vehicle.",
                    "i8" => "The BMW i8 was a plug-in hybrid sports car developed by BMW. The i8 was part of BMW's electrified fleet and was marketed under the BMW i sub-brand.",
                ]
            ],
            [
                "man" => 'Kia',
                "country" => 'Korea',
                'models' => ['sportage', "sorento"],
                "description" => [
                    "sportage" => "The Kia Sportage is a compact SUV (classified as a compact crossover SUV since 2004) manufactured by the South Korean manufacturer Kia since 1993. The Sportage slots between the Seltos or Niro and the three-row Sorento in Kia's SUV lineup.",
                    "sorento" => "Get ready for adventure with the 2022 Kia Sorento. This powerful 7-passenger SUV comes with a large cargo space and a variety of driver safety tech.",
                ]
            ],
            [
                "man" => 'Nissan',
                "country" => 'Japan',
                'models' => ['gtr', "navara"],
                "description" => [
                    "gtr" => "When you've got a championship-winning GT3 race car in your stable, the changes come at competition speed. Combining lessons learned on the racetrack with a unique viewpoint on what makes the ultimate road car, the GT-R NISMO completely redefines supercar performance.",
                    "navara" => "The Nissan Navara is the name for the D21, D22, D40 and D23 generations of Nissan pickup trucks sold in Australia, New Zealand, Central America, South America, Asia, Europe, and South Africa. In North, Central and South America and some selected markets, it is sold as the Nissan Frontier or Nissan NP300.
                    After more than 10 years with the D21, Nissan unveiled the similar sized D22. It was replaced with the bigger, taller, longer D40 mid-size pickup. In 2014, Nissan released its successor, the D23, for international markets other than the U.S. and Canada. For these markets, it received the D41 Frontier in 2021 to replace the D40.",

                ]
            ],
            [
                "man" => 'Toyota',
                "country" => 'Japan',
                'models' => ['camry', "hilux"],
                "description" => [
                    "camry" => "The Toyota Camry is an automobile sold internationally by the Japanese manufacturer Toyota since 1982, spanning multiple generations. Originally compact in size (narrow-body), the Camry has grown since the 1990s to fit the mid-size classification (wide-body)—although the two widths co-existed in that decade. Since the release of the wide-bodied versions, Camry has been extolled by Toyota as the firm's second after the Corolla. In Japan, Camry was once exclusive to Toyota Corolla Store retail dealerships. Narrow-body cars also spawned a rebadged sibling in Japan, the Toyota Vista (トヨタ・ビスタ)—also introduced in 1982 and sold at Toyota Vista Store locations. Diesel fuel versions have previously retailed at Toyota Diesel Store. The Vista Ardeo was a wagon version of the Vista V50.",
                    "hilux" => "The Toyota Hilux (Japanese: トヨタ・ハイラックス, Hepburn: Toyota Hairakkusu); stylized as HiLux and historically as Hi-Lux, is a series of pickup trucks produced and marketed by the Japanese automobile manufacturer Toyota. The majority of these vehicles are sold as pickup truck or cab chassis variants, although they could be configured in a variety of body styles.",

                ]
            ],
            [
                "man" => 'Dodge',
                "country" => 'USA',
                'models' => ['Charger', "Challenger"],
                "description" => [
                    "Charger" => "The Dodge Charger is a model of automobile marketed by Dodge in various forms over seven generations since 1966.
                    The first Charger was a show car in 1964. A 1965 Charger II concept car had a remarkable resemblance to the 1966 production version.
                    The Charger has been built on three different platforms in various sizes. In the United States, the Charger nameplate has been used on subcompact hatchbacks, full-size sedans, muscle cars, and personal luxury coupes. The current version is a four-door sedan.",
                    "Challenger" => "POWERED BY A SUPERCHARGED 6.2L HIGH-OUTPUT HEMI® SRT V8 ENGINE, THE DODGE CHALLENGER SRT SUPER STOCK IS THE HIGHEST HORSEPOWER TRIM OF ANY PRODUCTION CAR ",

                ]
            ],
        ]);

        $cars->each(function ($car) {
            $manName = $car['man'];
            $man =  Manufacturer::create([
                "name" => $manName,
                "country" => $car['country'],
            ]);
            foreach ($car['description'] as $model => $description) :
                $responseBody =  Http::get("http://api.carsxe.com/images?key=3pzse8149_b4g5qjf79_ad0ra9zq8&make=$manName&model=$model&format=json&transparent=true")->json();
                $carImagesObjects = $responseBody['images'];
                $carImages = [];
                $counter = 0;
                for ($i = 0; $i < count($carImagesObjects); $i++) {
                    if ($counter == 4) {
                        break;
                    }
                    array_push($carImages, $carImagesObjects[$i]['link']);
                    $counter += 1;
                }
                $car = Car::factory()->make([
                    'type_id' => Type::inRandomOrder()->first()->id,
                    'model' => $model,
                    'images' => $carImages,
                    'thumb_nail' => $carImagesObjects[0]['thumbnailLink'],
                ]);
                $man->cars()->save($car);
                CarDetails::factory()->create([
                    'car_id' => $car->id,
                    'description' => $description,
                ]);
            endforeach;
        });
    }
}
