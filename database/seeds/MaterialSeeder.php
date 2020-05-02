<?php

use Illuminate\Database\Seeder;

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
					// computers
					[
						'name_material'=>'Computer screen',
						'desc_material'=>'A screen that can be plugged into a desktop computer',
						'category_material'=>'gaming,computer'
					],
					[
						'name_material'=>'Keyboard',
						'desc_material'=>'A USB keyboard',
						'category_material'=>'gaming,computer'
					],
					[
						'name_material'=>'USB mouse',
						'desc_material'=>'A USB mouse',
						'category_material'=>'gaming,computer'
					],
					[
						'name_material'=>'Remote mouse',
						'desc_material'=>'A remote mouse (works with batteries)',
						'category_material'=>'gaming,computer'
					],
					[
						'name_material'=>'Mouse pad',
						'desc_material'=>'A mouse pad',
						'category_material'=>'gaming,computer'
					],
					[
						'name_material'=>'Desktop computer',
						'desc_material'=>'A desktop computer',
						'category_material'=>'gaming,computer'
					],
					[
						'name_material'=>'Laptop',
						'desc_material'=>'A laptop',
						'category_material'=>'gaming,computer'
					],
					[
						'name_material'=>'External computer fan',
						'desc_material'=>'An external fan for laptops',
						'category_material'=>'gaming,computer'
					],
					// consoles
					[
						'name_material'=>'PS4',
						'desc_material'=>'A gaming console by Sony',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'PS4 controller',
						'desc_material'=>'A controller for PS4',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'PS4 controller cable',
						'desc_material'=>'A cable to charge a PS4 controller',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'PS4 power cable',
						'desc_material'=>'A cable to power a PS4',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'PS4 HDMI cable',
						'desc_material'=>'An HDMI cable for PS4',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'PS4 RGB cable',
						'desc_material'=>'A RGB cable for PS4',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'PS3',
						'desc_material'=>'A gaming console by Sony',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'PS3 controller',
						'desc_material'=>'A controller for PS3',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'PS3 controller cable',
						'desc_material'=>'A cable to charge a PS3 controller',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'PS3 power cable',
						'desc_material'=>'A cable to power a PS3',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'PS3 HDMI cable',
						'desc_material'=>'An HDMI cable for PS3',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'PS3 RGB cable',
						'desc_material'=>'A RGB cable for PS3',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'PS2',
						'desc_material'=>'A gaming console by Sony',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'PS2 controller',
						'desc_material'=>'A controller for PS2',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'PS2 controller cable',
						'desc_material'=>'A cable to charge a PS2 controller',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'PS2 power cable',
						'desc_material'=>'A cable to power a PS2',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'PS2 RGB cable',
						'desc_material'=>'A RGB cable for PS2',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'Nintendo Wii',
						'desc_material'=>'A gaming console by Nintendo',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'Wii controller',
						'desc_material'=>'A controller for Wii',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'Wii power cable',
						'desc_material'=>'A cable to power a Wii',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'Wii RGB cable',
						'desc_material'=>'A RGB cable for Wii',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'Wii U',
						'desc_material'=>'A gaming console by Nintendo',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'Wii U controller',
						'desc_material'=>'A controller for Wii U',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'Wii U gamepad',
						'desc_material'=>'A gamepad for Wii U',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'Wii U gamepad charging station',
						'desc_material'=>'A charging station for Wii U\'s gamepad',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'Wii U power cable',
						'desc_material'=>'A cable to power a Wii U',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'Wii U HDMI cable',
						'desc_material'=>'An HDMI cable for Wii U',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'Wii U RGB cable',
						'desc_material'=>'A RGB cable for Wii U',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'Nintendo Switch',
						'desc_material'=>'A gaming console by Nintendo',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'Nintendo Switch charging station',
						'desc_material'=>'A charging station for Nintendo Switch',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'Super NES',
						'desc_material'=>'A gaming console by Nintendo',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'Super NES controller',
						'desc_material'=>'A controller for Super NES',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'Super NES power cable',
						'desc_material'=>'A cable to power a Super NES',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'Super NES RGB cable',
						'desc_material'=>'A RGB cable for Super NES',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'XBOX ONE',
						'desc_material'=>'A gaming console by Microsoft',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'XBOX ONE controller',
						'desc_material'=>'A controller for XBOX ONE',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'XBOX ONE controller cable',
						'desc_material'=>'A cable to charge a XBOX ONE controller',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'XBOX ONE power cable',
						'desc_material'=>'A cable to power a XBOX ONE',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'XBOX ONE HDMI cable',
						'desc_material'=>'An HDMI cable for XBOX ONE',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'XBOX ONE RGB cable',
						'desc_material'=>'A RGB cable for XBOX ONE',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'XBOX 360',
						'desc_material'=>'A gaming console by Microsoft',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'XBOX 360 controller',
						'desc_material'=>'A controller for XBOX 360',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'XBOX 360 controller cable',
						'desc_material'=>'A cable to charge a XBOX 360 controller',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'XBOX 360 power cable',
						'desc_material'=>'A cable to power a XBOX 360',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'XBOX 360 HDMI cable',
						'desc_material'=>'An HDMI cable for XBOX 360',
						'category_material'=>'gaming,console'
					],
					[
						'name_material'=>'XBOX 360 RGB cable',
						'desc_material'=>'A RGB cable for XBOX 360',
						'category_material'=>'gaming,console'
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
						'name_material'=>'Lays crisps',
						'desc_material'=>'Crisps by Lays',
						'category_material'=>'food'
					],
					[
						'name_material'=>'Pringles crisps',
						'desc_material'=>'Crisps by Pringles',
						'category_material'=>'food'
					],
					// drinks
					[
						'name_material'=>'Coca-cola',
						'desc_material'=>'Coca-cola',
						'category_material'=>'drinks'
					],
					[
						'name_material'=>'Lipton Ice tea',
						'desc_material'=>'Lipton Ice tea',
						'category_material'=>'drinks'
					],
					// furnitures
					[
						'name_material'=>'Tables',
						'desc_material'=>'Tables',
						'category_material'=>'furnitures'
					],
					[
						'name_material'=>'Chairs',
						'desc_material'=>'Chairs',
						'category_material'=>'furnitures'
					],
					// other
					[
						'name_material'=>'Paper towel',
						'desc_material'=>'Paper towel',
						'category_material'=>'other'
					],
					[
						'name_material'=>'Plastic drink',
						'desc_material'=>'Plastic drink',
						'category_material'=>'other'
					],
					[
						'name_material'=>'Glass drink',
						'desc_material'=>'Glass drink',
						'category_material'=>'other'
					],
					[
						'name_material'=>'Paper plate',
						'desc_material'=>'Paper plate',
						'category_material'=>'other'
					],
					[
						'name_material'=>'Plastic plate',
						'desc_material'=>'Plastic plate',
						'category_material'=>'other'
					],
				];

				foreach($materials as $material){
					DB::table('materials')->insert($material);
				}
    }
}
