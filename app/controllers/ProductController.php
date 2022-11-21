<?php 
/**
 * Product Page Controller
 * @category  Controller
 */
class ProductController extends BaseController{
	function __construct(){
		parent::__construct();
		$this->tablename = "product";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("id", 
			"image", 
			"barcode", 
			"name", 
			"description", 
			"inventary_min", 
			"price_in", 
			"price_out", 
			"unit", 
			"presentation", 
			"user_id", 
			"category_id", 
			"created_at", 
			"is_active");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				product.id LIKE ? OR 
				product.image LIKE ? OR 
				product.barcode LIKE ? OR 
				product.name LIKE ? OR 
				product.description LIKE ? OR 
				product.inventary_min LIKE ? OR 
				product.price_in LIKE ? OR 
				product.price_out LIKE ? OR 
				product.unit LIKE ? OR 
				product.presentation LIKE ? OR 
				product.user_id LIKE ? OR 
				product.category_id LIKE ? OR 
				product.created_at LIKE ? OR 
				product.is_active LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "product/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("product.id", ORDER_TYPE);
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Product";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("product/list.php", $data); //render the full page
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("id", 
			"image", 
			"barcode", 
			"name", 
			"description", 
			"inventary_min", 
			"price_in", 
			"price_out", 
			"unit", 
			"presentation", 
			"user_id", 
			"category_id", 
			"created_at", 
			"is_active");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("product.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "Ver";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("Registro no encontrado");
			}
		}
		return $this->render_view("product/view.php", $record);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("image","barcode","name","description","inventary_min","price_in","price_out","unit","presentation","user_id","category_id","created_at","is_active");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'image' => 'required',
				'barcode' => 'required',
				'name' => 'required',
				'description' => 'required',
				'inventary_min' => 'required|numeric',
				'price_in' => 'required|numeric',
				'price_out' => 'required|numeric',
				'unit' => 'required',
				'presentation' => 'required',
				'user_id' => 'required|numeric',
				'category_id' => 'required|numeric',
				'created_at' => 'required',
				'is_active' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'image' => 'sanitize_string',
				'barcode' => 'sanitize_string',
				'name' => 'sanitize_string',
				'description' => 'sanitize_string',
				'inventary_min' => 'sanitize_string',
				'price_in' => 'sanitize_string',
				'price_out' => 'sanitize_string',
				'unit' => 'sanitize_string',
				'presentation' => 'sanitize_string',
				'user_id' => 'sanitize_string',
				'category_id' => 'sanitize_string',
				'created_at' => 'sanitize_string',
				'is_active' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Grabar agregado exitosamente", "success");
					return	$this->redirect("product");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Agregar nuevo";
		$this->render_view("product/add.php");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id","image","barcode","name","description","inventary_min","price_in","price_out","unit","presentation","user_id","category_id","created_at","is_active");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'image' => 'required',
				'barcode' => 'required',
				'name' => 'required',
				'description' => 'required',
				'inventary_min' => 'required|numeric',
				'price_in' => 'required|numeric',
				'price_out' => 'required|numeric',
				'unit' => 'required',
				'presentation' => 'required',
				'user_id' => 'required|numeric',
				'category_id' => 'required|numeric',
				'created_at' => 'required',
				'is_active' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'image' => 'sanitize_string',
				'barcode' => 'sanitize_string',
				'name' => 'sanitize_string',
				'description' => 'sanitize_string',
				'inventary_min' => 'sanitize_string',
				'price_in' => 'sanitize_string',
				'price_out' => 'sanitize_string',
				'unit' => 'sanitize_string',
				'presentation' => 'sanitize_string',
				'user_id' => 'sanitize_string',
				'category_id' => 'sanitize_string',
				'created_at' => 'sanitize_string',
				'is_active' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("product.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Registro actualizado con éxito", "success");
					return $this->redirect("product");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No hay registro actualizado";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("product");
					}
				}
			}
		}
		$db->where("product.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Editar";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("product/edit.php", $data);
	}
	/**
     * Update single field
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function editfield($rec_id = null, $formdata = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		//editable fields
		$fields = $this->fields = array("id","image","barcode","name","description","inventary_min","price_in","price_out","unit","presentation","user_id","category_id","created_at","is_active");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'image' => 'required',
				'barcode' => 'required',
				'name' => 'required',
				'description' => 'required',
				'inventary_min' => 'required|numeric',
				'price_in' => 'required|numeric',
				'price_out' => 'required|numeric',
				'unit' => 'required',
				'presentation' => 'required',
				'user_id' => 'required|numeric',
				'category_id' => 'required|numeric',
				'created_at' => 'required',
				'is_active' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'image' => 'sanitize_string',
				'barcode' => 'sanitize_string',
				'name' => 'sanitize_string',
				'description' => 'sanitize_string',
				'inventary_min' => 'sanitize_string',
				'price_in' => 'sanitize_string',
				'price_out' => 'sanitize_string',
				'unit' => 'sanitize_string',
				'presentation' => 'sanitize_string',
				'user_id' => 'sanitize_string',
				'category_id' => 'sanitize_string',
				'created_at' => 'sanitize_string',
				'is_active' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("product.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount();
				if($bool && $numRows){
					return render_json(
						array(
							'num_rows' =>$numRows,
							'rec_id' =>$rec_id,
						)
					);
				}
				else{
					if($db->getLastError()){
						$page_error = $db->getLastError();
					}
					elseif(!$numRows){
						$page_error = "No hay registro actualizado";
					}
					render_error($page_error);
				}
			}
			else{
				render_error($this->view->page_error);
			}
		}
		return null;
	}
	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
     * @return BaseView
     */
	function delete($rec_id = null){
		Csrf::cross_check();
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$this->rec_id = $rec_id;
		//form multiple delete, split record id separated by comma into array
		$arr_rec_id = array_map('trim', explode(",", $rec_id));
		$db->where("product.id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Grabar eliminado con éxito", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("product");
	}
}
