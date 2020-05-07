<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $materials=[
					// electricity
					[
						'name_material'=>'Electrical outlet',
						'desc_material'=>'Mural outlet',
						'category_material'=>'electricity'
					],
					[
						'name_material'=>'Power strip 6 outlets',
						'desc_material'=>'A power strip of 6 outlets',
						'category_material'=>'electricity'
					],
					[
						'name_material'=>'Surge protector 6 outlets',
						'desc_material'=>'A power strip of 6 outlets that protects the devices from lightning',
						'category_material'=>'electricity'
					],
					[
						'name_material'=>'Power strip 3 outlets',
						'desc_material'=>'A power strip of 3 outlets',
						'category_material'=>'electricity'
					],
					[
						'name_material'=>'Surge protector 3 outlets',
						'desc_material'=>'A power strip of 3 outlets that protects the devices from lightning',
						'category_material'=>'electricity'
					],
					[
						'name_material'=>'Power strip 12 outlets',
						'desc_material'=>'A power strip of 12 outlets',
						'category_material'=>'electricity'
					],
					[
						'name_material'=>'Surge protector 12 outlets',
						'desc_material'=>'A power strip of 12 outlets that protects the devices from lightning',
						'category_material'=>'electricity'
					],
					[
						'name_material'=>'Power extension cord 5m',
						'desc_material'=>'A 5m power extension cord',
						'category_material'=>'electricity'
					],
					[
						'name_material'=>'Power extension cord 10m',
						'desc_material'=>'A 10m power extension cord',
						'category_material'=>'electricity'
					],
					[
						'name_material'=>'Power extension cord 25m',
						'desc_material'=>'A 25m power extension cord',
						'category_material'=>'electricity'
					],
					[
						'name_material'=>'Power extension cord 50m',
						'desc_material'=>'A 50m power extension cord',
						'category_material'=>'electricity'
					],
					[
						'name_material'=>'Lamp',
						'desc_material'=>'Lamp',
						'category_material'=>'electricity light'
					],
					[
						'name_material'=>'Light bulb',
						'desc_material'=>'Light buld',
						'category_material'=>'electricity light'
					],
					// internet
					[
						'name_material'=>'Ethernet cable 50cm',
						'desc_material'=>'An 50cm ethernet cable',
						'category_material'=>'internet'
					],
					[
						'name_material'=>'Ethernet cable 5m',
						'desc_material'=>'An 5m ethernet cable',
						'category_material'=>'internet'
					],
					[
						'name_material'=>'Ethernet cable 10m',
						'desc_material'=>'An 10m ethernet cable',
						'category_material'=>'internet'
					],
					[
						'name_material'=>'Ethernet cable 20m',
						'desc_material'=>'An 20m ethernet cable',
						'category_material'=>'internet'
					],
					//sound
					[
						'name_material'=>'Microphone',
						'desc_material'=>'Microphone',
						'category_material'=>'gaming sound'
					],
					[
						'name_material'=>'Headset',
						'desc_material'=>'A headset without microphone',
						'category_material'=>'gaming sound'
					],
					[
						'name_material'=>'Headset with microphone',
						'desc_material'=>'A headset with a microphone',
						'category_material'=>'gaming sound'
					],
					[
						'name_material'=>'Speaker',
						'desc_material'=>'Speaker',
						'category_material'=>'gaming sound'
					],
					// computers
					[
						'name_material'=>'Computer screen',
						'desc_material'=>'A screen that can be plugged into a desktop computer',
						'category_material'=>'gaming computer'
					],
					[
						'name_material'=>'Keyboard',
						'desc_material'=>'A USB keyboard',
						'category_material'=>'gaming computer'
					],
					[
						'name_material'=>'USB mouse',
						'desc_material'=>'A USB mouse',
						'category_material'=>'gaming computer'
					],
					[
						'name_material'=>'Remote mouse',
						'desc_material'=>'A remote mouse (works with batteries)',
						'category_material'=>'gaming computer'
					],
					[
						'name_material'=>'Mouse pad',
						'desc_material'=>'A mouse pad',
						'category_material'=>'gaming computer'
					],
					[
						'name_material'=>'Desktop computer',
						'desc_material'=>'A desktop computer',
						'category_material'=>'gaming computer'
					],
					[
						'name_material'=>'Laptop',
						'desc_material'=>'A laptop',
						'category_material'=>'gaming computer'
					],
					[
						'name_material'=>'External computer fan',
						'desc_material'=>'An external fan for laptops',
						'category_material'=>'gaming computer'
					],
					// consoles
					[
						'name_material'=>'PS4',
						'desc_material'=>'A gaming console by Sony',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'PS4 controller',
						'desc_material'=>'A controller for PS4',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'PS4 controller cable',
						'desc_material'=>'A cable to charge a PS4 controller',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'PS4 power cable',
						'desc_material'=>'A cable to power a PS4',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'PS4 HDMI cable',
						'desc_material'=>'An HDMI cable for PS4',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'PS4 RGB cable',
						'desc_material'=>'A RGB cable for PS4',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'PS3',
						'desc_material'=>'A gaming console by Sony',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'PS3 controller',
						'desc_material'=>'A controller for PS3',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'PS3 controller cable',
						'desc_material'=>'A cable to charge a PS3 controller',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'PS3 power cable',
						'desc_material'=>'A cable to power a PS3',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'PS3 HDMI cable',
						'desc_material'=>'An HDMI cable for PS3',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'PS3 RGB cable',
						'desc_material'=>'A RGB cable for PS3',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'PS2',
						'desc_material'=>'A gaming console by Sony',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'PS2 controller',
						'desc_material'=>'A controller for PS2',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'PS2 controller cable',
						'desc_material'=>'A cable to charge a PS2 controller',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'PS2 power cable',
						'desc_material'=>'A cable to power a PS2',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'PS2 RGB cable',
						'desc_material'=>'A RGB cable for PS2',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'Nintendo Wii',
						'desc_material'=>'A gaming console by Nintendo',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'Wii controller',
						'desc_material'=>'A controller for Wii',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'Wii power cable',
						'desc_material'=>'A cable to power a Wii',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'Wii RGB cable',
						'desc_material'=>'A RGB cable for Wii',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'Wii U',
						'desc_material'=>'A gaming console by Nintendo',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'Wii U controller',
						'desc_material'=>'A controller for Wii U',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'Wii U gamepad',
						'desc_material'=>'A gamepad for Wii U',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'Wii U gamepad charging station',
						'desc_material'=>'A charging station for Wii U\'s gamepad',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'Wii U power cable',
						'desc_material'=>'A cable to power a Wii U',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'Wii U HDMI cable',
						'desc_material'=>'An HDMI cable for Wii U',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'Wii U RGB cable',
						'desc_material'=>'A RGB cable for Wii U',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'Nintendo Switch',
						'desc_material'=>'A gaming console by Nintendo',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'Nintendo Switch charging station',
						'desc_material'=>'A charging station for Nintendo Switch',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'Super NES',
						'desc_material'=>'A gaming console by Nintendo',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'Super NES controller',
						'desc_material'=>'A controller for Super NES',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'Super NES power cable',
						'desc_material'=>'A cable to power a Super NES',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'Super NES RGB cable',
						'desc_material'=>'A RGB cable for Super NES',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'XBOX ONE',
						'desc_material'=>'A gaming console by Microsoft',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'XBOX ONE controller',
						'desc_material'=>'A controller for XBOX ONE',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'XBOX ONE controller cable',
						'desc_material'=>'A cable to charge a XBOX ONE controller',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'XBOX ONE power cable',
						'desc_material'=>'A cable to power a XBOX ONE',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'XBOX ONE HDMI cable',
						'desc_material'=>'An HDMI cable for XBOX ONE',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'XBOX ONE RGB cable',
						'desc_material'=>'A RGB cable for XBOX ONE',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'XBOX 360',
						'desc_material'=>'A gaming console by Microsoft',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'XBOX 360 controller',
						'desc_material'=>'A controller for XBOX 360',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'XBOX 360 controller cable',
						'desc_material'=>'A cable to charge a XBOX 360 controller',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'XBOX 360 power cable',
						'desc_material'=>'A cable to power a XBOX 360',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'XBOX 360 HDMI cable',
						'desc_material'=>'An HDMI cable for XBOX 360',
						'category_material'=>'gaming console'
					],
					[
						'name_material'=>'XBOX 360 RGB cable',
						'desc_material'=>'A RGB cable for XBOX 360',
						'category_material'=>'gaming console'
					],
					// projector
					[
						'name_material'=>'Projector',
						'desc_material'=>'A projector',
						'category_material'=>'screen'
					],
					[
						'name_material'=>'Projector screen 16:9 70"',
						'desc_material'=>'A projector screen',
						'category_material'=>'screen'
					],
					[
						'name_material'=>'Projector screen 16:9 120"',
						'desc_material'=>'A projector screen',
						'category_material'=>'screen'
					],
					[
						'name_material'=>'Projector screen 4:3 150"',
						'desc_material'=>'A projector screen',
						'category_material'=>'screen'
					],
					[
						'name_material'=>'VGA cable',
						'desc_material'=>'A VGA cable',
						'category_material'=>'screen'
					],
					[
						'name_material'=>'DVI cable',
						'desc_material'=>'A DVI cable',
						'category_material'=>'screen'
					],
					[
						'name_material'=>'HDMI cable',
						'desc_material'=>'An HDMI cable',
						'category_material'=>'screen'
					],
					// food
					[
						'name_material'=>'Crisps',
						'desc_material'=>'Crisps',
						'category_material'=>'food'
					],
					[
						'name_material'=>'Pringles Crisps',
						'desc_material'=>'Crisps by Pringles',
						'category_material'=>'food'
					],
					[
						'name_material'=>'3D Bugles',
						'desc_material'=>'3D Bugles',
						'category_material'=>'food'
					],
					[
						'name_material'=>'Monster Munch',
						'desc_material'=>'Monster Munch',
						'category_material'=>'food'
					],
					[
						'name_material'=>'Curly',
						'desc_material'=>'Curly',
						'category_material'=>'food'
					],
					[
						'name_material'=>'Nachos',
						'desc_material'=>'Nachos',
						'category_material'=>'food'
					],
					[
						'name_material'=>'Peanuts',
						'desc_material'=>'Peanuts',
						'category_material'=>'food'
					],
					// drinks
					[
						'name_material'=>'Coca-cola bottle 1,25L',
						'desc_material'=>'Coca-cola bottle 1,25L',
						'category_material'=>'drinks'
					],
					[
						'name_material'=>'Coca-cola bottle 1,75L',
						'desc_material'=>'Coca-cola bottle 1,75L',
						'category_material'=>'drinks'
					],
					[
						'name_material'=>'Coca-cola bottle 2L',
						'desc_material'=>'Coca-cola bottle 2L',
						'category_material'=>'drinks'
					],
					[
						'name_material'=>'Coca-cola bottle 50cL',
						'desc_material'=>'Coca-cola bottle 50cL',
						'category_material'=>'drinks'
					],
					[
						'name_material'=>'Coca-cola can 33cL',
						'desc_material'=>'Coca-cola can 33cL',
						'category_material'=>'drinks'
					],
					[
						'name_material'=>'Ice tea bottle 1L',
						'desc_material'=>'Ice tea bottle 1L',
						'category_material'=>'drinks'
					],
					[
						'name_material'=>'Ice tea bottle 25cL',
						'desc_material'=>'Ice tea bottle 25cL',
						'category_material'=>'drinks'
					],
					[
						'name_material'=>'Ice tea can 33cL',
						'desc_material'=>'Ice tea can 33cL',
						'category_material'=>'drinks'
					],
					[
						'name_material'=>'Water bottle 1L',
						'desc_material'=>'Water bottle 1L',
						'category_material'=>'drinks'
					],
					[
						'name_material'=>'Water bottle 1,5L',
						'desc_material'=>'Water bottle 1,5L',
						'category_material'=>'drinks'
					],
					[
						'name_material'=>'Water bottle 50cL',
						'desc_material'=>'Water bottle 50cL',
						'category_material'=>'drinks'
					],
					[
						'name_material'=>'Redbull can 25cL',
						'desc_material'=>'Redbull can 25cL',
						'category_material'=>'drinks'
					],
					[
						'name_material'=>'Redbull bottle 33cL',
						'desc_material'=>'Redbull bottle 33cL',
						'category_material'=>'drinks'
					],
					[
						'name_material'=>'Monster can 50cL',
						'desc_material'=>'Monster can 50cL',
						'category_material'=>'drinks'
					],
					[
						'name_material'=>'Mint sirup',
						'desc_material'=>'Mint sirup',
						'category_material'=>'drinks'
					],
					[
						'name_material'=>'Orgeat sirup',
						'desc_material'=>'Orgeat sirup',
						'category_material'=>'drinks'
					],
					[
						'name_material'=>'Cassis sirup',
						'desc_material'=>'Cassis sirup',
						'category_material'=>'drinks'
					],
					[
						'name_material'=>'Raspberry sirup',
						'desc_material'=>'Raspberry sirup',
						'category_material'=>'drinks'
					],
					[
						'name_material'=>'Grenadine sirup',
						'desc_material'=>'Grenadine sirup',
						'category_material'=>'drinks'
					],
					// furnitures
					[
						'name_material'=>'Table',
						'desc_material'=>'Table',
						'category_material'=>'furnitures'
					],
					[
						'name_material'=>'Chair',
						'desc_material'=>'Chair',
						'category_material'=>'furnitures'
					],
					[
						'name_material'=>'Paper tablecloth',
						'desc_material'=>'Paper tablecloth',
						'category_material'=>'furnitures'
					],
					// dishes/other
					[
						'name_material'=>'Paper towel',
						'desc_material'=>'Paper towel',
						'category_material'=>'other'
					],
					[
						'name_material'=>'Paper napkin',
						'desc_material'=>'Paper napkin',
						'category_material'=>'other'
					],
					[
						'name_material'=>'Plastic drink',
						'desc_material'=>'Plastic drink',
						'category_material'=>'food dishes'
					],
					[
						'name_material'=>'Glass drink',
						'desc_material'=>'Glass drink',
						'category_material'=>'food dishes'
					],
					[
						'name_material'=>'Paper plate',
						'desc_material'=>'Paper plate',
						'category_material'=>'food dishes'
					],
					[
						'name_material'=>'Plastic plate',
						'desc_material'=>'Plastic plate',
						'category_material'=>'food dishes'
					],
					// cleaning
					[
						'name_material'=>'Garbage bag 2,5L',
						'desc_material'=>'Garbage bag 2,5L',
						'category_material'=>'cleaning'
					],
					[
						'name_material'=>'Garbage bag 10L',
						'desc_material'=>'Garbage bag 10L',
						'category_material'=>'cleaning'
					],
					[
						'name_material'=>'Garbage bag 30L',
						'desc_material'=>'Garbage bag 30L',
						'category_material'=>'cleaning'
					],
					[
						'name_material'=>'Garbage bag 50L',
						'desc_material'=>'Garbage bag 50L',
						'category_material'=>'cleaning'
					],
					[
						'name_material'=>'Garbage bag 100L',
						'desc_material'=>'Garbage bag 100L',
						'category_material'=>'cleaning'
					],
					[
						'name_material'=>'Garbage bag 110L',
						'desc_material'=>'Garbage bag 110L',
						'category_material'=>'cleaning'
					],
					[
						'name_material'=>'Garbage bag 130L',
						'desc_material'=>'Garbage bag 130L',
						'category_material'=>'cleaning'
					],
					[
						'name_material'=>'Trash can 10L',
						'desc_material'=>'Trash can 10L',
						'category_material'=>'cleaning'
					],
					[
						'name_material'=>'Trash can 30L',
						'desc_material'=>'Trash can 30L',
						'category_material'=>'cleaning'
					],
					[
						'name_material'=>'Trash can 50L',
						'desc_material'=>'Trash can 50L',
						'category_material'=>'cleaning'
					],
					[
						'name_material'=>'Trash can 100L',
						'desc_material'=>'Trash can 100L',
						'category_material'=>'cleaning'
					],
					[
						'name_material'=>'Trash can 110L',
						'desc_material'=>'Trash can 110L',
						'category_material'=>'cleaning'
					],
					[
						'name_material'=>'Trash can 130L',
						'desc_material'=>'Trash can 130L',
						'category_material'=>'cleaning'
					],
					[
						'name_material'=>'Floor cleaning product 500mL',
						'desc_material'=>'Floor cleaning product 500mL',
						'category_material'=>'cleaning'
					],
					[
						'name_material'=>'Floor cleaning product 1L',
						'desc_material'=>'Floor cleaning product 1L',
						'category_material'=>'cleaning'
					],
					[
						'name_material'=>'Floor cleaning product 2L',
						'desc_material'=>'Floor cleaning product 2L',
						'category_material'=>'cleaning'
					],
					[
						'name_material'=>'Floor cleaning product 5L',
						'desc_material'=>'Floor cleaning product 5L',
						'category_material'=>'cleaning'
					],
					[
						'name_material'=>'Mop',
						'desc_material'=>'Mop',
						'category_material'=>'cleaning'
					],
					[
						'name_material'=>'Broom',
						'desc_material'=>'Broom',
						'category_material'=>'cleaning'
					],
					[
						'name_material'=>'Shovel and brush',
						'desc_material'=>'Shovel and brush',
						'category_material'=>'cleaning'
					],
				];

				foreach($materials as $material){
					DB::table('materials')->insert($material);
				}
    }
}
