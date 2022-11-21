<?php
/**
 * Menu Items
 * All Project Menu
 * @category  Menu List
 */

class Menu{
	
	
			public static $navbartopleft = array(
		array(
			'path' => 'home', 
			'label' => 'Home', 
			'icon' => ''
		),
		
		array(
			'path' => 'inventario', 
			'label' => 'Inventario', 
			'icon' => ''
		),
		
		array(
			'path' => 'movimientos', 
			'label' => 'Movimientos', 
			'icon' => ''
		),
		
		array(
			'path' => 'saldosmenores', 
			'label' => 'Saldos Menores de 10', 
			'icon' => ''
		),
		
		array(
			'path' => 'menu8', 
			'label' => 'Configuración', 
			'icon' => '','submenu' => array(
		array(
			'path' => 'categorias', 
			'label' => 'Categorias', 
			'icon' => ''
		),
		
		array(
			'path' => 'proveedores', 
			'label' => 'Proveedores', 
			'icon' => ''
		)
	)
		)
	);
		
	
	
			public static $tipomovimiento = array(
		array(
			"value" => "Entrada", 
			"label" => "Entrada", 
		),
		array(
			"value" => "Salida", 
			"label" => "Salida", 
		),);
		
}