<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * inventario_idproveedor_option_list Model Action
     * @return array
     */
	function inventario_idproveedor_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT idproveedor AS value,nombre AS label FROM proveedores ORDER BY nombre ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * inventario_categoria_option_list Model Action
     * @return array
     */
	function inventario_categoria_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT idcategoria AS value,descripcion AS label FROM categorias ORDER BY descripcion ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * movimientos_codigo_option_list Model Action
     * @return array
     */
	function movimientos_codigo_option_list($search_text = null){
		$arr = array();
		if(!empty($search_text)){
			$db = $this->GetModel();
			$sqltext = "SELECT  DISTINCT codigo AS value,descripcion AS label FROM inventario WHERE descripcion LIKE ? ORDER BY descripcion ASC LIMIT 0,10" ;
			$queryparams = array("%$search_text%");
			$arr = $db->rawQuery($sqltext, $queryparams);
		}
		return $arr;
	}

	/**
     * usuariosweb_username_value_exist Model Action
     * @return array
     */
	function usuariosweb_username_value_exist($val){
		$db = $this->GetModel();
		$db->where("username", $val);
		$exist = $db->has("usuariosweb");
		return $exist;
	}

	/**
     * usuariosweb_email_value_exist Model Action
     * @return array
     */
	function usuariosweb_email_value_exist($val){
		$db = $this->GetModel();
		$db->where("email", $val);
		$exist = $db->has("usuariosweb");
		return $exist;
	}

	/**
	* barchart_saldosinventario Model Action
	* @return array
	*/
	function barchart_saldosinventario(){
		
		$db = $this->GetModel();
		$chart_data = array(
			"labels"=> array(),
			"datasets"=> array(),
		);
		
		//set query result for dataset 1
		$sqltext = "SELECT  codigo,SALDO FROM grafico";
		$queryparams = null;
		$dataset1 = $db->rawQuery($sqltext, $queryparams);
		$dataset_data =  array_column($dataset1, 'SALDO');
		$dataset_labels =  array_column($dataset1, 'codigo');
		$chart_data["labels"] = array_unique(array_merge($chart_data["labels"], $dataset_labels));
		$chart_data["datasets"][] = $dataset_data;

		//set query result for dataset 2
		$sqltext = "SELECT  codigo,mov FROM grafico";
		$queryparams = null;
		$dataset2 = $db->rawQuery($sqltext, $queryparams);
		$dataset_data =  array_column($dataset2, 'mov');
		$dataset_labels =  array_column($dataset2, 'codigo');
		$chart_data["labels"] = array_unique(array_merge($chart_data["labels"], $dataset_labels));
		$chart_data["datasets"][] = $dataset_data;

		return $chart_data;
	}

}
